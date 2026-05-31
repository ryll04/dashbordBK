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
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
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
