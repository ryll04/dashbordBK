@extends('admin.layouts.app')

@section('title', 'Manajemen Stok')
@section('header', 'Manajemen Stok Produk')

@section('content')
<div class="card" style="margin-bottom: var(--space-xl);">
    <form action="{{ route('admin.stok.index') }}" method="GET" class="flex justify-between items-center">
        <div class="flex gap-md items-center">
            <select name="id_produk" class="form-input" style="width: 300px;">
                <option value="">Semua Produk</option>
                @foreach($produks as $p)
                    <option value="{{ $p->id_produk }}" {{ request('id_produk') == $p->id_produk ? 'selected' : '' }}>
                        {{ $p->nama_produk }} (Stok: {{ $p->stok_produk }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.stok.index') }}" class="btn btn-secondary">Reset</a>
        </div>
        <a href="{{ route('admin.stok.create') }}" class="btn btn-primary">+ Sesuaikan Stok</a>
    </form>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Tanggal</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Produk</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Jenis</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Perubahan</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Stok Akhir</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Keterangan</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">User</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatStok as $rs)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg);">{{ $rs->tanggal_perubahan->format('d/m/Y H:i') }}</td>
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 500;">{{ $rs->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    @if($rs->jenis_perubahan == 'masuk')
                        <span style="color: var(--color-success-deep); font-weight: 600;">Masuk</span>
                    @elseif($rs->jenis_perubahan == 'keluar')
                        <span style="color: var(--color-error); font-weight: 600;">Keluar</span>
                    @else
                        <span style="color: var(--color-focus-outer); font-weight: 600;">Penyesuaian</span>
                    @endif
                </td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">
                    {{ $rs->jenis_perubahan == 'keluar' ? '-' : '+' }}{{ $rs->jumlah_perubahan }}
                </td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">{{ $rs->stok_sesudah }}</td>
                <td style="padding: var(--space-md) var(--space-lg); color: var(--color-mute);">{{ $rs->keterangan ?? '-' }}</td>
                <td style="padding: var(--space-md) var(--space-lg); color: var(--color-mute);">{{ $rs->pengguna->nama_lengkap ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada riwayat stok.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: var(--space-xl);">
    {{ $riwayatStok->links('pagination::bootstrap-4') }}
</div>
@endsection
