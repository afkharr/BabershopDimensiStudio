
@extends('Layouts.admin.app')

@section('title', 'Detail Booking')

@section('content')

<style>
    .booking-detail-page {
        padding: 25px;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 22px;
    }

    .detail-label {
        color: #888;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #222;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-item:last-child {
        border-bottom: none;
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

    .detail-status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
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
</style>


<div class="booking-detail-page">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">Detail Booking</h4>

            <p class="text-muted small mb-0">
                Informasi lengkap pemesanan pelanggan.
            </p>
        </div>

        <a href="{{ route('admin.bookings.index') }}"
            class="btn btn-light border">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>
    @endif


    {{-- Informasi Utama --}}
    <div class="detail-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <div class="detail-label">Kode Booking</div>

                <h4 class="fw-bold mb-1">
                    {{ $booking->kode_booking }}
                </h4>

                <small class="text-muted">
                    Nomor antrean
                    <strong>
                        {{ str_pad($booking->nomor_antrean, 3, '0', STR_PAD_LEFT) }}
                    </strong>
                </small>
            </div>


            <div>

                <span class="detail-status status-{{ $booking->status }}">

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

            </div>

        </div>

    </div>


    <div class="row g-3">

        {{-- Informasi Pelanggan --}}
        <div class="col-lg-6">

            <div class="detail-card h-100">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-person me-2"></i>
                    Informasi Pelanggan
                </h5>


                <div class="detail-item">

                    <div class="detail-label">Nama Pelanggan</div>

                    <div class="detail-value">
                        {{ $booking->nama_customer }}
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">Nomor HP</div>

                    <div class="detail-value">
                        {{ $booking->no_hp }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Informasi Jadwal --}}
        <div class="col-lg-6">

            <div class="detail-card h-100">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-calendar-week me-2"></i>
                    Informasi Jadwal
                </h5>


                <div class="detail-item">

                    <div class="detail-label">Barber</div>

                    <div class="detail-value">
                        {{ $booking->barber->user->name ?? '-' }}
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">Tanggal Booking</div>

                    <div class="detail-value">
                        {{ $booking->tanggal->translatedFormat('d F Y') }}
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">Jam Booking</div>

                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($booking->jam)->format('H:i') }} WIB
                    </div>

                </div>

            </div>

        </div>


        {{-- Catatan Pelanggan --}}
        <div class="col-12">

            <div class="detail-card">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-chat-left-text me-2"></i>
                    Catatan Pelanggan
                </h5>

                <p class="mb-0 text-muted">

                    {{ $booking->catatan ?: 'Tidak ada catatan dari pelanggan.' }}

                </p>

            </div>

        </div>


        {{-- Pengelolaan Status --}}
        <div class="col-12">

            <div class="detail-card">

                <h5 class="fw-bold mb-2">
                    Pengelolaan Status Booking
                </h5>

                <p class="text-muted small">
                    Owner dapat memperbarui status pelayanan pelanggan melalui bagian ini.
                </p>


                <form action="{{ route('admin.bookings.update', $booking->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')


                    <div class="row g-3 align-items-end">

                        <div class="col-md-8">

                            <label class="form-label fw-semibold">
                                Status Booking
                            </label>

                            <select name="status" class="form-select" required>

                                <option value="menunggu"
                                    {{ $booking->status === 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="sedang_dilayani"
                                    {{ $booking->status === 'sedang_dilayani' ? 'selected' : '' }}>
                                    Sedang Dilayani
                                </option>

                                <option value="selesai"
                                    {{ $booking->status === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="dibatalkan"
                                    {{ $booking->status === 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>

                            </select>

                        </div>


                        <div class="col-md-4">

                            <button type="submit" class="btn btn-studio w-100">

                                <i class="bi bi-check-lg me-1"></i>
                                Perbarui Status

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
