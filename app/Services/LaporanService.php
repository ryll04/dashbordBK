<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\RingkasanPenjualanHarian;
use Illuminate\Support\Facades\DB;

class LaporanService
{
    /**
     * Get data for Admin Sales Report
     */
    public function getLaporanPenjualan($tanggalMulai, $tanggalAkhir)
    {
        return Transaksi::with(['pelanggan', 'pengguna'])
            ->where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [
                $tanggalMulai . ' 00:00:00',
                $tanggalAkhir . ' 23:59:59'
            ])
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();
    }

    /**
     * Get aggregate summary for the report
     */
    public function getRingkasanLaporan($tanggalMulai, $tanggalAkhir)
    {
        return RingkasanPenjualanHarian::whereBetween('tanggal_ringkasan', [$tanggalMulai, $tanggalAkhir])
            ->selectRaw('
                SUM(total_transaksi) as total_transaksi,
                SUM(total_produk_terjual) as total_produk,
                SUM(total_pendapatan) as total_pendapatan,
                SUM(jumlah_pelanggan_baru) as pelanggan_baru,
                SUM(jumlah_pelanggan_lama) as pelanggan_lama
            ')
            ->first();
    }
}
