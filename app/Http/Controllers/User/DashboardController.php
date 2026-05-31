<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // Staf Metrics untuk Hari Ini
        $totalTransaksiHariIni = Transaksi::where('id_pengguna', $userId)
            ->where('status_transaksi', 'berhasil')
            ->whereDate('tanggal_transaksi', $today)
            ->count();

        $pendapatanHariIni = Transaksi::where('id_pengguna', $userId)
            ->where('status_transaksi', 'berhasil')
            ->whereDate('tanggal_transaksi', $today)
            ->sum('total_pembayaran');

        $transaksisTerakhir = Transaksi::with('pelanggan')
            ->where('id_pengguna', $userId)
            ->orderBy('tanggal_transaksi', 'desc')
            ->take(5)
            ->get();

        return view('user.pages.dashboard', compact('totalTransaksiHariIni', 'pendapatanHariIni', 'transaksisTerakhir'));
    }
}
