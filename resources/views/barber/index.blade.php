
@extends('Layouts.admin.app')

@section('title', 'Data Barber')

@section('content')

<div class="container-fluid py-4">

    {{-- Header halaman --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Barber</h4>
            <p class="text-muted mb-0">
                Kelola informasi dan status barber Demensi Studio.
            </p>
        </div>

        <a href="{{ route('admin.barber.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg me-2"></i>
            Tambah Barber
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Ringkasan Data --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Barber</p>
                            <h3 class="fw-bold mb-0">{{ $totalBarbers }}</h3>
                        </div>
                        <div class="rounded-3 bg-light p-3">
                            <i class="bi bi-people fs-4 text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Barber Aktif</p>
                            <h3 class="fw-bold mb-0">{{ $totalActive }}</h3>
                        </div>
                        <div class="rounded-3 bg-light p-3">
                            <i class="bi bi-person-check fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Sedang Cuti</p>
                            <h3 class="fw-bold mb-0">{{ $totalOnLeave }}</h3>
                        </div>
                        <div class="rounded-3 bg-light p-3">
                            <i class="bi bi-calendar-minus fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Berhenti</p>
                            <h3 class="fw-bold mb-0">{{ $totalResigned }}</h3>
                        </div>
                        <div class="rounded-3 bg-light p-3">
                            <i class="bi bi-person-x fs-4 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel Data Barber --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 pt-4 px-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div>
                    <h5 class="fw-bold mb-1">Daftar Barber</h5>
                    <p class="text-muted small mb-0">
                        Informasi seluruh barber yang terdaftar.
                    </p>
                </div>

                {{-- Pencarian dan filter --}}
                <form action="{{ route('admin.barber.index') }}"
                      method="GET"
                      class="d-flex flex-wrap gap-2">

                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Cari nama, email, atau HP..."
                           value="{{ request('q') }}">

                    <select name="status"
                            class="form-select"
                            onchange="this.form.submit()">

                        <option value="">Semua Status</option>

                        <option value="aktif"
                            {{ request('status') === 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="cuti"
                            {{ request('status') === 'cuti' ? 'selected' : '' }}>
                            Cuti
                        </option>

                        <option value="berhenti"
                            {{ request('status') === 'berhenti' ? 'selected' : '' }}>
                            Berhenti
                        </option>

                    </select>

                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-search"></i>
                    </button>

                    @if(request()->filled('q') || request()->filled('status'))
                        <a href="{{ route('admin.barber.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif

                </form>

            </div>
        </div>

        <div class="card-body px-4">

            <div class="table-responsive">
                <table class="table align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Barber</th>
                            <th>Kontak</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($barbers as $barber)

                            <tr>

                                {{-- Foto dan nama --}}
                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        @if($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}"
                                                 alt="Foto {{ $barber->user->name }}"
                                                 class="rounded-circle"
                                                 width="45"
                                                 height="45"
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                 style="width:45px;height:45px;">
                                                <i class="bi bi-person text-secondary fs-5"></i>
                                            </div>
                                        @endif

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $barber->user->name }}
                                            </div>
                                            <small class="text-muted">
                                                ID Barber #{{ $barber->id }}
                                            </small>
                                        </div>

                                    </div>
                                </td>

                                {{-- Kontak --}}
                                <td>
                                    <div>{{ $barber->user->email }}</div>
                                    <small class="text-muted">
                                        {{ $barber->user->phone ?? 'Belum ada nomor HP' }}
                                    </small>
                                </td>

                                {{-- Deskripsi --}}
                                <td>
                                    <span class="text-muted">
                                        {{ $barber->description
                                            ? \Illuminate\Support\Str::limit($barber->description, 45)
                                            : 'Belum ada deskripsi' }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($barber->status === 'aktif')
                                        <span class="badge bg-success-subtle text-success">
                                            Aktif
                                        </span>
                                    @elseif($barber->status === 'cuti')
                                        <span class="badge bg-warning-subtle text-warning-emphasis">
                                            Cuti
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">
                                            Berhenti
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="text-end">
                                    <a href="{{ route('admin.barber.edit', $barber->id) }}"
                                       class="btn btn-sm btn-outline-dark"
                                       title="Edit Barber">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-5">

                                    <div class="mb-3">
                                        <i class="bi bi-person-workspace fs-1 text-muted"></i>
                                    </div>

                                    <h6 class="fw-semibold">
                                        Belum Ada Data Barber
                                    </h6>

                                    <p class="text-muted small mb-3">
                                        Silakan tambahkan barber untuk mulai mengelola data.
                                    </p>

                                    <a href="{{ route('admin.barber.create') }}"
                                       class="btn btn-dark btn-sm">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Tambah Barber
                                    </a>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($barbers->hasPages())
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">

                    <small class="text-muted">
                        Menampilkan {{ $barbers->firstItem() ?? 0 }}
                        sampai {{ $barbers->lastItem() ?? 0 }}
                        dari {{ $barbers->total() }} data
                    </small>

                    {{ $barbers->links() }}

                </div>
            @endif

        </div>
    </div>

</div>

@endsection
