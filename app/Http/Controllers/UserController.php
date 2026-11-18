<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan akun owner dan barber
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian berdasarkan nama, email, dan nomor HP
        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan role
        if (
            $request->filled('role') &&
            in_array($request->role, ['owner', 'barber'], true)
        ) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'totalUsers' => User::count(),
            'totalOwners' => User::where('role', 'owner')->count(),
            'totalBarbers' => User::where('role', 'barber')->count(),
        ]);
    }

    // Menampilkan form tambah akun
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan akun baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in(['owner', 'barber']),
            ],
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun internal berhasil ditambahkan.');
    }

    // Menampilkan form edit akun
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data akun
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in(['owner', 'barber']),
            ],
        ]);

        // Password hanya diperbarui jika diisi
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        // Mencegah owner terakhir kehilangan role owner
        $warning = null;

        if (
            $user->role === 'owner' &&
            $validated['role'] !== 'owner' &&
            User::where('role', 'owner')->count() <= 1
        ) {
            $validated['role'] = 'owner';

            $warning = 'Data berhasil diperbarui, tetapi role tetap Owner karena merupakan satu-satunya owner.';
        }

        // Menyimpan perubahan data
        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with(
                $warning ? 'warning' : 'success',
                $warning ?? 'Data akun berhasil diperbarui.'
            );
    }

    // Menghapus akun
    public function destroy(User $user)
    {
        // Mencegah pengguna menghapus akun sendiri
        if (
            auth()->check() &&
            $user->getKey() === auth()->id()
        ) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        // Mencegah penghapusan owner terakhir
        if (
            $user->role === 'owner' &&
            User::where('role', 'owner')->count() <= 1
        ) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Owner terakhir tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
