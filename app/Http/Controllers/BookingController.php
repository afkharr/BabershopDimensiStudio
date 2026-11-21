<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Barber;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Menampilkan seluruh data booking pelanggan.
     */
    public function index(Request $request)
    {
        $query = Booking::with('barber.user');

        // Pencarian berdasarkan nama, nomor HP, atau kode booking.
        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($builder) use ($search) {
                $builder->where('nama_customer', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('kode_booking', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan barber.
        if ($request->filled('barber_id')) {
            $query->where('barber_id', $request->barber_id);
        }

        // Filter berdasarkan status booking.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal booking.
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Mengambil data booking dengan pagination.
        $bookings = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'asc')
            ->orderBy('nomor_antrean', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Mengambil daftar barber yang masih aktif.
        $barbers = Barber::with('user')
            ->where('status', 'aktif')
            ->get();

        // Menghitung jumlah booking berdasarkan status.
        $totalBookings = Booking::count();

        $totalMenunggu = Booking::where('status', 'menunggu')->count();

        $totalDilayani = Booking::where('status', 'sedang_dilayani')->count();

        $totalSelesai = Booking::where('status', 'selesai')->count();

        $totalDibatalkan = Booking::where('status', 'dibatalkan')->count();

        return view('admin.bookings.index', [
            'bookings' => $bookings,
            'barbers' => $barbers,
            'totalBookings' => $totalBookings,
            'totalMenunggu' => $totalMenunggu,
            'totalDilayani' => $totalDilayani,
            'totalSelesai' => $totalSelesai,
            'totalDibatalkan' => $totalDibatalkan,
        ]);
    }

    /**
     * Menampilkan detail booking pelanggan.
     */
    public function show(Booking $booking)
    {
        $booking->load('barber.user');

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Memperbarui status booking pelanggan.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:menunggu,sedang_dilayani,selesai,dibatalkan',
            ],
        ]);

        // Memperbarui status booking.
        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }


    /**
     * Memperbarui status antrean dari halaman Antrean.
     */
    public function updateStatusAntrean(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:sedang_dilayani,selesai,dibatalkan',
            ],
        ]);

        $statusSekarang = $booking->status;
        $statusTujuan = $validated['status'];

        // Menentukan perubahan status yang diperbolehkan.
        $transisiDiizinkan = [
            'menunggu' => ['sedang_dilayani', 'dibatalkan'],
            'sedang_dilayani' => ['selesai'],
        ];

        if (
            !in_array(
                $statusTujuan,
                $transisiDiizinkan[$statusSekarang] ?? [],
                true
            )
        ) {
            return back()->with(
                'error',
                'Perubahan status antrean tidak diperbolehkan.'
            );
        }

        $booking->update([
            'status' => $statusTujuan,
        ]);

        return back()->with(
            'success',
            'Status antrean berhasil diperbarui.'
        );
    }
}
