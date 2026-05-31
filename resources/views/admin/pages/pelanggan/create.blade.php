@extends('admin.layouts.app')

@section('title', 'Tambah Pelanggan')
@section('header', 'Tambah Pelanggan')

@section('content')
<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.pelanggan.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="nama_pelanggan">Nama Pelanggan <span style="color: var(--color-error);">*</span></label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-input" value="{{ old('nama_pelanggan') }}" required>
            @error('nama_pelanggan')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="nomor_telepon">Nomor Telepon <span style="color: var(--color-error);">*</span></label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-input" value="{{ old('nomor_telepon') }}" required>
            @error('nomor_telepon')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-input" rows="3">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-lg" style="margin-bottom: var(--space-xl);">
            <div style="flex: 1;">
                <label class="form-label" for="jenis_pelanggan">Jenis Pelanggan <span style="color: var(--color-error);">*</span></label>
                <select id="jenis_pelanggan" name="jenis_pelanggan" class="form-input" required>
                    <option value="baru" {{ old('jenis_pelanggan') == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="lama" {{ old('jenis_pelanggan') == 'lama' ? 'selected' : '' }}>Lama</option>
                </select>
                @error('jenis_pelanggan')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="flex: 1;">
                <label class="form-label" for="catatan">Catatan</label>
                <input type="text" id="catatan" name="catatan" class="form-input" value="{{ old('catatan') }}">
                @error('catatan')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex gap-md">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
