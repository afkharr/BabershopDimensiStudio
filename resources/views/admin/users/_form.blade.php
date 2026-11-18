
@php($isEdit = isset($user) && $user->exists)

<div class="user-form-grid">
    <div class="row g-3">

        <div class="col-md-6">
            <label for="name" class="form-label">Nama lengkap <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" maxlength="100"
                value="{{ old('name', $user->name ?? '') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Masukkan nama lengkap" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Alamat email <span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" maxlength="100"
                value="{{ old('email', $user->email ?? '') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="nama@email.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Nomor HP</label>
            <input type="text" id="phone" name="phone" maxlength="20"
                value="{{ old('phone', $user->phone ?? '') }}"
                class="form-control @error('phone') is-invalid @enderror"
                placeholder="08xxxxxxxxxx">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="role" class="form-label">Peran akun <span class="text-danger">*</span></label>
            <select id="role" name="role"
                class="form-select @error('role') is-invalid @enderror" required>
                <option value="">Pilih peran</option>
                <option value="owner" @selected(old('role', $user->role ?? '') === 'owner')>Owner</option>
                <option value="barber" @selected(old('role', $user->role ?? '') === 'barber')>Barber</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label">
                Password
                @if(!$isEdit)
                    <span class="text-danger">*</span>
                @endif
            </label>
            <input type="password" id="password" name="password"
                autocomplete="new-password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
                @required(!$isEdit)>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if($isEdit)
                <div class="form-text">Biarkan kosong jika password tidak ingin diganti.</div>
            @endif
        </div>

        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">
                Konfirmasi password
                @if(!$isEdit)
                    <span class="text-danger">*</span>
                @endif
            </label>
            <input type="password" id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                class="form-control"
                placeholder="Ulangi password"
                @required(!$isEdit)>
        </div>

    </div>
</div>

<div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
    <button type="submit" class="user-primary">
        <i class="bi bi-check2"></i>
        {{ $isEdit ? 'Simpan perubahan' : 'Buat akun' }}
    </button>

    <a href="{{ route('admin.users.index') }}" class="user-secondary">
        Batal
    </a>
</div>
