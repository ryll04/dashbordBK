@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Analitik UMKM Bouquet')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0;">Overview</h2>
    <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: var(--space-sm);">
        <select name="period" class="form-input" onchange="this.form.submit()" style="min-width: 150px;">
            <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Hari Ini</option>
            <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="year" {{ $period == 'year' ? 'selected' : '' }}>Tahun Ini</option>
        </select>
    </form>
</div>

<!-- Key Metrics -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-lg); margin-bottom: var(--space-xxl);">
    <x-card-stat title="Total Pendapatan" value="Rp {{ number_format($metrics['pendapatan'], 0, ',', '.') }}" icon="💰" />
    <x-card-stat title="Transaksi Berhasil" value="{{ number_format($metrics['totalTransaksi']) }}" icon="📦" />
    <x-card-stat title="Produk Terjual" value="{{ number_format($metrics['produkTerjual']) }}" icon="💐" />
    <x-card-stat title="Pelanggan Aktif" value="{{ number_format($metrics['pelangganAktif']) }}" icon="👥" />
</div>

<!-- Charts & Tables Row 1 -->
<div class="flex gap-xl" style="margin-bottom: var(--space-xxl);">
    <!-- Sales Trend Chart -->
    <div style="flex: 2;">
        <x-chart-card title="Tren Penjualan (7 Hari Terakhir)" id="salesChart" height="350px" />
    </div>

    <!-- Top Products -->
    <div style="flex: 1;">
        <div class="card pin-card" style="height: 100%; display: flex; flex-direction: column;">
            <h3 class="text-heading-md" style="margin-bottom: var(--space-lg);">Produk Terlaris</h3>
            <div style="flex: 1; overflow-y: auto;">
                @forelse($topProducts as $tp)
                    <div class="flex justify-between items-center" style="padding: var(--space-md) 0; border-bottom: 1px solid var(--color-hairline);">
                        <div class="flex items-center gap-md">
                            @if($tp->foto_produk)
                                <img src="{{ asset('storage/' . $tp->foto_produk) }}" style="width: 40px; height: 40px; border-radius: var(--radius-sm); object-fit: cover;">
                            @else
                                <div style="width: 40px; height: 40px; border-radius: var(--radius-sm); background-color: var(--color-surface-soft);"></div>
                            @endif
                            <div class="text-body-strong">{{ $tp->nama_produk }}</div>
                        </div>
                        <div style="font-weight: 600; color: var(--color-primary);">{{ $tp->total_qty }} Terjual</div>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--color-mute); padding: var(--space-lg) 0;">Belum ada data penjualan</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Charts & Tables Row 2 -->
<div class="flex gap-xl">
    <!-- Low Stock Alert -->
    <div style="flex: 1;">
        <div class="card pin-card" style="border-top: 4px solid var(--color-error);">
            <div class="flex justify-between items-center" style="margin-bottom: var(--space-lg);">
                <h3 class="text-heading-md" style="color: var(--color-error); margin: 0;">Peringatan Stok Rendah</h3>
                <a href="{{ route('admin.stok.index') }}" class="text-caption" style="color: var(--color-primary);">Lihat Stok</a>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--color-hairline);">
                        <th style="padding: var(--space-sm) 0; font-weight: 600;">Produk</th>
                        <th style="padding: var(--space-sm) 0; font-weight: 600; text-align: right;">Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockProducts as $ls)
                    <tr style="border-bottom: 1px solid var(--color-hairline);">
                        <td style="padding: var(--space-md) 0;">{{ $ls->nama_produk }}</td>
                        <td style="padding: var(--space-md) 0; text-align: right; color: var(--color-error); font-weight: 700;">{{ $ls->stok_produk }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="padding: var(--space-lg) 0; text-align: center; color: var(--color-mute);">Semua stok aman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script for Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Inject data from PHP
    const labels = {!! json_encode($chartLabels) !!};
    const data = {!! json_encode($chartData) !!};

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(164, 117, 81, 0.4)'); // Primary color with opacity
    gradient.addColorStop(1, 'rgba(164, 117, 81, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: data,
                borderColor: '#A47551', // Primary color
                backgroundColor: gradient,
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#A47551',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.3 // Smooth curves
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Hide legend for cleaner look
                },
                tooltip: {
                    backgroundColor: '#3D3D3D',
                    titleFont: { family: "'Inter', sans-serif", size: 13 },
                    bodyFont: { family: "'Inter', sans-serif", size: 14, weight: 'bold' },
                    padding: 12,
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
                        font: { family: "'Inter', sans-serif", size: 12 },
                        color: '#9CA3AF'
                    }
                },
                y: {
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif", size: 12 },
                        color: '#9CA3AF',
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
