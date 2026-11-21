<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\BarberDayOff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarberDayOffController extends Controller
{
    /**
     * Menampilkan seluruh data hari libur barber.
     */
    public function index(Request $request)
    {
        $query = BarberDayOff::with('barber.user');

        // Pencarian berdasarkan nama barber.
        if ($request->filled('q')) {
            $search = $request->q;

            $query->whereHas('barber.user', function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan barber.
        if ($request->filled('barber_id')) {
            $query->where('barber_id', $request->barber_id);
        }

        $daysOff = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Mengambil daftar barber yang masih aktif.
        $barbers = Barber::with('user')
            ->where('status', 'aktif')
            ->get();

        return view('admin.barber-days-off.index', [
            'daysOff' => $daysOff,
            'barbers' => $barbers,
            'totalDaysOff' => BarberDayOff::count(),
        ]);
    }

    /**
     * Menambahkan tanggal libur barber.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barber_id' => [
                'required',
                'exists:barbers,id',
            ],

            'tanggal' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Memastikan barber belum memiliki catatan libur
        // pada tanggal yang sama.
        $exists = BarberDayOff::where('barber_id', $validated['barber_id'])
            ->whereDate('tanggal', $validated['tanggal'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal' => 'Barber sudah memiliki catatan libur pada tanggal tersebut.',
                ]);
        }

        // Menyimpan data hari libur.
        DB::transaction(function () use ($validated) {
            BarberDayOff::create($validated);
        });

        return redirect()
            ->route('admin.barber-days-off.index')
            ->with('success', 'Tanggal libur barber berhasil ditambahkan.');
    }

    /**
     * Memperbarui data hari libur barber.
     */
    public function update(Request $request, BarberDayOff $barberDayOff)
    {
        $validated = $request->validate([
            'tanggal' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Memeriksa apakah tanggal libur sudah digunakan
        // oleh barber yang sama.
        $exists = BarberDayOff::where('barber_id', $barberDayOff->barber_id)
            ->whereDate('tanggal', $validated['tanggal'])
            ->where('id', '!=', $barberDayOff->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal' => 'Barber sudah memiliki catatan libur pada tanggal tersebut.',
                ]);
        }

        // Memperbarui data hari libur.
        DB::transaction(function () use ($barberDayOff, $validated) {
            $barberDayOff->update($validated);
        });

        return redirect()
            ->route('admin.barber-days-off.index')
            ->with('success', 'Data hari libur barber berhasil diperbarui.');
    }

    /**
     * Menghapus data hari libur barber.
     */
    public function destroy(BarberDayOff $barberDayOff)
    {
        $barberDayOff->delete();

        return redirect()
            ->route('admin.barber-days-off.index')
            ->with('success', 'Data hari libur barber berhasil dihapus.');
    }
}
