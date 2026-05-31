<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalitikService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected AnalitikService $analitikService;

    public function __construct(AnalitikService $analitikService)
    {
        $this->analitikService = $analitikService;
    }

    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        
        $metrics = $this->analitikService->getAdminMetrics($period);
        $chartData = $this->analitikService->getSalesTrend(7); // Last 7 days
        $topProducts = $this->analitikService->getTopProducts(5);
        $lowStockProducts = $this->analitikService->getLowStockProducts();

        return view('admin.pages.dashboard', compact('metrics', 'chartData', 'topProducts', 'lowStockProducts', 'period'));
    }
}
