
@extends('Layouts.admin.app')

@section('title', 'Dashboard Barber')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h2 class="fw-bold">Dashboard Barber</h2>
            <p class="text-muted">
                Selamat datang, {{ auth()->user()->name }}.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold">Aktivitas Barber</h5>
                <p class="text-muted mb-0">
                    Halaman dashboard Barber sedang dalam tahap pengembangan.
                </p>
            </div>
        </div>
    </div>
@endsection
