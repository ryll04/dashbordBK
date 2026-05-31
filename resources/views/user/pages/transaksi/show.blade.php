@extends('user.layouts.app')

@section('title', 'Struk Transaksi')
@section('header', 'Detail / Struk Transaksi')

@section('content')
<div style="display: flex; justify-content: center;">
    <div class="card pin-card" style="width: 100%; max-width: 500px; padding: var(--space-xl); background-color: #fff;">
        
        <div style="text-align: center; margin-bottom: var(--space-xl); border-bottom: 2px dashed var(--color-hairline); padding-bottom: var(--space-lg);">
            <h2 style="margin: 0 0 var(--space-xs) 0; font-family: 'Outfit', sans-serif;">Bouquet Shop</h2>
            <p class="text-caption" style="margin: 0;">Jl. Bunga Mekar No. 123, Kota Indah</p>
            <p class="text-caption" style="margin: 0;">Telp: 0812-3456-7890</p>
        </div>

        <div style="margin-bottom: var(--space-lg); font-size: 14px;">
            <div class="flex justify-between" style="margin-bottom: 4px;">
                <span style="color: var(--color-mute);">No. Transaksi:</span>
                <span style="font-weight: 600;">{{ $transaksi->kode_transaksi }}</span>
            </div>
            <div class="flex justify-between" style="margin-bottom: 4px;">
                <span style="color: var(--color-mute);">Tanggal:</span>
                <span>{{ $transaksi->tanggal_transaksi->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between" style="margin-bottom: 4px;">
                <span style="color: var(--color-mute);">Kasir:</span>
                <span>{{ $transaksi->pengguna->nama_lengkap ?? Auth::user()->nama_lengkap }}</span>
            </div>
            <div class="flex justify-between">
                <span style="color: var(--color-mute);">Pelanggan:</span>
                <span>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</span>
            </div>
        </div>

        <div style="border-top: 1px solid var(--color-hairline); border-bottom: 1px solid var(--color-hairline); padding: var(--space-md) 0; margin-bottom: var(--space-lg);">
            <table style="width: 100%; font-size: 14px; text-align: left;">
                @foreach($transaksi->detail as $item)
                <tr>
                    <td style="padding: 4px 0;">
                        <div>{{ $item->produk->nama_produk ?? 'Produk Dihapus' }}</div>
                        <div style="color: var(--color-mute); font-size: 12px;">{{ $item->jumlah_terjual }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</div>
                    </td>
                    <td style="padding: 4px 0; text-align: right; vertical-align: top;">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <div style="font-size: 14px; margin-bottom: var(--space-xl);">
            <div class="flex justify-between" style="margin-bottom: 4px; font-weight: 600;">
                <span>Total Item:</span>
                <span>{{ $transaksi->total_item }}</span>
            </div>
            <div class="flex justify-between" style="margin-bottom: var(--space-md); font-weight: 700; font-size: 18px;">
                <span>Total Bayar:</span>
                <span>Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between" style="margin-bottom: 4px;">
                <span style="color: var(--color-mute);">Diterima ({{ strtoupper($transaksi->pembayaran->metode_pembayaran ?? 'Tunai') }}):</span>
                <span>Rp {{ number_format($transaksi->pembayaran->jumlah_bayar ?? $transaksi->total_pembayaran, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between" style="margin-bottom: 4px;">
                <span style="color: var(--color-mute);">Kembali:</span>
                <span>Rp {{ number_format(($transaksi->pembayaran->jumlah_bayar ?? $transaksi->total_pembayaran) - $transaksi->total_pembayaran, 0, ',', '.') }}</span>
            </div>
        </div>

        <div style="text-align: center; color: var(--color-mute); font-size: 12px;">
            <p style="margin: 0;">Terima kasih atas kunjungan Anda!</p>
            <p style="margin: 0;">Barang yang sudah dibeli tidak dapat ditukar.</p>
        </div>

        <div style="margin-top: var(--space-xl); text-align: center;">
            <button onclick="window.print()" class="btn btn-primary" style="margin-bottom: var(--space-sm); width: 100%;">Cetak Struk</button>
            <a href="{{ route('user.transaksi.create') }}" class="btn btn-secondary" style="width: 100%; box-sizing: border-box; text-align: center;">Transaksi Baru</a>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .pin-card, .pin-card * {
        visibility: visible;
    }
    .pin-card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        box-shadow: none;
    }
    .btn {
        display: none !important;
    }
}
</style>
@endsection
