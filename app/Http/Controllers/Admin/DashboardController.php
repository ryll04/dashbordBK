<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\ProdukBouquet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with overview metrics, dynamic monthly chart,
     * top products, recent transactions, and stock alerts.
     */
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        $chartMonth = $request->get('chart_month', Carbon::now()->format('Y-m'));

        // 1. Core metrics using correct 'berhasil' transaction status
        $now = Carbon::now();
        match ($period) {
            'today' => $startDate = $now->copy()->startOfDay(),
            'week'  => $startDate = $now->copy()->startOfWeek(),
            'month' => $startDate = $now->copy()->startOfMonth(),
            'year'  => $startDate = $now->copy()->startOfYear(),
            default => $startDate = $now->copy()->startOfMonth(),
        };

        $transaksiBerhasil = Transaksi::where('status_transaksi', 'berhasil')
            ->where('tanggal_transaksi', '>=', $startDate);

        $metrics = [
            'pendapatan'      => (clone $transaksiBerhasil)->sum('total_pembayaran'),
            'totalTransaksi'  => (clone $transaksiBerhasil)->count(),
            'produkTerjual'   => DetailTransaksi::whereHas('transaksi', fn($q) => $q->where('status_transaksi', 'berhasil')->where('tanggal_transaksi', '>=', $startDate))->sum('jumlah_terjual'),
            'pelangganAktif'  => Transaksi::where('status_transaksi', 'berhasil')->where('tanggal_transaksi', '>=', $startDate)->distinct('id_pelanggan')->count('id_pelanggan'),
        ];

        // 2. Generate available months list (Indonesian locale-agnostic)
        $availableMonths = [];
        for ($i = 0; $i < 6; $i++) {
            $m = Carbon::now()->subMonths($i);
            $availableMonths[] = [
                'value' => $m->format('Y-m'),
                'label' => $this->getIndonesianMonthName($m->month) . ' ' . $m->year,
            ];
        }

        // 3. Construct daily sales trend data for the selected chartMonth
        $yearMonth = explode('-', $chartMonth);
        $year = isset($yearMonth[0]) ? (int) $yearMonth[0] : (int) Carbon::now()->year;
        $month = isset($yearMonth[1]) ? (int) $yearMonth[1] : (int) Carbon::now()->month;

        $chartStart = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $chartEnd = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $daysInMonth = $chartStart->daysInMonth;

        $chartLabels = [];
        $chartData = [];

        // Query all transactions for this month in a single query
        $monthlyTransactions = Transaksi::where('status_transaksi', 'berhasil')
            ->whereBetween('tanggal_transaksi', [$chartStart->copy()->startOfDay(), $chartEnd->copy()->endOfDay()])
            ->get();

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = Carbon::createFromDate($year, $month, $day);
            $chartLabels[] = $day; // e.g. 1, 2, ..., 31 (clean daily tick labels)
            
            $dayTotal = $monthlyTransactions->filter(function($trx) use ($currentDate) {
                return $trx->tanggal_transaksi->isSameDay($currentDate);
            })->sum('total_pembayaran');
            
            $chartData[] = $dayTotal;
        }

        // 4. Top products (last 30 days) - using 'berhasil' status
        $topProducts = DetailTransaksi::select('produk_bouquet.id_produk', 'produk_bouquet.nama_produk', 'produk_bouquet.foto_produk', DB::raw('SUM(detail_transaksi.jumlah_terjual) as total_qty'))
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('produk_bouquet', 'detail_transaksi.id_produk', '=', 'produk_bouquet.id_produk')
            ->where('transaksi.status_transaksi', 'berhasil')
            ->where('transaksi.tanggal_transaksi', '>=', Carbon::now()->subDays(30))
            ->groupBy('produk_bouquet.id_produk', 'produk_bouquet.nama_produk', 'produk_bouquet.foto_produk')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // 5. Recent transactions eager loading relations for table display
        $recentTransactions = Transaksi::with(['pelanggan', 'details.produk'])
            ->orderBy('tanggal_transaksi', 'desc')
            ->limit(5)
            ->get();

        // 6. Low stock products
        $lowStockProducts = ProdukBouquet::whereColumn('stok_produk', '<=', 'batas_stok_rendah')
            ->where('status_produk', 'aktif')
            ->orderBy('stok_produk')
            ->limit(10)
            ->get();

        return view('admin.pages.dashboard', compact(
            'period', 'metrics', 'topProducts', 'lowStockProducts',
            'chartLabels', 'chartData', 'availableMonths', 'chartMonth', 'recentTransactions'
        ));
    }

    /**
     * Get Indonesian month name from number.
     */
    private function getIndonesianMonthName($monthNum)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return $months[(int)$monthNum] ?? '';
    }
}
