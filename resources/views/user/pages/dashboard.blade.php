@extends('user.layouts.app')

@section('title', 'Dashboard Staf')
@section('header', 'Dashboard Kasir')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <div>
        <h2 class="text-heading-md" style="margin: 0; margin-bottom: 4px;">Selamat Datang, {{ Auth::user()->nama_lengkap }}</h2>
        <div class="text-caption">Cek performa penjualan Anda hari ini.</div>
    </div>
    <div>
        <a href="{{ route('user.transaksi.create') }}" class="btn btn-primary">Buka POS Baru</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-xxl);">
    <x-card-stat title="Transaksi Anda Hari Ini" value="{{ number_format($totalTransaksiHariIni) }}" icon="📝" trend="Berdasarkan shift berjalan" :trendUp="true" />
    <x-card-stat title="Pendapatan Masuk (Anda)" value="Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}" icon="💳" trend="Disetor ke pusat" :trendUp="true" />
</div>

<div class="card pin-card" style="padding: 0;">
    <div style="padding: var(--space-lg); border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
        <h3 class="text-heading-md" style="margin: 0;">Transaksi Terakhir (Oleh Anda)</h3>
    </div>
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kode</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Waktu</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Pelanggan</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksisTerakhir as $t)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600; color: var(--color-primary);">{{ $t->kode_transaksi }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 600;">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Belum ada riwayat transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding: var(--space-md) var(--space-lg); text-align: right; background-color: var(--color-surface-soft); border-top: 1px solid var(--color-hairline);">
        <a href="{{ route('user.transaksi.index') }}" class="text-caption" style="color: var(--color-primary); text-decoration: underline;">Lihat Semua Riwayat</a>
    </div>
</div>
@endsection
