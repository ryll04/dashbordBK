<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\ProdukBouquet;
use App\Models\Pelanggan;
use Carbon\Carbon;

Route::middleware(['auth', 'role.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $period = request('period', 'month');

            // Date range based on period
            $now = Carbon::now();
            match ($period) {
                'today' => $startDate = $now->copy()->startOfDay(),
                'week'  => $startDate = $now->copy()->startOfWeek(),
                'month' => $startDate = $now->copy()->startOfMonth(),
                'year'  => $startDate = $now->copy()->startOfYear(),
                default => $startDate = $now->copy()->startOfMonth(),
            };

            // Metrics
            $transaksiBerhasil = Transaksi::where('status_transaksi', 'selesai')
                ->where('tanggal_transaksi', '>=', $startDate);

            $metrics = [
                'pendapatan'      => (clone $transaksiBerhasil)->sum('total_pembayaran'),
                'totalTransaksi'  => (clone $transaksiBerhasil)->count(),
                'produkTerjual'   => DetailTransaksi::whereHas('transaksi', fn($q) => $q->where('status_transaksi', 'selesai')->where('tanggal_transaksi', '>=', $startDate))->sum('jumlah_terjual'),
                'pelangganAktif'  => Transaksi::where('status_transaksi', 'selesai')->where('tanggal_transaksi', '>=', $startDate)->distinct('id_pelanggan')->count('id_pelanggan'),
            ];

            // Top products (last 30 days)
            $topProducts = DetailTransaksi::select('produk_bouquet.id_produk', 'produk_bouquet.nama_produk', 'produk_bouquet.foto_produk', DB::raw('SUM(detail_transaksi.jumlah_terjual) as total_qty'))
                ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
                ->join('produk_bouquet', 'detail_transaksi.id_produk', '=', 'produk_bouquet.id_produk')
                ->where('transaksi.status_transaksi', 'selesai')
                ->where('transaksi.tanggal_transaksi', '>=', Carbon::now()->subDays(30))
                ->groupBy('produk_bouquet.id_produk', 'produk_bouquet.nama_produk', 'produk_bouquet.foto_produk')
                ->orderByDesc('total_qty')
                ->limit(5)
                ->get();

            // Low stock products
            $lowStockProducts = ProdukBouquet::whereColumn('stok_produk', '<=', 'batas_stok_rendah')
                ->where('status_produk', 'aktif')
                ->orderBy('stok_produk')
                ->limit(10)
                ->get();

            // Chart data (7 days)
            $chartLabels = [];
            $chartData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartLabels[] = $date->format('d M');
                $chartData[] = Transaksi::where('status_transaksi', 'selesai')
                    ->whereDate('tanggal_transaksi', $date)
                    ->sum('total_pembayaran');
            }

            return view('admin.pages.dashboard', compact(
                'period', 'metrics', 'topProducts', 'lowStockProducts',
                'chartLabels', 'chartData'
            ));
        })->name('dashboard');
        
        // Placeholders for controllers to be implemented in phase 2-5
        Route::resource('/produk', \App\Http\Controllers\Admin\ProdukController::class)->parameters([
            'produk' => 'produk'
        ]);
        Route::resource('/kategori', \App\Http\Controllers\Admin\KategoriController::class)->parameters([
            'kategori' => 'kategori'
        ]);
        Route::resource('/pelanggan', \App\Http\Controllers\Admin\PelangganController::class)->parameters([
            'pelanggan' => 'pelanggan'
        ]);
        Route::resource('/pengguna', \App\Http\Controllers\Admin\PenggunaController::class);
        Route::resource('/transaksi', \App\Http\Controllers\Admin\TransaksiController::class)->only(['index', 'show'])->parameters([
            'transaksi' => 'transaksi'
        ]);
        Route::resource('/stok', \App\Http\Controllers\Admin\StokController::class)->only(['index', 'create', 'store']);
        Route::get('/laporan/penjualan', [\App\Http\Controllers\Admin\LaporanController::class, 'penjualan'])->name('laporan.penjualan');
    });
