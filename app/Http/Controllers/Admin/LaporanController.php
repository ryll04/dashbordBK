<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    protected LaporanService $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    public function penjualan(Request $request)
    {
        $tanggalMulai = $request->get('tanggal_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tanggalAkhir = $request->get('tanggal_akhir', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $transaksis = $this->laporanService->getLaporanPenjualan($tanggalMulai, $tanggalAkhir);
        $ringkasan = $this->laporanService->getRingkasanLaporan($tanggalMulai, $tanggalAkhir);

        if ($request->has('export')) {
            // Simplified CSV Export
            $filename = "laporan_penjualan_{$tanggalMulai}_{$tanggalAkhir}.csv";
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $columns = ['Kode Transaksi', 'Tanggal', 'Pelanggan', 'Kasir', 'Total Item', 'Total Pembayaran', 'Status'];

            $callback = function() use($transaksis, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($transaksis as $t) {
                    fputcsv($file, [
                        $t->kode_transaksi,
                        $t->tanggal_transaksi,
                        $t->pelanggan->nama_pelanggan ?? 'Umum',
                        $t->pengguna->nama_lengkap ?? '-',
                        $t->total_item,
                        $t->total_pembayaran,
                        $t->status_transaksi
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return view('admin.pages.laporan.penjualan', compact('transaksis', 'ringkasan', 'tanggalMulai', 'tanggalAkhir'));
    }
}
