
@extends('Layouts.admin.app')

@section('title', 'Edit Barber')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <a href="{{ route('admin.barber.index') }}"
           class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Data Barber
        </a>

        <h4 class="fw-bold mt-3 mb-1">Edit Data Barber</h4>

        <p class="text-muted mb-0">
            Perbarui informasi akun dan profil barber.
        </p>
    </div>

    {{-- Informasi Status --}}
    @if($barber->status === 'cuti')
        <div class="alert alert-warning border-0">
            <i class="bi bi-calendar-minus me-2"></i>
            Barber sedang cuti. Akun login dinonaktifkan sementara.
        </div>
    @elseif($barber->status === 'berhenti')
        <div class="alert alert-danger border-0">
            <i class="bi bi-person-x me-2"></i>
            Barber sudah berhenti bekerja. Akun login dinonaktifkan.
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.barber.update', $barber->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('barber._form')

    </form>

</div>

@endsection
