@extends('Layouts.admin.app')

@section('title', 'Antrean')

@section('content')

    <style>
        .queue-page {
            padding: 8px 0 25px;
            color: #171717;
        }

        .queue-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 28px;
        }

        .queue-eyebrow {
            color: #929292;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .queue-heading {
            font-size: 27px;
            font-weight: 750;
            letter-spacing: -1px;
            margin-bottom: 7px;
            color: #171717;
        }

        .queue-description {
            color: #888;
            font-size: 13px;
            margin: 0;
        }

        .queue-date {
            display: flex;
            align-items: center;
            gap: 11px;
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 12px 16px;
        }

        .queue-date-icon {
            width: 37px;
            height: 37px;
            border-radius: 9px;
            background: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #222;
            font-size: 16px;
        }

        .queue-date small {
            display: block;
            color: #999;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .queue-date strong {
            font-size: 12px;
            font-weight: 650;
        }

        /* STATISTICS */

        .queue-stat-card {
            background: #fff;
            border: 1px solid #ededed;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
            transition: .2s ease;
            position: relative;
            overflow: hidden;
        }

        .queue-stat-card:hover {
            border-color: #c8c8c8;
            transform: translateY(-3px);
            box-shadow: 0 9px 25px rgba(0, 0, 0, .045);
        }

        .queue-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .queue-stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f3f3;
            border-radius: 11px;
            font-size: 18px;
            color: #252525;
        }

        .queue-stat-number {
            font-size: 31px;
            line-height: 1;
            font-weight: 750;
            letter-spacing: -1.5px;
            color: #171717;
            margin-bottom: 7px;
        }

        .queue-stat-label {
            font-size: 12px;
            color: #777;
            font-weight: 600;
        }

        .queue-stat-line {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: #e8e8e8;
        }

        .queue-stat-line.dark {
            background: #202020;
        }

        /* MAIN PANEL */

        .queue-panel {
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 22px rgba(0, 0, 0, .025);
        }

        .queue-panel-header {
            padding: 23px 25px;
            border-bottom: 1px solid #eeeeee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .queue-panel-title {
            font-size: 16px;
            font-weight: 750;
            color: #191919;
            margin-bottom: 5px;
        }

        .queue-panel-subtitle {
            color: #999;
            font-size: 11px;
            margin: 0;
        }

        .queue-count {
            border: 1px solid #e9e9e9;
            background: #f8f8f8;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 11px;
            color: #555;
            font-weight: 650;
            white-space: nowrap;
        }

        .queue-panel-body {
            padding: 22px 25px 25px;
        }

        /* FILTER */

        .queue-filter {
            background: #f8f8f8;
            border: 1px solid #eeeeee;
            border-radius: 11px;
            padding: 12px;
            margin-bottom: 22px;
        }

        .queue-filter .form-control {
            height: 42px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            font-size: 12px;
            background: #fff;
            box-shadow: none;
        }

        .queue-filter .form-control:focus {
            border-color: #777;
        }

        .queue-search-btn {
            height: 42px;
            border-radius: 8px;
            background: #171717;
            border: 1px solid #171717;
            color: #fff;
            font-size: 12px;
            font-weight: 650;
            transition: .2s;
        }

        .queue-search-btn:hover {
            background: #383838;
            color: #fff;
        }

        .queue-reset-btn {
            height: 42px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #dedede;
            border-radius: 8px;
            background: #fff;
            color: #555;
            font-size: 12px;
            text-decoration: none;
        }

        .queue-reset-btn:hover {
            background: #eeeeee;
            color: #171717;
        }

        /* TABLE */

        .queue-table {
            margin-bottom: 0;
            min-width: 850px;
        }

        .queue-table thead th {
            background: #f8f8f8;
            color: #858585;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .7px;
            padding: 14px 13px;
            border-top: 1px solid #eeeeee;
            border-bottom: 1px solid #e9e9e9;
            white-space: nowrap;
        }

        .queue-table tbody td {
            padding: 17px 13px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px;
        }

        .queue-table tbody tr:hover {
            background: #fafafa;
        }

        .queue-row-number {
            color: #aaa;
            font-size: 11px;
            font-weight: 600;
        }

        .queue-ticket {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 57px;
            padding: 9px 10px;
            border: 1px dashed #bdbdbd;
            border-radius: 7px;
            background: #f8f8f8;
            color: #171717;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .queue-booking-code {
            font-size: 11px;
            color: #555;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .queue-customer-name {
            color: #222;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .queue-customer-phone {
            color: #999;
            font-size: 10px;
        }

        .queue-barber {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-weight: 600;
        }

        .queue-barber-icon {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eeeeee;
            color: #444;
            font-size: 12px;
        }

        .queue-time {
            font-size: 13px;
            font-weight: 750;
            color: #252525;
        }

        /* STATUS */

        .queue-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .queue-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-waiting {
            background: #f7f1df;
            color: #98751f;
        }

        .status-serving {
            background: #e9eef5;
            color: #496486;
        }

        .status-done {
            background: #e9f2ec;
            color: #477457;
        }

        .status-cancelled {
            background: #f3e9e9;
            color: #9b5555;
        }

        .queue-table .btn {
            border-radius: 7px;
            font-size: 10px;
            font-weight: 650;
            padding: 8px 11px;
            white-space: nowrap;
        }

        /* EMPTY STATE */

        .queue-empty {
            padding: 65px 20px !important;
            text-align: center;
        }

        .queue-empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 17px;
            border-radius: 18px;
            background: #f3f3f3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            color: #777;
        }

        .queue-empty h5 {
            font-size: 15px;
            font-weight: 750;
            color: #252525;
            margin-bottom: 7px;
        }

        .queue-empty p {
            color: #999;
            font-size: 12px;
            margin: 0;
        }

        .queue-pagination {
            margin-top: 20px;
        }

        .queue-pagination nav {
            display: flex;
            justify-content: flex-end;
        }


        /* RESPONSIVE */

        @media (max-width: 767px) {
            .queue-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .queue-date {
                width: 100%;
            }

            .queue-heading {
                font-size: 23px;
            }

            .queue-panel-header {
                padding: 18px;
            }

            .queue-panel-body {
                padding: 15px;
            }

            .queue-stat-card {
                padding: 16px;
            }

            .queue-stat-number {
                font-size: 27px;
            }
        }
    </style>

    <div class="page-content queue-page">

        {{-- HEADER --}}
        <div class="queue-header">

            <div>
                <div class="queue-eyebrow">
                    Demensi Studio / Workspace
                </div>

                <h3 class="queue-heading">
                    Antrean Pelanggan
                </h3>

                <p class="queue-description">
                    Pantau aktivitas dan kelola antrean pelanggan studio.
                </p>
            </div>

            <div class="queue-date">
                <div class="queue-date-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div>
                    <small>TANGGAL ANTREAN</small>
                    <strong>
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                    </strong>
                </div>
            </div>

        </div>


        {{-- STATISTICS --}}
        <div class="row mb-4">

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="queue-stat-card">
                    <div class="queue-stat-top">
                        <div class="queue-stat-icon">
                            <i class="bi bi-ticket-perforated"></i>
                        </div>
                        <i class="bi bi-three-dots text-muted"></i>
                    </div>

                    <div class="queue-stat-number">{{ $totalAntrean }}</div>
                    <div class="queue-stat-label">Total Antrean</div>
                    <div class="queue-stat-line dark"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="queue-stat-card">
                    <div class="queue-stat-top">
                        <div class="queue-stat-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <i class="bi bi-three-dots text-muted"></i>
                    </div>

                    <div class="queue-stat-number">{{ $totalMenunggu }}</div>
                    <div class="queue-stat-label">Menunggu</div>
                    <div class="queue-stat-line"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="queue-stat-card">
                    <div class="queue-stat-top">
                        <div class="queue-stat-icon">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <i class="bi bi-three-dots text-muted"></i>
                    </div>

                    <div class="queue-stat-number">{{ $totalDilayani }}</div>
                    <div class="queue-stat-label">Sedang Dilayani</div>
                    <div class="queue-stat-line"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="queue-stat-card">
                    <div class="queue-stat-top">
                        <div class="queue-stat-icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <i class="bi bi-three-dots text-muted"></i>
                    </div>

                    <div class="queue-stat-number">{{ $totalSelesai }}</div>
                    <div class="queue-stat-label">Selesai Dilayani</div>
                    <div class="queue-stat-line"></div>
                </div>
            </div>

        </div>


        {{-- MAIN QUEUE PANEL --}}
        <div class="queue-panel">

            <div class="queue-panel-header">

                <div>
                    <div class="queue-panel-title">
                        Daftar Antrean
                    </div>

                    <p class="queue-panel-subtitle">
                        Informasi pelanggan berdasarkan jadwal booking.
                    </p>
                </div>

                <div class="queue-count">
                    <i class="bi bi-list-ul me-1"></i>
                    {{ $antrean->total() }} Data
                </div>

            </div>


            <div class="queue-panel-body">

                {{-- FILTER --}}
                <form action="{{ route('admin.antrean.index') }}" method="GET" class="queue-filter">

                    <div class="row g-2">

                        <div class="col-lg-5 col-md-12">
                            <input type="text" name="q" class="form-control"
                                placeholder="Cari nama, nomor HP, atau kode booking..." value="{{ request('q') }}">
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <button type="submit" class="btn queue-search-btn w-100">
                                <i class="bi bi-search me-1"></i>
                                Cari
                            </button>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <a href="{{ route('admin.antrean.index') }}" class="queue-reset-btn">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>
                                Reset
                            </a>
                        </div>

                    </div>

                </form>


                {{-- TABLE --}}
                <div class="table-responsive">

                    <table class="table queue-table">

                        <thead>
                            <tr>
                                <th style="width: 55px;">No.</th>
                                <th>Nomor Antrean</th>
                                <th>Kode Booking</th>
                                <th>Pelanggan</th>
                                <th>Barber</th>
                                <th>Jam Booking</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse ($antrean as $item)

                                <tr>

                                    {{-- Nomor urutan data --}}
                                    <td>
                                        <span class="queue-row-number">
                                            {{ $antrean->firstItem() + $loop->index }}
                                        </span>
                                    </td>

                                    {{-- Nomor antrean --}}
                                    <td>
                                        <span class="queue-ticket">
                                            {{ str_pad($item->nomor_antrean, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    {{-- Kode booking --}}
                                    <td>
                                        <span class="queue-booking-code">
                                            {{ $item->kode_booking }}
                                        </span>
                                    </td>

                                    {{-- Informasi pelanggan --}}
                                    <td>
                                        <div class="queue-customer-name">
                                            {{ $item->nama_customer }}
                                        </div>

                                        <div class="queue-customer-phone">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $item->no_hp }}
                                        </div>
                                    </td>

                                    {{-- Informasi barber --}}
                                    <td>
                                        <div class="queue-barber">
                                            <span class="queue-barber-icon">
                                                <i class="bi bi-person"></i>
                                            </span>

                                            {{ $item->barber?->user?->name ?? 'Barber tidak ditemukan' }}
                                        </div>
                                    </td>

                                    {{-- Jam booking --}}
                                    <td>
                                        <span class="queue-time">
                                            {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}
                                        </span>
                                    </td>

                                    {{-- Status antrean --}}
                                    <td>

                                        @if ($item->status === 'menunggu')

                                            <span class="queue-status status-waiting">
                                                Menunggu
                                            </span>

                                        @elseif ($item->status === 'sedang_dilayani')

                                            <span class="queue-status status-serving">
                                                Sedang Dilayani
                                            </span>

                                        @elseif ($item->status === 'selesai')

                                            <span class="queue-status status-done">
                                                Selesai
                                            </span>

                                        @elseif ($item->status === 'dibatalkan')

                                            <span class="queue-status status-cancelled">
                                                Dibatalkan
                                            </span>

                                        @else

                                            <span class="queue-status status-cancelled">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>

                                    {{-- AKSI ANTREAN --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            @if ($item->status === 'menunggu')

                                                {{-- Mulai melayani --}}
                                                <form action="{{ route('admin.antrean.update-status', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Mulai melayani pelanggan ini?')">

                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="sedang_dilayani">

                                                    <button type="submit" class="btn btn-sm btn-dark">
                                                        <i class="bi bi-play-fill"></i>
                                                        Mulai
                                                    </button>
                                                </form>

                                                {{-- Batalkan antrean --}}
                                                <form action="{{ route('admin.antrean.update-status', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Batalkan antrean ini?')">

                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="dibatalkan">

                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Batalkan antrean">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </form>

                                            @elseif ($item->status === 'sedang_dilayani')

                                                {{-- Selesaikan pelayanan --}}
                                                <form action="{{ route('admin.antrean.update-status', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Selesaikan pelayanan pelanggan ini?')">

                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status" value="selesai">

                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-lg"></i>
                                                        Selesai
                                                    </button>
                                                </form>

                                            @else

                                                <span class="text-muted">
                                                    Tidak ada aksi
                                                </span>

                                            @endif

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="queue-empty">

                                        <div class="queue-empty-icon">
                                            <i class="bi bi-calendar2-x"></i>
                                        </div>

                                        <h5>Belum Ada Antrean</h5>

                                        <p>
                                            Belum ada antrean pelanggan pada tanggal ini.
                                            Data akan muncul setelah booking tersedia.
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>


                    </table>

                </div>


                {{-- PAGINATION --}}
                @if ($antrean->hasPages())
                    <div class="queue-pagination">
                        {{ $antrean->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection