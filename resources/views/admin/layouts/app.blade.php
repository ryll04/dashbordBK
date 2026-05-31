<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Bouquet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div style="padding: var(--space-xl); font-size: 22px; font-weight: 700; color: var(--color-primary); border-bottom: 1px solid var(--color-hairline);">
                Bouquet Admin
            </div>
            <nav style="padding: var(--space-lg) 0; flex: 1;">
                <a href="{{ route('admin.dashboard') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Dashboard</a>
                <a href="{{ route('admin.kategori.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Kategori</a>
                <a href="{{ route('admin.produk.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Produk</a>
                <a href="{{ route('admin.pelanggan.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Pelanggan</a>
                <a href="{{ route('admin.transaksi.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Riwayat Transaksi</a>
                <a href="{{ route('admin.stok.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Manajemen Stok</a>
                <a href="{{ route('admin.laporan.penjualan') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Laporan Penjualan</a>
                <a href="{{ route('admin.pengguna.index') }}" style="display: block; padding: var(--space-md) var(--space-xl); color: var(--color-ink); text-decoration: none; font-weight: 600;">Manajemen Akun</a>
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
                <h1 class="text-heading-lg" style="margin: 0;">@yield('header', 'Dashboard')</h1>
                <div class="user-info text-body-strong">
                    Halo, {{ Auth::user()->nama_lengkap }}
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
