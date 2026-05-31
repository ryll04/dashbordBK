@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Bouquet')

@section('content')
<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="flex gap-lg" style="margin-bottom: var(--space-lg);">
            <div style="flex: 1;">
                <label class="form-label" for="nama_produk">Nama Produk <span style="color: var(--color-error);">*</span></label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-input" value="{{ old('nama_produk') }}" required>
                @error('nama_produk')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="flex: 1;">
                <label class="form-label" for="id_kategori">Kategori <span style="color: var(--color-error);">*</span></label>
                <select id="id_kategori" name="id_kategori" class="form-input" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="deskripsi_produk">Deskripsi</label>
            <textarea id="deskripsi_produk" name="deskripsi_produk" class="form-input" rows="4">{{ old('deskripsi_produk') }}</textarea>
            @error('deskripsi_produk')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-lg" style="margin-bottom: var(--space-lg);">
            <div style="flex: 1;">
                <label class="form-label" for="harga_produk">Harga (Rp) <span style="color: var(--color-error);">*</span></label>
                <input type="number" id="harga_produk" name="harga_produk" class="form-input" value="{{ old('harga_produk') }}" required min="0">
                @error('harga_produk')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="flex: 1;">
                <label class="form-label" for="stok_produk">Stok Awal <span style="color: var(--color-error);">*</span></label>
                <input type="number" id="stok_produk" name="stok_produk" class="form-input" value="{{ old('stok_produk', 0) }}" required min="0">
                @error('stok_produk')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            <div style="flex: 1;">
                <label class="form-label" for="batas_stok_rendah">Batas Stok Rendah <span style="color: var(--color-error);">*</span></label>
                <input type="number" id="batas_stok_rendah" name="batas_stok_rendah" class="form-input" value="{{ old('batas_stok_rendah', 5) }}" required min="1">
                @error('batas_stok_rendah')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex gap-lg" style="margin-bottom: var(--space-xl);">
            <div style="flex: 1;">
                <label class="form-label" for="foto_produk">Foto Produk</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-input" accept="image/*">
                @error('foto_produk')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="flex: 1;">
                <label class="form-label" for="status_produk">Status <span style="color: var(--color-error);">*</span></label>
                <select id="status_produk" name="status_produk" class="form-input" required>
                    <option value="aktif" {{ old('status_produk') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_produk') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status_produk')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="flex gap-md">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
