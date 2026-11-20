
@php
    $isEdit = isset($barber) && $barber !== null;
@endphp

{{-- Informasi Akun --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 px-4 pt-4">
        <h5 class="fw-bold mb-1">Informasi Akun</h5>
        <p class="text-muted small mb-0">
            Data akun yang digunakan barber untuk login.
        </p>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    Nama Lengkap <span class="text-danger">*</span>
                </label>

                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $barber?->user?->name) }}"
                       placeholder="Masukkan nama lengkap"
                       maxlength="100"
                       required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    Email <span class="text-danger">*</span>
                </label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $barber?->user?->email) }}"
                       placeholder="contoh@email.com"
                       maxlength="100"
                       required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nomor Telepon</label>

                <input type="text"
                       name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $barber?->user?->phone) }}"
                       placeholder="08xxxxxxxxxx"
                       maxlength="20">

                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    Password
                    @if(!$isEdit)
                        <span class="text-danger">*</span>
                    @endif
                </label>

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="{{ $isEdit ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 8 karakter' }}"
                       {{ $isEdit ? '' : 'required' }}>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($isEdit)
                    <small class="text-muted">
                        Kosongkan jika password tidak ingin diubah.
                    </small>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    Konfirmasi Password
                    @if(!$isEdit)
                        <span class="text-danger">*</span>
                    @endif
                </label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       {{ $isEdit ? '' : 'required' }}>
            </div>

        </div>
    </div>
</div>


{{-- Profil Barber --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-0 px-4 pt-4">
        <h5 class="fw-bold mb-1">Profil Barber</h5>
        <p class="text-muted small mb-0">
            Informasi profil yang digunakan untuk mengenalkan barber kepada pelanggan.
        </p>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="row g-4">

            <div class="col-md-6">
                <label class="form-label fw-semibold">Foto Barber</label>

                @if($isEdit && $barber->photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $barber->photo) }}"
                             alt="Foto Barber"
                             class="rounded-3 border"
                             width="120"
                             height="120"
                             style="object-fit: cover;">
                    </div>
                @endif

                <input type="file"
                       name="photo"
                       class="form-control @error('photo') is-invalid @enderror"
                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    @if($isEdit)
                        Kosongkan jika tidak ingin mengganti foto.
                    @endif
                </small>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Deskripsi / Keahlian</label>

                <textarea name="description"
                          rows="5"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Contoh: Spesialis fade haircut, taper, dan classic haircut.">{{ old('description', $barber?->description) }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($isEdit)
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Status Barber <span class="text-danger">*</span>
                    </label>

                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required>

                        <option value="aktif"
                            {{ old('status', $barber->status) === 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="cuti"
                            {{ old('status', $barber->status) === 'cuti' ? 'selected' : '' }}>
                            Cuti
                        </option>

                        <option value="berhenti"
                            {{ old('status', $barber->status) === 'berhenti' ? 'selected' : '' }}>
                            Berhenti
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Barber yang cuti atau berhenti tidak dapat login.
                    </small>
                </div>
            @endif

        </div>
    </div>
</div>


{{-- Tombol Aksi --}}
<div class="d-flex justify-content-end gap-2 mb-4">

    <a href="{{ route('admin.barber.index') }}"
       class="btn btn-outline-secondary">
        Batal
    </a>

    <button type="submit" class="btn btn-dark">
        <i class="bi bi-check-lg me-1"></i>
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Barber' }}
    </button>

</div>
