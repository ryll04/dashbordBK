<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['pelanggan', 'pengguna'])->orderBy('tanggal_transaksi', 'desc');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_transaksi', [
                $request->tanggal_mulai . ' 00:00:00', 
                $request->tanggal_akhir . ' 23:59:59'
            ]);
        }

        $transaksis = $query->paginate(20);
        return view('admin.pages.transaksi.index', compact('transaksis'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'pengguna', 'detail.produk', 'pembayaran']);
        return view('admin.pages.transaksi.show', compact('transaksi'));
    }
}
