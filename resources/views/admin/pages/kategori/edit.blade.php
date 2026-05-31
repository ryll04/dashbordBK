@extends('admin.layouts.app')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori Bouquet')

@section('content')
<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="nama_kategori">Nama Kategori <span style="color: var(--color-error);">*</span></label>
            <input type="text" id="nama_kategori" name="nama_kategori" class="form-input" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
            @error('nama_kategori')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="deskripsi_kategori">Deskripsi</label>
            <textarea id="deskripsi_kategori" name="deskripsi_kategori" class="form-input" rows="4">{{ old('deskripsi_kategori', $kategori->deskripsi_kategori) }}</textarea>
            @error('deskripsi_kategori')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: var(--space-xl);">
            <label class="form-label" for="status_kategori">Status</label>
            <select id="status_kategori" name="status_kategori" class="form-input">
                <option value="aktif" {{ old('status_kategori', $kategori->status_kategori) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status_kategori', $kategori->status_kategori) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status_kategori')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-md">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
