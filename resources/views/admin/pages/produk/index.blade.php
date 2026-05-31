@extends('admin.layouts.app')

@section('title', 'Produk Bouquet')
@section('header', 'Produk Bouquet')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0;">Daftar Produk</h2>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Foto</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Nama & Kategori</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Harga</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Stok</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Status</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produks as $p)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg);">
                    @if($p->foto_produk)
                        <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: var(--radius-sm);">
                    @else
                        <div style="width: 50px; height: 50px; background-color: var(--color-hairline); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 10px; color: var(--color-mute);">No Image</div>
                    @endif
                </td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <div style="font-weight: 600;">{{ $p->nama_produk }}</div>
                    <div style="font-size: 12px; color: var(--color-mute);">{{ $p->kategori->nama_kategori ?? '-' }}</div>
                </td>
                <td style="padding: var(--space-md) var(--space-lg);">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <div style="{{ $p->stok_rendah ? 'color: var(--color-error); font-weight: 600;' : '' }}">
                        {{ $p->stok_produk }}
                    </div>
                </td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <span style="display: inline-block; padding: 2px 8px; border-radius: var(--radius-full); font-size: 12px; font-weight: 600; background-color: {{ $p->status_produk == 'aktif' ? 'var(--color-success-pale)' : 'var(--color-secondary-bg)' }}; color: {{ $p->status_produk == 'aktif' ? 'var(--color-success-deep)' : 'var(--color-ink)' }};">
                        {{ ucfirst($p->status_produk) }}
                    </span>
                </td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right;">
                    <a href="{{ route('admin.produk.edit', $p->id_produk) }}" class="btn btn-secondary" style="height: 32px; padding: 0 10px;">Edit</a>
                    <form action="{{ route('admin.produk.destroy', $p->id_produk) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" style="height: 32px; padding: 0 10px; color: var(--color-error);">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada data produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
