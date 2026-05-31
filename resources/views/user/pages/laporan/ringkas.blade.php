@extends('user.layouts.app')

@section('title', 'Laporan Ringkas')
@section('header', 'Laporan Penjualan (Pribadi)')

@section('content')
<div class="card" style="margin-bottom: var(--space-xl);">
    <form action="{{ route('user.laporan.ringkas') }}" method="GET" class="flex gap-md items-end">
        <div>
            <label class="form-label" style="font-size: 14px;">Pilih Tanggal</label>
            <input type="date" name="tanggal" class="form-input" value="{{ $tanggal }}" required max="{{ date('Y-m-d') }}">
        </div>
        <div style="margin-bottom: 2px;">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-xl);">
    <x-card-stat title="Total Transaksi" value="{{ number_format($totalTransaksi) }}" icon="📝" />
    <x-card-stat title="Item Terjual" value="{{ number_format($totalItem) }}" icon="💐" />
    <x-card-stat title="Total Setoran (Pendapatan)" value="Rp {{ number_format($totalPendapatan, 0, ',', '.') }}" icon="💰" />
</div>

<div class="card pin-card" style="padding: 0;">
    <div style="padding: var(--space-lg); border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
        <h3 class="text-heading-md" style="margin: 0;">Daftar Transaksi Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</h3>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 1px solid var(--color-hairline);">
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Waktu</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kode</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Pelanggan</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr style="border-bottom: 1px solid var(--color-hairline);">
                    <td style="padding: var(--space-md) var(--space-lg);">{{ $t->tanggal_transaksi->format('H:i') }}</td>
                    <td style="padding: var(--space-md) var(--space-lg); font-weight: 600;">
                        <a href="{{ route('user.transaksi.show', $t->id_transaksi) }}" style="color: var(--color-primary); text-decoration: none;">
                            {{ $t->kode_transaksi }}
                        </a>
                    </td>
                    <td style="padding: var(--space-md) var(--space-lg);">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada transaksi pada tanggal ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
