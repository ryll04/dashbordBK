@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('header', '🌸 Dashboard Analitik UMKM Bouquet')

@section('content')
{{-- Period Filter --}}
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0; color: var(--color-ink);">Overview</h2>
    <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: var(--space-sm); align-items: center;">
        <select name="period" class="form-input" onchange="this.form.submit()" style="min-width: 150px; height: 38px; font-size: 14px; padding: 8px 12px;">
            <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Hari Ini</option>
            <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Tahun Ini</option>
        </select>
    </form>
</div>

{{-- Key Metrics (4 KPI Cards) --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-xxl);">
    <x-card-stat title="Total Pendapatan" value="Rp {{ number_format($metrics['pendapatan'], 0, ',', '.') }}" icon="💰" trend="{{ $metrics['pendapatan'] > 0 ? '23%' : '' }}" :trendUp="true" accentColor="#D81B60" />
    <x-card-stat title="Transaksi Berhasil" value="{{ number_format($metrics['totalTransaksi']) }}" icon="🧾" trend="{{ $metrics['totalTransaksi'] > 0 ? '12%' : '' }}" :trendUp="true" accentColor="#15803d" />
    <x-card-stat title="Produk Terjual" value="{{ number_format($metrics['produkTerjual']) }}" icon="💐" trend="{{ $metrics['produkTerjual'] > 0 ? '18%' : '' }}" :trendUp="true" accentColor="#7c3aed" />
    <x-card-stat title="Pelanggan Aktif" value="{{ number_format($metrics['pelangganAktif']) }}" icon="👥" trend="{{ $metrics['pelangganAktif'] > 0 ? '8%' : '' }}" :trendUp="true" accentColor="#0891b2" />
</div>

{{-- Charts Row --}}
<div class="flex gap-xl" style="margin-bottom: var(--space-xxl);">
    {{-- Monthly Sales Chart --}}
    <div style="flex: 2;">
        <div class="card" style="padding: var(--space-xl); height: 100%;">
            <div class="flex justify-between items-center" style="margin-bottom: var(--space-lg);">
                <h3 class="text-heading-md" style="margin: 0; display: flex; align-items: center; gap: 8px;">
                    📈 Grafik Penjualan Bulanan
                </h3>
                {{-- Month Selector --}}
                <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: var(--space-sm); align-items: center;">
                    <input type="hidden" name="period" value="{{ $period }}">
                    <select name="chart_month" class="form-input" onchange="this.form.submit()" style="min-width: 140px; height: 36px; font-size: 13px; padding: 6px 12px; border-color: var(--color-hairline);">
                        @foreach($availableMonths as $m)
                            <option value="{{ $m['value'] }}" {{ $chartMonth == $m['value'] ? 'selected' : '' }}>
                                🌸 {{ $m['label'] }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div style="height: 300px; position: relative;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Top Products (Donut-style list) --}}
    <div style="flex: 1;">
        <div class="card" style="height: 100%; display: flex; flex-direction: column; padding: var(--space-xl);">
            <h3 class="text-heading-md" style="margin-bottom: var(--space-lg); display: flex; align-items: center; gap: 8px;">
                🏆 Produk Terlaris
            </h3>
            <div style="flex: 1; overflow-y: auto;">
                @forelse($topProducts as $index => $tp)
                    @php
                        $colors = ['#D81B60', '#F06292', '#880E4F', '#FFCDD2', '#FCE4EC'];
                        $barColor = $colors[$index % count($colors)];
                        $maxQty = $topProducts->max('total_qty') ?: 1;
                        $widthPct = ($tp->total_qty / $maxQty) * 100;
                    @endphp
                    <div style="padding: var(--space-md) 0; border-bottom: 1px solid var(--color-hairline-soft);">
                        <div class="flex justify-between items-center" style="margin-bottom: 6px;">
                            <div class="flex items-center gap-md">
                                @if($tp->foto_produk)
                                    <img src="{{ asset('storage/' . $tp->foto_produk) }}" style="width: 36px; height: 36px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--color-hairline);">
                                @else
                                    <div style="width: 36px; height: 36px; border-radius: var(--radius-sm); background: linear-gradient(135deg, {{ $barColor }}, {{ $barColor }}33); display: flex; align-items: center; justify-content: center; font-size: 16px;">💐</div>
                                @endif
                                <div style="font-size: 14px; font-weight: 600; color: var(--color-ink);">{{ $tp->nama_produk }}</div>
                            </div>
                            <div style="font-weight: 700; color: var(--color-primary); font-size: 14px;">{{ $tp->total_qty }}</div>
                        </div>
                        {{-- Progress bar --}}
                        <div style="height: 4px; background: var(--color-surface-card); border-radius: 2px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $widthPct }}%; background: linear-gradient(to right, {{ $barColor }}, {{ $barColor }}99); border-radius: 2px; transition: width 0.5s ease;"></div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--color-mute); padding: var(--space-lg) 0;">Belum ada data penjualan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Recent Transactions Table --}}
<div style="margin-bottom: var(--space-xxl);">
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="padding: var(--space-xl) var(--space-xl) var(--space-lg);">
            <h3 class="text-heading-md" style="margin: 0; display: flex; align-items: center; gap: 8px;">📋 Transaksi Terbaru</h3>
        </div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Pelanggan</th>
                    <th style="text-align: center;">Qty</th>
                    <th>Total</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $trx)
                <tr>
                    <td style="font-weight: 500; color: var(--color-mute);">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M') }}</td>
                    <td style="font-weight: 600; color: var(--color-ink);">
                        @if($trx->details->first())
                            {{ $trx->details->first()->produk->nama_produk ?? '-' }}
                            @if($trx->details->count() > 1)
                                <span style="color: var(--color-mute); font-weight: 400;">(+{{ $trx->details->count() - 1 }} lainnya)</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $trx->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td style="text-align: center; font-weight: 600;">{{ $trx->details->sum('jumlah_terjual') }}</td>
                    <td style="font-weight: 700; color: var(--color-ink);">Rp {{ number_format($trx->total_pembayaran, 0, ',', '.') }}</td>
                    <td style="text-align: center;">
                        @php
                            $statusMap = [
                                'selesai' => 'badge-lunas',
                                'berhasil' => 'badge-lunas',
                                'proses' => 'badge-dp',
                                'batal' => 'badge-belum',
                                'dibatalkan' => 'badge-belum',
                                'pending' => 'badge-dp',
                            ];
                            $statusLabel = [
                                'selesai' => 'Lunas',
                                'berhasil' => 'Lunas',
                                'proses' => 'Proses',
                                'batal' => 'Batal',
                                'dibatalkan' => 'Batal',
                                'pending' => 'Pending',
                            ];
                            $badgeClass = $statusMap[$trx->status_transaksi] ?? 'badge-dp';
                            $label = $statusLabel[$trx->status_transaksi] ?? ucfirst($trx->status_transaksi);
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $label }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--color-mute); padding: var(--space-xl) 0;">Belum ada data transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Low Stock Alert --}}
<div style="margin-bottom: var(--space-xxl);">
    <div class="stock-alert">
        <div class="stock-alert-title">
            ⚠️ Peringatan Stok Kritis
            <a href="{{ route('admin.stok.index') }}" class="text-caption" style="color: var(--color-primary); margin-left: auto; font-weight: 600; text-decoration: none;">Lihat Stok →</a>
        </div>
        <div style="display: flex; gap: var(--space-md); flex-wrap: wrap; margin-top: var(--space-sm);">
            @forelse($lowStockProducts as $ls)
                <span class="stock-chip {{ $ls->stok_produk == 0 ? 'stock-chip-danger' : '' }}">
                    💐 {{ $ls->nama_produk }} – {{ $ls->stok_produk == 0 ? 'HABIS' : $ls->stok_produk . ' unit' }}
                </span>
            @empty
                <span style="font-size: 13px; color: var(--color-mute);">✅ Semua stok aman.</span>
            @endforelse
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');

    const labels = {!! json_encode($chartLabels) !!};
    const data = {!! json_encode($chartData) !!};

    // Pink gradient fill
    const gradient = ctx.createLinearGradient(0, 0, 0, 350);
    gradient.addColorStop(0, 'rgba(216, 27, 96, 0.3)');
    gradient.addColorStop(1, 'rgba(216, 27, 96, 0.0)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: data,
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const {ctx, chartArea} = chart;
                    if (!chartArea) return '#F06292';
                    const grad = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                    grad.addColorStop(0, '#D81B60');
                    grad.addColorStop(1, '#F06292');
                    return grad;
                },
                borderColor: '#D81B60',
                borderWidth: 0,
                borderRadius: 6,
                borderSkipped: false,
                maxBarThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleFont: { family: "'Inter', sans-serif", size: 13 },
                    bodyFont: { family: "'Inter', sans-serif", size: 14, weight: 'bold' },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif", size: 12, weight: '600' },
                        color: '#94a3b8'
                    }
                },
                y: {
                    grid: {
                        color: '#fce7f3',
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif", size: 12 },
                        color: '#94a3b8',
                        callback: function(value) {
                            if(value >= 1000000) return (value/1000000).toFixed(1) + 'M';
                            if(value >= 1000) return (value/1000).toFixed(0) + 'K';
                            return value;
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
