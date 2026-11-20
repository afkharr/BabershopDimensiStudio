
@extends('Layouts.admin.app')

@section('title', 'Tambah Barber')

@section('content')

@php
    $barber = null;
@endphp

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <a href="{{ route('admin.barber.index') }}"
           class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Data Barber
        </a>

        <h4 class="fw-bold mt-3 mb-1">Tambah Barber</h4>

        <p class="text-muted mb-0">
            Tambahkan akun internal sekaligus profil barber baru.
        </p>
    </div>

    {{-- Informasi --}}
    <div class="alert alert-light border mb-4">
        <i class="bi bi-info-circle me-2"></i>
        Akun login dengan role Barber akan dibuat secara otomatis setelah data disimpan.
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.barber.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('barber._form')

    </form>

</div>

@endsection
