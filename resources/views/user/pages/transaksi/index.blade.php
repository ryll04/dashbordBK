@extends('user.layouts.app')

@section('title', 'Riwayat Transaksi Hari Ini')
@section('header', 'Riwayat Transaksi Saya (Hari Ini)')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0;">Daftar Transaksi</h2>
    <a href="{{ route('user.transaksi.create') }}" class="btn btn-primary">+ Buat Transaksi Baru (POS)</a>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kode</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Waktu</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Pelanggan</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Total (Rp)</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600; color: var(--color-primary);">{{ $t->kode_transaksi }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->tanggal_transaksi->format('H:i') }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600;">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right;">
                    <a href="{{ route('user.transaksi.show', $t->id_transaksi) }}" class="btn btn-secondary" style="height: 32px; padding: 0 10px;">Lihat Struk</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Belum ada transaksi hari ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: var(--space-xl);">
    {{ $transaksis->links('pagination::bootstrap-4') }}
</div>
@endsection
