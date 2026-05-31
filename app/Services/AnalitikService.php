<?php

namespace App\Services;

use App\Models\RingkasanPenjualanHarian;
use App\Models\Transaksi;
use App\Models\ProdukBouquet;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalitikService
{
    /**
     * Get dashboard metrics for Admin
     */
    public function getAdminMetrics($period = 'month')
    {
        $startDate = $this->getStartDate($period);
        $now = Carbon::now();

        // 1. Total Pendapatan
        $pendapatan = Transaksi::where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [$startDate, $now])
            ->sum('total_pembayaran');

        // 2. Total Transaksi
        $totalTransaksi = Transaksi::where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [$startDate, $now])
            ->count();

        // 3. Produk Terjual
        $produkTerjual = Transaksi::where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [$startDate, $now])
            ->sum('total_item');

        // 4. Pelanggan Aktif (yang bertransaksi di periode ini)
        $pelangganAktif = Transaksi::where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [$startDate, $now])
            ->distinct('id_pelanggan')
            ->count('id_pelanggan');

        return [
            'pendapatan' => $pendapatan,
            'totalTransaksi' => $totalTransaksi,
            'produkTerjual' => $produkTerjual,
            'pelangganAktif' => $pelangganAktif,
        ];
    }

    /**
     * Get sales trend data for Chart.js
     */
    public function getSalesTrend($days = 7)
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $now = Carbon::now()->endOfDay();

        $data = RingkasanPenjualanHarian::whereBetween('tanggal_ringkasan', [$startDate, $now])
            ->orderBy('tanggal_ringkasan', 'asc')
            ->get();

        // Fill missing dates with 0
        $labels = [];
        $pendapatan = [];
        
        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($days - 1 - $i)->format('Y-m-d');
            $record = $data->firstWhere('tanggal_ringkasan', $date);
            
            $labels[] = Carbon::parse($date)->format('d M');
            $pendapatan[] = $record ? $record->total_pendapatan : 0;
        }

        return [
            'labels' => $labels,
            'data' => $pendapatan
        ];
    }

    /**
     * Get top selling products
     */
    public function getTopProducts($limit = 5)
    {
        return DB::table('detail_transaksi')
            ->join('produk_bouquet', 'detail_transaksi.id_produk', '=', 'produk_bouquet.id_produk')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select('produk_bouquet.nama_produk', DB::raw('SUM(detail_transaksi.jumlah_terjual) as total_qty'), 'produk_bouquet.foto_produk')
            ->where('transaksi.status_transaksi', 'berhasil')
            ->groupBy('produk_bouquet.id_produk', 'produk_bouquet.nama_produk', 'produk_bouquet.foto_produk')
            ->orderBy('total_qty', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get low stock products
     */
    public function getLowStockProducts()
    {
        return ProdukBouquet::where('status_produk', 'aktif')
            ->whereRaw('stok_produk <= batas_stok_rendah')
            ->orderBy('stok_produk', 'asc')
            ->get();
    }

    /**
     * Helper to get start date based on period
     */
    private function getStartDate($period)
    {
        switch ($period) {
            case 'today':
                return Carbon::today();
            case 'week':
                return Carbon::now()->startOfWeek();
            case 'month':
                return Carbon::now()->startOfMonth();
            case 'year':
                return Carbon::now()->startOfYear();
            default:
                return Carbon::now()->startOfMonth(); // Default this month
        }
    }
}
