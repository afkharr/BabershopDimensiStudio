
@extends('Layouts.admin.app')

@section('title', 'Jadwal Barber')

@section('content')

<style>
    .days-off-page {
        padding: 25px;
    }

    .days-off-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .days-off-header h4 {
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .days-off-header p {
        color: #888;
        margin: 0;
        font-size: 13px;
    }

    .days-off-card {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 22px;
    }

    .days-off-summary {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .days-off-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #222;
    }

    .days-off-summary small {
        color: #888;
        font-size: 12px;
    }

    .days-off-summary h3 {
        margin: 3px 0 0;
        font-weight: 700;
        color: #222;
    }

    .days-off-table th {
        color: #777;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 15px;
        white-space: nowrap;
    }

    .days-off-table td {
        padding: 15px;
        vertical-align: middle;
        font-size: 13px;
    }

    .barber-name {
        font-weight: 600;
        color: #222;
    }

    .days-off-date {
        font-weight: 600;
        color: #333;
    }

    .days-off-badge {
        background: #f1f1f1;
        color: #333;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
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

    .btn-action {
        width: 32px;
        height: 32px;
        border: 1px solid #e5e5e5;
        border-radius: 6px;
        background: #fff;
        color: #555;
    }

    .btn-action:hover {
        background: #f1f1f1;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #444;
    }

    .form-control,
    .form-select {
        font-size: 13px;
        padding: 10px 12px;
        border-radius: 7px;
    }

    .empty-days-off {
        text-align: center;
        padding: 45px 15px;
        color: #999;
    }

    .empty-days-off i {
        font-size: 35px;
        display: block;
        margin-bottom: 12px;
    }
</style>

<div class="days-off-page">

    {{-- Header Halaman --}}
    <div class="days-off-header">

        <div>
            <h4>Jadwal Barber</h4>
            <p>Kelola tanggal libur dan ketersediaan barber Demensi Studio.</p>
        </div>

        <button type="button" class="btn btn-studio"
            data-bs-toggle="modal" data-bs-target="#addDaysOffModal">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Hari Libur

        </button>

    </div>


    {{-- Notifikasi Berhasil --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Notifikasi Validasi --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Ringkasan --}}
    <div class="days-off-card">

        <div class="days-off-summary">

            <div class="days-off-icon">
                <i class="bi bi-calendar2-x"></i>
            </div>

            <div>
                <small>Total Jadwal Hari Libur</small>
                <h3>{{ $totalDaysOff }}</h3>
            </div>

        </div>

    </div>


    {{-- Daftar Hari Libur --}}
    <div class="days-off-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h5 class="fw-bold mb-1">Daftar Hari Libur</h5>
                <small class="text-muted">
                    Daftar tanggal ketika barber tidak menerima booking.
                </small>
            </div>

            {{-- Pencarian dan Filter --}}
            <form action="{{ route('admin.barber-days-off.index') }}"
                method="GET"
                class="d-flex gap-2 flex-wrap">

                <input type="text"
                    name="q"
                    class="form-control"
                    placeholder="Cari nama barber..."
                    value="{{ request('q') }}"
                    style="width: 190px;">

                <select name="barber_id"
                    class="form-select"
                    style="width: 170px;">

                    <option value="">Semua Barber</option>

                    @foreach($barbers as $barber)
                        <option value="{{ $barber->id }}"
                            {{ request('barber_id') == $barber->id ? 'selected' : '' }}>
                            {{ $barber->user->name ?? 'Barber' }}
                        </option>
                    @endforeach

                </select>

                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-search"></i>
                </button>

                <a href="{{ route('admin.barber-days-off.index') }}"
                    class="btn btn-light border">
                    Reset
                </a>

            </form>

        </div>


        {{-- Tabel --}}
        <div class="table-responsive">

            <table class="table table-hover days-off-table mb-0">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barber</th>
                        <th>Tanggal Libur</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($daysOff as $index => $dayOff)

                        <tr>

                            <td>
                                {{ $daysOff->firstItem() + $index }}
                            </td>

                            <td>
                                <div class="barber-name">
                                    {{ $dayOff->barber->user->name ?? 'Barber tidak ditemukan' }}
                                </div>
                                <small class="text-muted">
                                    Barber Demensi Studio
                                </small>
                            </td>

                            <td>
                                <span class="days-off-date">
                                    {{ $dayOff->tanggal->translatedFormat('d F Y') }}
                                </span>
                            </td>

                            <td>
                                {{ $dayOff->keterangan ?: '-' }}
                            </td>

                            <td>
                                <span class="days-off-badge">
                                    <i class="bi bi-calendar-x me-1"></i>
                                    Hari Libur
                                </span>
                            </td>

                            <td class="text-center">

                                {{-- Tombol Edit --}}
                                <button type="button"
                                    class="btn-action"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDaysOff{{ $dayOff->id }}"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- Tombol Hapus --}}
                                <button type="button"
                                    class="btn-action"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteDaysOff{{ $dayOff->id }}"
                                    title="Hapus">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </td>

                        </tr>


                        {{-- Modal Edit --}}
                        <div class="modal fade"
                            id="editDaysOff{{ $dayOff->id }}"
                            tabindex="-1"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <form action="{{ route('admin.barber-days-off.update', $dayOff->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">
                                                Edit Hari Libur
                                            </h5>

                                            <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Barber</label>

                                                <input type="text"
                                                    class="form-control"
                                                    value="{{ $dayOff->barber->user->name ?? '-' }}"
                                                    disabled>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Libur</label>

                                                <input type="date"
                                                    name="tanggal"
                                                    class="form-control"
                                                    value="{{ $dayOff->tanggal->format('Y-m-d') }}"
                                                    min="{{ date('Y-m-d') }}"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Keterangan</label>

                                                <textarea name="keterangan"
                                                    class="form-control"
                                                    rows="3"
                                                    placeholder="Contoh: Ada keperluan pribadi">{{ $dayOff->keterangan }}</textarea>
                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button"
                                                class="btn btn-light border"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <button type="submit"
                                                class="btn btn-studio">
                                                Simpan Perubahan
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- Modal Hapus --}}
                        <div class="modal fade"
                            id="deleteDaysOff{{ $dayOff->id }}"
                            tabindex="-1"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <form action="{{ route('admin.barber-days-off.destroy', $dayOff->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-body text-center p-4">

                                            <div class="mb-3">
                                                <i class="bi bi-exclamation-circle text-danger"
                                                    style="font-size: 45px;"></i>
                                            </div>

                                            <h5 class="fw-bold">
                                                Hapus Jadwal Libur?
                                            </h5>

                                            <p class="text-muted small">
                                                Apakah kamu yakin ingin menghapus jadwal libur
                                                <strong>
                                                    {{ $dayOff->barber->user->name ?? 'Barber' }}
                                                </strong>
                                                pada tanggal
                                                <strong>
                                                    {{ $dayOff->tanggal->translatedFormat('d F Y') }}
                                                </strong>?
                                            </p>

                                            <div class="d-flex justify-content-center gap-2">

                                                <button type="button"
                                                    class="btn btn-light border"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <button type="submit"
                                                    class="btn btn-danger">
                                                    Ya, Hapus
                                                </button>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>
                            <td colspan="6">

                                <div class="empty-days-off">

                                    <i class="bi bi-calendar2-week"></i>

                                    <h6 class="fw-bold text-dark">
                                        Belum Ada Jadwal Libur
                                    </h6>

                                    <p class="small mb-0">
                                        Belum ada data hari libur barber yang ditambahkan.
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
            {{ $daysOff->withQueryString()->links() }}
        </div>

    </div>

</div>


{{-- Modal Tambah Hari Libur --}}
<div class="modal fade"
    id="addDaysOffModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('admin.barber-days-off.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title fw-bold">
                        Tambah Hari Libur
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <p class="text-muted small mb-4">
                        Tentukan barber dan tanggal ketika barber tidak tersedia untuk menerima booking.
                    </p>

                    <div class="mb-3">

                        <label class="form-label">
                            Pilih Barber
                        </label>

                        <select name="barber_id"
                            class="form-select"
                            required>

                            <option value="">-- Pilih Barber --</option>

                            @foreach($barbers as $barber)

                                <option value="{{ $barber->id }}"
                                    {{ old('barber_id') == $barber->id ? 'selected' : '' }}>

                                    {{ $barber->user->name ?? 'Barber' }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Libur
                        </label>

                        <input type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ old('tanggal') }}"
                            min="{{ date('Y-m-d') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea name="keterangan"
                            class="form-control"
                            rows="3"
                            placeholder="Contoh: Ada keperluan pribadi">{{ old('keterangan') }}</textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-studio">
                        <i class="bi bi-plus-lg me-1"></i>
                        Simpan Hari Libur
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
