@extends('user.layouts.app')

@section('title', 'Katalog Produk')
@section('header', 'Katalog Produk Bouquet')

@section('content')
<div class="card" style="margin-bottom: var(--space-xl);">
    <form action="{{ route('user.produk.index') }}" method="GET" class="flex gap-md items-center">
        <div style="flex: 1;">
            <input type="text" name="search" class="form-input" placeholder="Cari nama produk..." value="{{ $search }}">
        </div>
        <div style="width: 250px;">
            <select name="kategori" class="form-input">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id_kategori }}" {{ $kategoriId == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('user.produk.index') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--space-xl);">
    @forelse($produks as $p)
        <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
            <div style="height: 200px; background-color: var(--color-surface-soft);">
                @if($p->foto_produk)
                    <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--color-mute);">No Image</div>
                @endif
            </div>
            <div style="padding: var(--space-lg); flex: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: var(--color-primary); font-weight: 600; margin-bottom: var(--space-xs);">
                    {{ $p->kategori->nama_kategori ?? 'Umum' }}
                </div>
                <h3 class="text-heading-md" style="margin-bottom: var(--space-xs);">{{ $p->nama_produk }}</h3>
                <div class="text-caption" style="margin-bottom: var(--space-md); flex: 1;">
                    {{ Str::limit($p->deskripsi_produk, 80) }}
                </div>
                <div class="flex justify-between items-center" style="margin-top: auto; padding-top: var(--space-md); border-top: 1px solid var(--color-hairline);">
                    <div class="text-body-strong">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</div>
                    <div class="text-caption" style="{{ $p->stok_rendah ? 'color: var(--color-error); font-weight: 600;' : '' }}">
                        Stok: {{ $p->stok_produk }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: var(--space-xxl); color: var(--color-mute);">
            Produk tidak ditemukan.
        </div>
    @endforelse
</div>

<div style="margin-top: var(--space-xl);">
    {{ $produks->links('pagination::bootstrap-4') }}
</div>
@endsection
