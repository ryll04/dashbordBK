<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function ringkas(Request $request)
    {
        $userId = Auth::id();
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));

        $transaksis = Transaksi::with('pelanggan')
            ->where('id_pengguna', $userId)
            ->where('status_transaksi', 'berhasil')
            ->whereDate('tanggal_transaksi', $tanggal)
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        $totalTransaksi = $transaksis->count();
        $totalPendapatan = $transaksis->sum('total_pembayaran');
        $totalItem = $transaksis->sum('total_item');

        return view('user.pages.laporan.ringkas', compact('transaksis', 'totalTransaksi', 'totalPendapatan', 'totalItem', 'tanggal'));
    }
}
