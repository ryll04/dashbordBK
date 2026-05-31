@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan')
@section('header', 'Laporan Penjualan')

@section('content')
<div class="card" style="margin-bottom: var(--space-xl);">
    <form action="{{ route('admin.laporan.penjualan') }}" method="GET" class="flex justify-between items-end">
        <div class="flex gap-md">
            <div>
                <label class="form-label" style="font-size: 14px;">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-input" value="{{ $tanggalMulai }}" required>
            </div>
            <div>
                <label class="form-label" style="font-size: 14px;">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-input" value="{{ $tanggalAkhir }}" required>
            </div>
            <div style="margin-bottom: 2px;">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
        <div style="margin-bottom: 2px;">
            <button type="submit" name="export" value="csv" class="btn btn-secondary">⬇ Export CSV</button>
        </div>
    </form>
</div>

<!-- Ringkasan -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-xl);">
    <div class="card" style="text-align: center;">
        <div class="text-caption" style="color: var(--color-mute); margin-bottom: var(--space-xs);">Total Pendapatan</div>
        <div class="text-heading-md" style="color: var(--color-primary);">Rp {{ number_format($ringkasan->total_pendapatan ?? 0, 0, ',', '.') }}</div>
    </div>
    <div class="card" style="text-align: center;">
        <div class="text-caption" style="color: var(--color-mute); margin-bottom: var(--space-xs);">Transaksi</div>
        <div class="text-heading-md">{{ number_format($ringkasan->total_transaksi ?? 0) }}</div>
    </div>
    <div class="card" style="text-align: center;">
        <div class="text-caption" style="color: var(--color-mute); margin-bottom: var(--space-xs);">Item Terjual</div>
        <div class="text-heading-md">{{ number_format($ringkasan->total_produk ?? 0) }}</div>
    </div>
    <div class="card" style="text-align: center;">
        <div class="text-caption" style="color: var(--color-mute); margin-bottom: var(--space-xs);">Pelanggan Baru</div>
        <div class="text-heading-md" style="color: var(--color-success-deep);">+{{ number_format($ringkasan->pelanggan_baru ?? 0) }}</div>
    </div>
</div>

<div class="card pin-card" style="padding: 0;">
    <div style="padding: var(--space-lg); border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
        <h3 class="text-heading-md" style="margin: 0;">Rincian Transaksi ({{ Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($tanggalAkhir)->format('d/m/Y') }})</h3>
    </div>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid var(--color-hairline);">
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kode</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Tanggal</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Pelanggan</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Kasir</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: center;">Item</th>
                    <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr style="border-bottom: 1px solid var(--color-hairline);">
                    <td style="padding: var(--space-md) var(--space-lg); font-weight: 600;">
                        <a href="{{ route('admin.transaksi.show', $t->id_transaksi) }}" style="color: var(--color-primary); text-decoration: none;">
                            {{ $t->kode_transaksi }}
                        </a>
                    </td>
                    <td style="padding: var(--space-md) var(--space-lg);">{{ $t->tanggal_transaksi->format('d/m/Y H:i') }}</td>
                    <td style="padding: var(--space-md) var(--space-lg);">{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td style="padding: var(--space-md) var(--space-lg); color: var(--color-mute);">{{ $t->pengguna->nama_lengkap ?? '-' }}</td>
                    <td style="padding: var(--space-md) var(--space-lg); text-align: center;">{{ $t->total_item }}</td>
                    <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada data penjualan pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
