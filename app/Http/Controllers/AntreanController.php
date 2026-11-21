<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntreanController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil tanggal yang dipilih.
        // Jika tidak ada, gunakan tanggal hari ini.
        $tanggal = $request->tanggal ?? Carbon::today()->toDateString();

        // Mengambil data booking berdasarkan tanggal.
        $query = Booking::with('barber.user')
            ->whereDate('tanggal', $tanggal)
            ->where('status', '!=', 'dibatalkan');

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

        // Urutkan antrean berdasarkan jam dan nomor antrean.
        $antrean = $query->orderBy('jam', 'asc')
            ->orderBy('nomor_antrean', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Menghitung ringkasan antrean berdasarkan tanggal.
        $totalAntrean = Booking::whereDate('tanggal', $tanggal)
            ->where('status', '!=', 'dibatalkan')
            ->count();

        $totalMenunggu = Booking::whereDate('tanggal', $tanggal)
            ->where('status', 'menunggu')
            ->count();

        $totalDilayani = Booking::whereDate('tanggal', $tanggal)
            ->where('status', 'sedang_dilayani')
            ->count();

        $totalSelesai = Booking::whereDate('tanggal', $tanggal)
            ->where('status', 'selesai')
            ->count();

        return view('admin.antrean.index', compact(
            'antrean',
            'tanggal',
            'totalAntrean',
            'totalMenunggu',
            'totalDilayani',
            'totalSelesai'
        ));
    }
}
