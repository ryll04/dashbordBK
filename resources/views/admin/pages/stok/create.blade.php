@extends('admin.layouts.app')

@section('title', 'Penyesuaian Stok')
@section('header', 'Penyesuaian Stok')

@section('content')
<div class="card" style="max-width: 600px;">
    <form action="{{ route('admin.stok.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: var(--space-lg);">
            <label class="form-label" for="id_produk">Pilih Produk <span style="color: var(--color-error);">*</span></label>
            <select id="id_produk" name="id_produk" class="form-input" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $p)
                    <option value="{{ $p->id_produk }}" {{ old('id_produk') == $p->id_produk ? 'selected' : '' }}>
                        {{ $p->nama_produk }} (Sisa: {{ $p->stok_produk }})
                    </option>
                @endforeach
            </select>
            @error('id_produk')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-lg" style="margin-bottom: var(--space-lg);">
            <div style="flex: 1;">
                <label class="form-label" for="jenis_perubahan">Jenis Perubahan <span style="color: var(--color-error);">*</span></label>
                <select id="jenis_perubahan" name="jenis_perubahan" class="form-input" required>
                    <option value="masuk" {{ old('jenis_perubahan') == 'masuk' ? 'selected' : '' }}>Stok Masuk (+)</option>
                    <option value="keluar" {{ old('jenis_perubahan') == 'keluar' ? 'selected' : '' }}>Stok Keluar (-)</option>
                    <option value="penyesuaian" {{ old('jenis_perubahan') == 'penyesuaian' ? 'selected' : '' }}>Penyesuaian (Timpa Stok Akhir)</option>
                </select>
                @error('jenis_perubahan')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="flex: 1;">
                <label class="form-label" for="jumlah">Jumlah / Nilai Akhir <span style="color: var(--color-error);">*</span></label>
                <input type="number" id="jumlah" name="jumlah" class="form-input" value="{{ old('jumlah') }}" required min="0">
                @error('jumlah')
                    <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: var(--space-xl);">
            <label class="form-label" for="keterangan">Keterangan Tambahan</label>
            <textarea id="keterangan" name="keterangan" class="form-input" rows="3" placeholder="Contoh: Barang retur, stok opname mingguan, dll">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-md">
            <button type="submit" class="btn btn-primary">Simpan Penyesuaian</button>
            <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
