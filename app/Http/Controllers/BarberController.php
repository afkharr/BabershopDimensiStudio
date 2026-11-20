<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BarberController extends Controller
{
    /**
     * Menampilkan seluruh data barber.
     */
    public function index(Request $request)
    {
        $query = Barber::with('user');

        // Pencarian berdasarkan nama, email, dan nomor HP.
        if ($request->filled('q')) {
            $search = $request->q;

            $query->whereHas('user', function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status barber.
        if (
            $request->filled('status') &&
            in_array($request->status, ['aktif', 'cuti', 'berhenti'], true)
        ) {
            $query->where('status', $request->status);
        }

        $barbers = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barber.index', [
            'barbers' => $barbers,
            'totalBarbers' => Barber::count(),
            'totalActive' => Barber::where('status', 'aktif')->count(),
            'totalOnLeave' => Barber::where('status', 'cuti')->count(),
            'totalResigned' => Barber::where('status', 'berhenti')->count(),
        ]);
    }

    /**
     * Menampilkan form tambah barber.
     */
    public function create()
    {
        return view('barber.create');
    }

    /**
     * Membuat akun internal dan profil barber.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Upload foto barber.
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('barbers', 'public');
        }

        try {
            DB::transaction(function () use ($validated, $photoPath) {

                // Membuat akun internal barber.
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'password' => $validated['password'],
                    'role' => 'barber',
                    'is_active' => true,
                ]);

                // Membuat profil barber.
                Barber::create([
                    'user_id' => $user->id,
                    'photo' => $photoPath,
                    'description' => $validated['description'] ?? null,
                    'status' => 'aktif',
                ]);
            });

        } catch (\Throwable $e) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            throw $e;
        }

        return redirect()
            ->route('admin.barber.index')
            ->with('success', 'Akun dan profil barber berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit barber.
     */
    public function edit(Barber $barber)
    {
        $barber->load('user');

        return view('barber.edit', compact('barber'));
    }

    /**
     * Memperbarui akun dan profil barber.
     */
    public function update(Request $request, Barber $barber)
    {
        $barber->load('user');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($barber->user_id),
            ],

            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'description' => ['nullable', 'string'],

            'status' => [
                'required',
                Rule::in(['aktif', 'cuti', 'berhenti']),
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Simpan informasi foto lama.
        $oldPhoto = $barber->photo;
        $newPhoto = null;

        // Upload foto baru jika ada.
        if ($request->hasFile('photo')) {
            $newPhoto = $request->file('photo')->store('barbers', 'public');
        }

        try {
            DB::transaction(function () use ($barber, $validated, $newPhoto) {

                // Memperbarui akun internal.
                $userData = [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,

                    // Akun hanya aktif jika status barber aktif.
                    'is_active' => $validated['status'] === 'aktif',
                ];

                // Password hanya diperbarui jika diisi.
                if (!empty($validated['password'])) {
                    $userData['password'] = $validated['password'];
                }

                $barber->user->update($userData);

                // Memperbarui profil barber.
                $barber->update([
                    'photo' => $newPhoto ?? $barber->photo,
                    'description' => $validated['description'] ?? null,
                    'status' => $validated['status'],
                ]);
            });

        } catch (\Throwable $e) {
            if ($newPhoto) {
                Storage::disk('public')->delete($newPhoto);
            }

            throw $e;
        }

        // Hapus foto lama setelah update berhasil.
        if ($newPhoto && $oldPhoto) {
            Storage::disk('public')->delete($oldPhoto);
        }

        return redirect()
            ->route('admin.barber.index')
            ->with('success', 'Data barber berhasil diperbarui.');
    }

    /**
     * Penghapusan permanen menunggu pemeriksaan riwayat booking.
     */
    public function destroy(Barber $barber)
    {
        return redirect()
            ->route('admin.barber.index')
            ->with(
                'warning',
                'Penghapusan permanen menunggu pemeriksaan relasi booking.'
            );
    }
}
