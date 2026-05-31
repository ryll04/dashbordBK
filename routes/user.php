<?php

use Illuminate\Support\Facades\Route;
use App\Models\Transaksi;
use Carbon\Carbon;

Route::middleware(['auth', 'role.user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $user = auth()->user();

            $totalTransaksiHariIni = Transaksi::where('id_pengguna', $user->id_pengguna)
                ->whereDate('tanggal_transaksi', Carbon::today())
                ->count();

            $pendapatanHariIni = Transaksi::where('id_pengguna', $user->id_pengguna)
                ->whereDate('tanggal_transaksi', Carbon::today())
                ->where('status_transaksi', 'selesai')
                ->sum('total_pembayaran');

            $transaksisTerakhir = Transaksi::where('id_pengguna', $user->id_pengguna)
                ->with('pelanggan')
                ->latest('tanggal_transaksi')
                ->limit(10)
                ->get();

            return view('user.pages.dashboard', compact(
                'totalTransaksiHariIni', 'pendapatanHariIni', 'transaksisTerakhir'
            ));
        })->name('dashboard');
        
        // Placeholders for controllers to be implemented in phase 2-5
        Route::get('/produk', [\App\Http\Controllers\User\ProdukController::class, 'index'])->name('produk.index');
        Route::resource('/transaksi', \App\Http\Controllers\User\TransaksiController::class)->only(['index', 'create', 'store', 'show'])->parameters([
            'transaksi' => 'transaksi'
        ]);
        Route::get('/laporan/ringkas', [\App\Http\Controllers\User\LaporanController::class, 'ringkas'])->name('laporan.ringkas');
        Route::get('/profil', [\App\Http\Controllers\User\ProfilController::class, 'index'])->name('profil.index');
    });
