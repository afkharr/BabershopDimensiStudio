@extends('Layouts.admin.app')

@section('title', 'Tambah Akun')

@push('styles')
<style>
.user-form-page{max-width:900px}.user-form-page .form-shell{background:#fff;border:1px solid #e9e9e6;border-radius:15px;overflow:hidden}.user-form-page .form-shell-head{padding:21px 24px;border-bottom:1px solid #e9e9e6}.user-form-page .form-shell-head h2{font-size:1rem;font-weight:800;margin:0}.user-form-page .form-shell-head p{font-size:.76rem;color:#888;margin:5px 0 0}.user-form-page .form-shell-body{padding:24px}.user-form-page .form-label{font-size:.76rem;font-weight:750;color:#333}.user-form-page .form-control,.user-form-page .form-select{min-height:43px;border-color:#e2e2df;border-radius:8px;font-size:.8rem;box-shadow:none}.user-form-page .form-control:focus,.user-form-page .form-select:focus{border-color:#999;box-shadow:0 0 0 3px rgba(0,0,0,.045)}.user-form-page .user-primary{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;background:#171717;color:#fff;border:1px solid #171717;border-radius:8px;text-decoration:none;font-size:.78rem;font-weight:750}.user-form-page .user-secondary{display:inline-flex;align-items:center;padding:10px 15px;border:1px solid #e2e2df;border-radius:8px;color:#555;text-decoration:none;font-size:.78rem;font-weight:700}.user-form-page .user-secondary:hover{background:#f5f5f3}.user-form-page .form-intro{margin-bottom:20px}.user-form-page .form-intro .eyebrow{font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#888;font-weight:800}.user-form-page .form-intro h1{font-size:1.8rem;font-weight:850;letter-spacing:-.05em;margin:6px 0}.user-form-page .form-intro p{font-size:.82rem;color:#888;margin:0}
</style>
@endpush

@section('content')
<div class="user-form-page">
    <div class="form-intro"><div class="eyebrow">Studio data / Akun internal</div><h1>Tambah akun baru</h1><p>Buat akses dashboard untuk owner atau barber Demensi Studio.</p></div>
    @if($errors->any())<div class="alert alert-danger small"><strong>Periksa kembali data yang dimasukkan.</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <section class="form-shell">
        <div class="form-shell-head"><h2>Informasi akun</h2><p>Kolom bertanda <span class="text-danger">*</span> wajib diisi.</p></div>
        <div class="form-shell-body"><form action="{{ route('admin.users.store') }}" method="POST">@csrf @include('admin.users._form', ['user' => new \App\Models\User()])</form></div>
    </section>
</div>
@endsection
