<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Bouquet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div style="padding: var(--space-xl); background: linear-gradient(135deg, #D81B60, #880E4F); color: #fff;">
                <div style="font-size: 20px; font-weight: 800; letter-spacing: -0.5px;"> Bouquet Admin</div>
                <div style="font-size: 12px; opacity: 0.8; margin-top: 4px;">Dashboard UMKM</div>
            </div>
            <nav style="padding: var(--space-lg) 0; flex: 1;">
                <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease; {{ request()->routeIs('admin.dashboard') ? 'background: rgba(216,27,96,0.08); color: #D81B60; font-weight: 600; border-left: 3px solid #D81B60;' : '' }}">
                    <span></span> Dashboard
                </a>
                <a href="{{ route('admin.kategori.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Kategori
                </a>
                <a href="{{ route('admin.produk.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Produk
                </a>
                <a href="{{ route('admin.pelanggan.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Pelanggan
                </a>
                <a href="{{ route('admin.transaksi.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Riwayat Transaksi
                </a>
                <a href="{{ route('admin.stok.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Manajemen Stok
                </a>
                <a href="{{ route('admin.laporan.penjualan') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Laporan Penjualan
                </a>
                <a href="{{ route('admin.pengguna.index') }}" style="display: flex; align-items: center; gap: 10px; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 500; font-size: 14px; border-radius: 12px; margin: 2px 8px; transition: all 0.2s ease;">
                    <span></span> Manajemen Akun
                </a>
                <!-- We will add more links in phase 2-5 -->
            </nav>
            <div style="padding: var(--space-lg) var(--space-xl); border-top: 1px solid var(--color-hairline);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="width: 100%;">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <h1 class="text-heading-lg" style="margin: 0; color: var(--color-ink);">@yield('header', 'Dashboard')</h1>
                <div style="display: flex; align-items: center; gap: var(--space-md);">
                    <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #D81B60, #F06292); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">
                        {{ substr(Auth::user()->nama_lengkap, 0, 1) }}
                    </div>
                    <div class="text-body-strong" style="color: var(--color-ink);">
                        {{ Auth::user()->nama_lengkap }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="content-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
