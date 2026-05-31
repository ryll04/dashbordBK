@extends('admin.layouts.app')

@section('title', 'Riwayat Transaksi')
@section('header', 'Riwayat Transaksi')

@section('content')
<div class="card" style="margin-bottom: var(--space-xl);">
    <form action="{{ route('admin.transaksi.index') }}" method="GET" class="flex gap-md items-center">
        <div>
            <label class="form-label" style="font-size: 14px;">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-input" value="{{ request('tanggal_mulai') }}">
        </div>
        <div>
            <label class="form-label" style="font-size: 14px;">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-input" value="{{ request('tanggal_akhir') }}">
        </div>
        <div style="margin-top: 28px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kode</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Tanggal</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Pelanggan</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Total (Rp)</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kasir</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600; color: var(--color-primary);">{{ $t->kode_transaksi }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600;">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                <td style="padding: var(--space-md) var(--space-lg); color: var(--color-mute);">{{ $t->pengguna->nama_lengkap ?? '-' }}</td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right;">
                    <a href="{{ route('admin.transaksi.show', $t->id_transaksi) }}" class="btn btn-secondary" style="height: 32px; padding: 0 10px;">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: var(--space-xl);">
    {{ $transaksis->links('pagination::bootstrap-4') }}
</div>
@endsection
