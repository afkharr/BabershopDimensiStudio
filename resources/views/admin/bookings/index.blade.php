
@extends('Layouts.admin.app')

@section('title', 'Booking Pelanggan')

@section('content')

<style>
    .booking-page {
        padding: 25px;
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .booking-header h4 {
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .booking-header p {
        color: #888;
        font-size: 13px;
        margin: 0;
    }

    .booking-card {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 22px;
    }

    .booking-summary {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .booking-summary-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: #f1f1f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        color: #222;
    }

    .booking-summary small {
        color: #888;
        font-size: 12px;
    }

    .booking-summary h3 {
        margin: 3px 0 0;
        font-size: 25px;
        font-weight: 700;
        color: #222;
    }

    .booking-table th {
        color: #777;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
        padding: 15px;
    }

    .booking-table td {
        padding: 15px;
        vertical-align: middle;
        font-size: 13px;
    }

    .booking-customer {
        font-weight: 600;
        color: #222;
    }

    .booking-code {
        font-size: 11px;
        color: #888;
    }

    .booking-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 32px;
        background: #f1f1f1;
        border-radius: 6px;
        font-weight: 700;
        color: #222;
    }

    .booking-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff3cd;
        color: #856404;
    }

    .status-sedang_dilayani {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-selesai {
        background: #d1fae5;
        color: #065f46;
    }

    .status-dibatalkan {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-booking-action {
        width: 33px;
        height: 33px;
        border: 1px solid #e5e5e5;
        border-radius: 6px;
        background: #fff;
        color: #555;
    }

    .btn-booking-action:hover {
        background: #f1f1f1;
    }

    .empty-booking {
        text-align: center;
        padding: 45px 15px;
        color: #999;
    }

    .empty-booking i {
        display: block;
        font-size: 38px;
        margin-bottom: 12px;
    }

    .booking-filter .form-control,
    .booking-filter .form-select {
        font-size: 13px;
        border-radius: 7px;
        min-height: 40px;
    }

    .btn-studio {
        background: #171717;
        color: #fff;
        border: 1px solid #171717;
        border-radius: 7px;
        padding: 9px 15px;
        font-size: 13px;
    }

    .btn-studio:hover {
        background: #333;
        color: #fff;
    }

    .booking-detail-link {
        color: #222;
        text-decoration: none;
        font-weight: 600;
    }

    .booking-detail-link:hover {
        text-decoration: underline;
    }
</style>


<div class="booking-page">

    {{-- Header Halaman --}}
    <div class="booking-header">

        <div>
            <h4>Booking Pelanggan</h4>
            <p>Kelola dan pantau seluruh pemesanan pelanggan Demensi Studio.</p>
        </div>

    </div>


    {{-- Notifikasi Berhasil --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    {{-- Notifikasi Validasi --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    {{-- Ringkasan Booking --}}
    <div class="row g-3 mb-3">

        <div class="col-6 col-xl">
            <div class="booking-card h-100">

                <div class="booking-summary">
                    <div class="booking-summary-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <div>
                        <small>Total Booking</small>
                        <h3>{{ $totalBookings }}</h3>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-6 col-xl">
            <div class="booking-card h-100">

                <div class="booking-summary">
                    <div class="booking-summary-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <div>
                        <small>Menunggu</small>
                        <h3>{{ $totalMenunggu }}</h3>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-6 col-xl">
            <div class="booking-card h-100">

                <div class="booking-summary">
                    <div class="booking-summary-icon">
                        <i class="bi bi-scissors"></i>
                    </div>

                    <div>
                        <small>Sedang Dilayani</small>
                        <h3>{{ $totalDilayani }}</h3>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-6 col-xl">
            <div class="booking-card h-100">

                <div class="booking-summary">
                    <div class="booking-summary-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div>
                        <small>Selesai</small>
                        <h3>{{ $totalSelesai }}</h3>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-6 col-xl">
            <div class="booking-card h-100">

                <div class="booking-summary">
                    <div class="booking-summary-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <div>
                        <small>Dibatalkan</small>
                        <h3>{{ $totalDibatalkan }}</h3>
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- Daftar Booking --}}
    <div class="booking-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div>
                <h5 class="fw-bold mb-1">Daftar Pemesanan</h5>

                <small class="text-muted">
                    Seluruh booking yang masuk dari pelanggan.
                </small>
            </div>

        </div>


        {{-- Filter dan Pencarian --}}
        <form action="{{ route('admin.bookings.index') }}"
            method="GET"
            class="booking-filter mb-4">

            <div class="row g-2">

                <div class="col-lg-3 col-md-6">
                    <input type="text"
                        name="q"
                        class="form-control"
                        placeholder="Nama, nomor HP, kode booking..."
                        value="{{ request('q') }}">
                </div>


                <div class="col-lg-2 col-md-6">
                    <select name="barber_id" class="form-select">

                        <option value="">Semua Barber</option>

                        @foreach($barbers as $barber)

                            <option value="{{ $barber->id }}"
                                {{ request('barber_id') == $barber->id ? 'selected' : '' }}>

                                {{ $barber->user->name ?? 'Barber' }}

                            </option>

                        @endforeach

                    </select>
                </div>


                <div class="col-lg-2 col-md-6">
                    <input type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ request('tanggal') }}">
                </div>


                <div class="col-lg-2 col-md-6">
                    <select name="status" class="form-select">

                        <option value="">Semua Status</option>

                        <option value="menunggu"
                            {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="sedang_dilayani"
                            {{ request('status') == 'sedang_dilayani' ? 'selected' : '' }}>
                            Sedang Dilayani
                        </option>

                        <option value="selesai"
                            {{ request('status') == 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="dibatalkan"
                            {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>

                    </select>
                </div>


                <div class="col-lg-3 col-md-6 d-flex gap-2">

                    <button type="submit" class="btn btn-studio flex-grow-1">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('admin.bookings.index') }}"
                        class="btn btn-light border">
                        Reset
                    </a>

                </div>

            </div>

        </form>


        {{-- Tabel Booking --}}
        <div class="table-responsive">

            <table class="table table-hover booking-table mb-0">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Booking</th>
                        <th>Pelanggan</th>
                        <th>Barber</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Antrean</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($bookings as $index => $booking)

                        <tr>

                            <td>
                                {{ $bookings->firstItem() + $index }}
                            </td>


                            <td>
                                <div class="booking-customer">
                                    {{ $booking->kode_booking }}
                                </div>
                                <div class="booking-code">
                                    ID: {{ $booking->id }}
                                </div>
                            </td>


                            <td>
                                <div class="booking-customer">
                                    {{ $booking->nama_customer }}
                                </div>
                                <small class="text-muted">
                                    {{ $booking->no_hp }}
                                </small>
                            </td>


                            <td>
                                {{ $booking->barber->user->name ?? '-' }}
                            </td>


                            <td>
                                {{ $booking->tanggal->translatedFormat('d M Y') }}
                            </td>


                            <td>
                                {{ \Carbon\Carbon::parse($booking->jam)->format('H:i') }}
                            </td>


                            <td>
                                <span class="booking-number">
                                    {{ str_pad($booking->nomor_antrean, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>


                            <td>
                                <span class="booking-status status-{{ $booking->status }}">

                                    @if($booking->status === 'menunggu')
                                        Menunggu
                                    @elseif($booking->status === 'sedang_dilayani')
                                        Sedang Dilayani
                                    @elseif($booking->status === 'selesai')
                                        Selesai
                                    @elseif($booking->status === 'dibatalkan')
                                        Dibatalkan
                                    @endif

                                </span>
                            </td>


                            <td class="text-center">

                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                    class="btn-booking-action d-inline-flex align-items-center justify-content-center"
                                    title="Detail Booking">

                                    <i class="bi bi-eye"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9">

                                <div class="empty-booking">

                                    <i class="bi bi-calendar2-x"></i>

                                    <h6 class="fw-bold text-dark">
                                        Belum Ada Booking
                                    </h6>

                                    <p class="small mb-0">
                                        Belum ada pemesanan pelanggan yang masuk ke sistem.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="mt-4">

            {{ $bookings->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection
