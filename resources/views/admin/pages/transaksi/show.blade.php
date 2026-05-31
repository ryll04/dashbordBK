@extends('admin.layouts.app')

@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
<div class="flex gap-lg">
    <!-- Info Transaksi & Pelanggan -->
    <div style="flex: 1;">
        <div class="card" style="margin-bottom: var(--space-xl);">
            <h3 class="text-heading-md" style="margin-bottom: var(--space-md); border-bottom: 1px solid var(--color-hairline); padding-bottom: var(--space-sm);">Informasi Transaksi</h3>
            <div style="display: grid; grid-template-columns: 120px 1fr; gap: var(--space-sm); margin-bottom: var(--space-xs);">
                <div class="text-body-strong">Kode</div>
                <div style="color: var(--color-primary); font-weight: 600;">{{ $transaksi->kode_transaksi }}</div>
                
                <div class="text-body-strong">Tanggal</div>
                <div>{{ $transaksi->tanggal_transaksi->format('d F Y, H:i') }}</div>
                
                <div class="text-body-strong">Status</div>
                <div>
                    <span style="display: inline-block; padding: 2px 8px; border-radius: var(--radius-full); font-size: 12px; font-weight: 600; background-color: var(--color-success-pale); color: var(--color-success-deep);">
                        {{ ucfirst($transaksi->status_transaksi) }}
                    </span>
                </div>

                <div class="text-body-strong">Kasir</div>
                <div>{{ $transaksi->pengguna->nama_lengkap ?? '-' }}</div>
            </div>
        </div>

        <div class="card">
            <h3 class="text-heading-md" style="margin-bottom: var(--space-md); border-bottom: 1px solid var(--color-hairline); padding-bottom: var(--space-sm);">Data Pelanggan</h3>
            <div style="display: grid; grid-template-columns: 120px 1fr; gap: var(--space-sm); margin-bottom: var(--space-xs);">
                <div class="text-body-strong">Nama</div>
                <div>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</div>
                
                <div class="text-body-strong">Telepon</div>
                <div>{{ $transaksi->pelanggan->nomor_telepon ?? '-' }}</div>
                
                <div class="text-body-strong">Jenis</div>
                <div>{{ ucfirst($transaksi->pelanggan->jenis_pelanggan ?? '-') }}</div>

                <div class="text-body-strong">Alamat</div>
                <div>{{ $transaksi->pelanggan->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Detail Item & Pembayaran -->
    <div style="flex: 2;">
        <div class="card pin-card" style="padding: 0; margin-bottom: var(--space-xl);">
            <div style="padding: var(--space-lg); border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <h3 class="text-heading-md" style="margin: 0;">Item Pembelian</h3>
            </div>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--color-hairline);">
                        <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Produk</th>
                        <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Harga</th>
                        <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: center;">Qty</th>
                        <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi->detail as $item)
                    <tr style="border-bottom: 1px solid var(--color-hairline);">
                        <td style="padding: var(--space-md) var(--space-lg);">{{ $item->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: right;">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: center;">{{ $item->jumlah_terjual }}</td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: var(--color-surface-soft);">
                        <td colspan="3" style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">Total Item: {{ $transaksi->total_item }} | Total Tagihan</td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 700; color: var(--color-primary); font-size: 18px;">Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="card" style="background-color: var(--color-success-pale);">
            <h3 class="text-heading-md" style="margin-bottom: var(--space-sm); color: var(--color-success-deep);">Informasi Pembayaran</h3>
            <div style="display: flex; gap: var(--space-xl); color: var(--color-success-deep);">
                <div>
                    <div style="font-size: 12px; margin-bottom: 4px;">Metode</div>
                    <div style="font-weight: 600; text-transform: uppercase;">{{ $transaksi->pembayaran->metode_pembayaran ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; margin-bottom: 4px;">Waktu Bayar</div>
                    <div style="font-weight: 600;">{{ $transaksi->pembayaran ? $transaksi->pembayaran->tanggal_pembayaran->format('d/m/Y H:i') : '-' }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; margin-bottom: 4px;">Status</div>
                    <div style="font-weight: 600; text-transform: uppercase;">{{ $transaksi->pembayaran->status_pembayaran ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div style="margin-top: var(--space-xl);">
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
