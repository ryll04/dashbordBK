@extends('admin.layouts.app')

@section('title', 'Tambah Pengguna')
@section('header', 'Tambah Pengguna')

@section('content')
<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.pengguna.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="nama_lengkap">Nama Lengkap <span style="color: var(--color-error);">*</span></label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" value="{{ old('nama_lengkap') }}" required>
            @error('nama_lengkap')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="email">Email <span style="color: var(--color-error);">*</span></label>
            <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            @error('email')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="password">Password <span style="color: var(--color-error);">*</span></label>
            <input type="password" id="password" name="password" class="form-input" required minlength="6">
            <div class="text-caption" style="margin-top: 4px;">Minimal 6 karakter.</div>
            @error('password')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-lg" style="margin-bottom: var(--space-xl);">
            <div style="flex: 1;">
                <label class="form-label" for="peran">Peran <span style="color: var(--color-error);">*</span></label>
                <select id="peran" name="peran" class="form-input" required>
                    <option value="staf" {{ old('peran') == 'staf' ? 'selected' : '' }}>Staf / Kasir</option>
                    <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label class="form-label" for="status_aktif">Status <span style="color: var(--color-error);">*</span></label>
                <select id="status_aktif" name="status_aktif" class="form-input" required>
                    <option value="aktif" {{ old('status_aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_aktif') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom: var(--space-xl);">
            <label class="form-label" for="nomor_hp">Nomor HP</label>
            <input type="text" id="nomor_hp" name="nomor_hp" class="form-input" value="{{ old('nomor_hp') }}">
            @error('nomor_hp')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-md">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
