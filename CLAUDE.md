# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Dashboard Analitik UMKM Bouquet Bunga — a Laravel 12 server-rendered dashboard and POS system for a small flower bouquet business. All domain terminology is in Bahasa Indonesia (table names, models, routes, UI labels).

## Development Commands

```bash
# Start full dev server (artisan + queue + pail + vite concurrently)
npm run dev

# Individual services
php artisan serve
php artisan queue:listen --tries=1
php artisan pail
npx vite

# Database
php artisan migrate
php artisan migrate:fresh --seed        # Reset + seed
php artisan db:seed                     # Run all seeders
php artisan db:seed --class=PenggunaSeeder  # Single seeder

# Default login after seeding: admin@bouquet.com / password

# Build for production
npm run build

# Code style
./vendor/bin/pint

# Tests (PHPUnit 11.5, SQLite in-memory)
php artisan test
php artisan test --filter=ExampleTest   # Single test
```

## Architecture

### Two-Role System
- **Admin** (`/admin/*`) — Full CRUD: dashboard, produk, kategori, pelanggan, pengguna, transaksi (read-only), stok, laporan
- **User/Staff** (`/user/*`) — POS system: dashboard, katalog (read-only), transaksi (create), laporan, profil
- Role middleware: `CekRoleAdmin` → `role.admin`, `CekRoleUser` → `role.user`
- Auth model is `Pengguna` (not `User`), uses `kata_sandi` column, `peran` enum (`admin`|`user`)

### Routing
Routes split across three files (all web, no API):
- `routes/web.php` — Login/logout, root redirect based on role
- `routes/admin.php` — Admin panel routes
- `routes/user.php` — Staff routes (user dashboard is an inline closure, not a controller)

### Service Layer
Business logic lives in `app/Services/`:
- `TransaksiService` — Transaction creation with auto-generated codes (TRX-YYYYMMDD-XXXX), stock deduction, payment recording, daily summary updates
- `StokService` — Stock adjustments (masuk/keluar/penyesuaian), prevents negative stock
- `LaporanService` — Sales report data and CSV export
- `AnalitikService` — Dashboard metrics (referenced but DashboardController queries inline)

### Custom Primary Keys
All models use custom PK format: `id_<tablename>` (e.g., `id_pengguna`, `id_transaksi`). Foreign keys follow the same pattern.

### Key Models & Relationships
- `Pengguna` (auth model) → hasMany Transaksi, StokProduk, AktivitasPengguna
- `ProdukBouquet` → belongsTo KategoriBouquet, hasMany DetailTransaksi, StokProduk
- `Transaksi` → belongsTo Pelanggan/Pengguna, hasMany DetailTransaksi, hasOne Pembayaran
- `DetailTransaksi` → belongsTo Transaksi, ProdukBouquet

### Frontend
- **No SPA framework** — Pure Blade templates, no React/Vue/Livewire/Inertia
- **Tailwind CSS v4** via `@tailwindcss/vite` plugin (not PostCSS)
- **Design system**: `resources/css/design-system.css` — "Bouquet Elegance" pink/white theme with glassmorphism sidebar
- **Two separate layouts**: `admin/layouts/app.blade.php` and `user/layouts/app.blade.php`
- **Vite** binds to `127.0.0.1:5173` (not localhost) to avoid IPv6 CSP issues

### CSP Configuration
`app/Http/Middleware/SecurityHeaders.php` sets Content-Security-Policy headers. In local environment, allows Vite dev server at `127.0.0.1:5173` and `localhost:5173`. Production only allows `self`, CDN, and Google Fonts.

### Database
MySQL in production, SQLite in-memory for testing. Custom tables: pengguna, pelanggan, kategori_bouquet, produk_bouquet, transaksi, detail_transaksi, pembayaran, stok_produk, ringkasan_penjualan_harian, aktivitas_pengguna.
