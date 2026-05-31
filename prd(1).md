# PRD — Dashboard Analitik UMKM Penjualan Bouquet Bunga

## 1. Informasi Dokumen

| Keterangan | Isi |
|---|---|
| Nama Produk | Dashboard Analitik UMKM Penjualan Bouquet Bunga |
| Jenis Sistem | Aplikasi web dashboard analitik / Business Intelligence sederhana |
| Tujuan Utama | Membantu UMKM memahami penjualan, tren pelanggan, dan performa bisnis melalui data dan grafik |
| Framework | Laravel |
| Database | MySQL |
| Frontend | Blade Template, HTML, CSS, JavaScript, Chart.js |
| Backend | Laravel MVC, Controller, Model, Service, Middleware, Route |
| Acuan Desain | `DESIGN.md` |
| Pengguna Sistem | Admin dan User/Staf |

---

## 2. Ringkasan Produk

Dashboard Analitik UMKM Penjualan Bouquet Bunga adalah aplikasi berbasis web yang digunakan untuk mencatat, mengelola, dan menganalisis data penjualan bouquet bunga. Sistem ini membantu pemilik usaha melihat informasi penting seperti total penjualan, total pendapatan, produk bouquet terlaris, tren pelanggan, stok produk, serta performa bisnis secara visual melalui grafik dan kartu ringkasan.

Sistem dibuat menggunakan **Laravel** sebagai framework utama dan **MySQL** sebagai database. Struktur proyek dibuat rapi dengan pemisahan antara **frontend** dan **backend**. Pada bagian frontend, tampilan untuk **admin** dan **user** dipisahkan ke folder yang berbeda agar mudah dikembangkan dan dikelola.

Desain dashboard mengikuti arahan dari `DESIGN.md`, yaitu tampilan modern, clean, rounded, berbasis card, menggunakan warna netral warm cream, serta warna merah sebagai aksen utama untuk tombol atau elemen penting.

---

## 3. Latar Belakang

UMKM penjualan bouquet bunga memiliki peluang bisnis yang besar karena produk bouquet sering dibutuhkan untuk berbagai acara, seperti wisuda, ulang tahun, anniversary, Hari Guru, Hari Ibu, dan acara spesial lainnya. Namun, pencatatan transaksi yang masih manual membuat pemilik usaha sulit mengetahui produk yang paling laku, waktu penjualan paling ramai, jumlah pelanggan, pendapatan tertinggi, dan stok yang perlu disiapkan.

Oleh karena itu, dibutuhkan sistem dashboard analitik yang dapat mengolah data transaksi menjadi informasi visual. Dengan adanya dashboard ini, pemilik usaha dapat membaca kondisi bisnis secara lebih cepat, rapi, dan mudah dipahami. Informasi tersebut dapat digunakan sebagai dasar untuk menentukan strategi promosi, pengelolaan stok, dan evaluasi performa usaha.

---

## 4. Tujuan Produk

1. Membantu UMKM bouquet bunga memantau penjualan secara lebih mudah.
2. Menampilkan data penjualan, pendapatan, pelanggan, produk, dan stok dalam bentuk ringkasan.
3. Menyediakan grafik penjualan dan tren pelanggan agar data lebih mudah dibaca.
4. Membantu pemilik usaha mengetahui produk bouquet yang paling diminati.
5. Membantu pengambilan keputusan terkait stok, promosi, dan strategi penjualan.
6. Membuat data transaksi menjadi lebih rapi, terstruktur, dan mudah dicari kembali.

---

## 5. Ruang Lingkup Produk

### 5.1 Fitur yang Termasuk

- Login dan logout pengguna.
- Pembagian role antara admin dan user.
- Dashboard admin dengan kartu ringkasan dan grafik analitik.
- Dashboard user dengan akses terbatas sesuai kebutuhan.
- Manajemen data produk bouquet.
- Manajemen kategori bouquet.
- Manajemen data pelanggan.
- Manajemen data transaksi penjualan.
- Manajemen stok produk.
- Laporan penjualan berdasarkan periode.
- Grafik penjualan, pendapatan, produk terlaris, dan tren pelanggan.
- Filter data berdasarkan tanggal, kategori, produk, dan metode pembayaran.

### 5.2 Fitur yang Tidak Termasuk pada Versi Awal

- Integrasi pembayaran online otomatis.
- Sistem pengiriman barang real-time.
- Aplikasi mobile Android/iOS.
- Integrasi marketplace eksternal.
- Prediksi AI tingkat lanjut.

---

## 6. Target Pengguna dan Hak Akses

### 6.1 Admin

Admin adalah pengguna dengan akses penuh terhadap sistem. Admin dapat mengelola seluruh data dan melihat seluruh laporan analitik.

**Hak akses admin:**

- Login ke halaman admin.
- Melihat dashboard analitik lengkap.
- Mengelola data produk bouquet.
- Mengelola kategori produk.
- Mengelola data pelanggan.
- Mengelola transaksi penjualan.
- Mengelola stok produk.
- Melihat dan memfilter laporan penjualan.
- Melihat grafik performa bisnis.
- Mengelola akun user/staf.

### 6.2 User / Staf

User adalah pengguna dengan akses terbatas. Role ini dapat digunakan untuk staf atau pemilik usaha yang hanya membutuhkan akses tertentu.

**Hak akses user:**

- Login ke halaman user.
- Melihat dashboard ringkas.
- Melihat data produk.
- Menambahkan transaksi penjualan sederhana.
- Melihat transaksi yang pernah diinput.
- Melihat laporan terbatas sesuai hak akses.
- Mengubah profil akun pribadi.

---

## 7. Kebutuhan Fungsional

### 7.1 Autentikasi

| Kode | Kebutuhan |
|---|---|
| F-01 | Sistem menyediakan halaman login. |
| F-02 | Sistem memvalidasi email dan password pengguna. |
| F-03 | Sistem mengarahkan pengguna ke dashboard sesuai role. |
| F-04 | Sistem menyediakan fitur logout. |
| F-05 | Sistem membatasi akses halaman berdasarkan role admin dan user. |

### 7.2 Dashboard Admin

| Kode | Kebutuhan |
|---|---|
| F-06 | Admin dapat melihat total pendapatan. |
| F-07 | Admin dapat melihat total transaksi. |
| F-08 | Admin dapat melihat jumlah pelanggan. |
| F-09 | Admin dapat melihat jumlah produk aktif. |
| F-10 | Admin dapat melihat grafik penjualan harian, mingguan, dan bulanan. |
| F-11 | Admin dapat melihat grafik produk bouquet terlaris. |
| F-12 | Admin dapat melihat grafik tren pelanggan. |
| F-13 | Admin dapat melihat grafik pendapatan per periode. |
| F-14 | Admin dapat melihat produk dengan stok rendah. |

### 7.3 Dashboard User

| Kode | Kebutuhan |
|---|---|
| F-15 | User dapat melihat ringkasan penjualan terbatas. |
| F-16 | User dapat melihat daftar transaksi yang diinput sendiri. |
| F-17 | User dapat melihat daftar produk aktif. |
| F-18 | User dapat menambahkan transaksi penjualan. |
| F-19 | User dapat mengubah profil pribadi. |

### 7.4 Manajemen Produk Bouquet

| Kode | Kebutuhan |
|---|---|
| F-20 | Admin dapat menambahkan produk bouquet baru. |
| F-21 | Admin dapat mengedit data produk bouquet. |
| F-22 | Admin dapat menghapus atau menonaktifkan produk bouquet. |
| F-23 | Admin dapat mengunggah foto produk bouquet. |
| F-24 | Admin dapat mengatur kategori, harga, stok, dan status produk. |

### 7.5 Manajemen Kategori

| Kode | Kebutuhan |
|---|---|
| F-25 | Admin dapat menambahkan kategori bouquet. |
| F-26 | Admin dapat mengedit kategori bouquet. |
| F-27 | Admin dapat menghapus kategori jika tidak digunakan oleh produk aktif. |

### 7.6 Manajemen Pelanggan

| Kode | Kebutuhan |
|---|---|
| F-28 | Admin dapat menambahkan data pelanggan. |
| F-29 | Admin dapat mengedit data pelanggan. |
| F-30 | Admin dapat melihat riwayat transaksi pelanggan. |
| F-31 | Admin dapat mencari pelanggan berdasarkan nama atau nomor telepon. |

### 7.7 Manajemen Transaksi

| Kode | Kebutuhan |
|---|---|
| F-32 | Admin dan user dapat menambahkan transaksi penjualan. |
| F-33 | Sistem menghitung subtotal berdasarkan harga produk dan jumlah pembelian. |
| F-34 | Sistem menghitung total pembayaran otomatis. |
| F-35 | Admin dapat melihat seluruh transaksi. |
| F-36 | User hanya dapat melihat transaksi sesuai hak akses. |
| F-37 | Admin dapat memfilter transaksi berdasarkan tanggal, pelanggan, produk, dan metode pembayaran. |
| F-38 | Admin dapat mencetak atau mengunduh laporan penjualan. |

### 7.8 Manajemen Stok

| Kode | Kebutuhan |
|---|---|
| F-39 | Sistem mengurangi stok produk saat transaksi berhasil disimpan. |
| F-40 | Admin dapat menambah stok produk. |
| F-41 | Admin dapat melihat riwayat perubahan stok. |
| F-42 | Sistem menandai produk dengan stok rendah. |

---

## 8. Kebutuhan Dashboard dan Grafik

Dashboard harus menampilkan informasi secara visual agar mudah dipahami oleh pemilik UMKM. Grafik dibuat menggunakan **Chart.js**.

### 8.1 Kartu Ringkasan

Kartu ringkasan ditampilkan di bagian atas dashboard.

| Kartu | Isi Data |
|---|---|
| Total Penjualan | Jumlah transaksi pada periode tertentu |
| Total Pendapatan | Total pemasukan dari transaksi penjualan |
| Total Pelanggan | Jumlah pelanggan yang pernah membeli |
| Produk Terlaris | Produk bouquet dengan jumlah penjualan tertinggi |
| Stok Rendah | Jumlah produk yang stoknya hampir habis |

### 8.2 Grafik yang Ditampilkan

| Nama Grafik | Jenis Grafik | Fungsi |
|---|---|---|
| Grafik Penjualan Periode | Line Chart / Bar Chart | Menampilkan perkembangan penjualan harian, mingguan, atau bulanan |
| Grafik Pendapatan | Line Chart | Menampilkan total pendapatan berdasarkan periode |
| Grafik Produk Terlaris | Bar Chart | Menampilkan produk bouquet yang paling sering dibeli |
| Grafik Kategori Terlaris | Doughnut Chart | Menampilkan kategori bouquet yang paling diminati |
| Grafik Tren Pelanggan | Line Chart | Menampilkan jumlah pelanggan baru dan pelanggan lama |
| Grafik Metode Pembayaran | Pie Chart | Menampilkan perbandingan metode pembayaran |
| Grafik Stok Produk | Bar Chart | Menampilkan produk dengan stok tersedia dan stok rendah |

### 8.3 Filter Dashboard

Dashboard harus memiliki filter agar data lebih mudah dianalisis.

- Filter tanggal mulai dan tanggal akhir.
- Filter bulan dan tahun.
- Filter kategori bouquet.
- Filter produk bouquet.
- Filter metode pembayaran.
- Filter status transaksi.

---

## 9. Acuan Desain dari `DESIGN.md`

Desain dashboard mengikuti konsep visual dari `DESIGN.md` dengan penyesuaian untuk kebutuhan sistem dashboard UMKM.

### 9.1 Warna

| Token | Warna | Penggunaan |
|---|---|---|
| Primary | `#e60023` | Tombol utama, status aktif, elemen penting |
| Primary Pressed | `#cc001f` | Kondisi tombol saat ditekan |
| Canvas | `#ffffff` | Background utama konten |
| Surface Soft | `#fbfbf9` | Background halaman dengan nuansa warm cream |
| Surface Card | `#f6f6f3` | Background card, tabel, dan panel dashboard |
| Ink | `#000000` | Judul utama dan teks penting |
| Body | `#33332e` | Teks isi |
| Mute | `#62625b` | Teks sekunder |
| Hairline | `#dadad3` | Garis pembatas tabel dan card |
| Success Pale | `#c7f0da` | Status berhasil atau stok aman |
| Error | `#9e0a0a` | Status gagal, stok habis, atau peringatan |

### 9.2 Tipografi

Karena Pin Sans bersifat proprietary, implementasi Laravel dapat menggunakan font pengganti seperti **Inter** atau **Manrope**.

| Elemen | Ukuran | Ketebalan |
|---|---|---|
| Judul Halaman | 28px–44px | 700 |
| Judul Card | 18px–22px | 600–700 |
| Isi Teks | 14px–16px | 400 |
| Tombol | 12px–14px | 700 |
| Caption | 12px | 400–500 |

### 9.3 Komponen UI

- Tombol utama menggunakan warna merah `#e60023`.
- Card menggunakan radius 16px.
- Modal menggunakan radius 32px.
- Filter menggunakan bentuk pill/rounded penuh.
- Tabel menggunakan background putih atau cream lembut.
- Grafik ditempatkan di dalam card rounded.
- Foto produk bouquet dapat ditampilkan seperti pin-card dengan gambar full-bleed.
- Layout dashboard menggunakan grid card agar rapi dan mudah dibaca.

### 9.4 Prinsip Tampilan

- Tampilan bersih, modern, dan tidak terlalu ramai.
- Gunakan warna merah hanya untuk aksi utama atau status aktif.
- Gunakan card untuk memisahkan bagian data.
- Gunakan grafik yang jelas dan mudah dibaca.
- Hindari penggunaan shadow berlebihan.
- Gunakan jarak antarbagian yang cukup agar dashboard tidak terlihat penuh.
- Dashboard harus responsive untuk laptop, tablet, dan handphone.

---

## 10. Arsitektur Sistem

Sistem menggunakan arsitektur Laravel berbasis MVC.

### 10.1 Frontend

Frontend bertugas menampilkan antarmuka pengguna, halaman dashboard, grafik, tabel, form, dan komponen visual lain.

**Teknologi frontend:**

- Blade Template Laravel.
- HTML.
- CSS.
- JavaScript.
- Chart.js.
- Vite untuk manajemen asset Laravel.

**Pemisahan frontend:**

- Folder `frontend/admin` untuk tampilan admin.
- Folder `frontend/user` untuk tampilan user.
- Komponen umum seperti layout, tombol, card, dan tabel dapat disimpan pada folder `frontend/shared`.

### 10.2 Backend

Backend bertugas mengatur proses bisnis, validasi data, penyimpanan data, autentikasi, otorisasi, dan pengolahan data analitik.

**Teknologi backend:**

- Laravel Controller.
- Laravel Model.
- Laravel Service.
- Laravel Middleware.
- Laravel Migration.
- Laravel Seeder.
- MySQL Database.

**Pemisahan backend:**

- Controller admin disimpan pada `backend/app/Http/Controllers/Admin`.
- Controller user disimpan pada `backend/app/Http/Controllers/User`.
- Service analitik disimpan pada `backend/app/Services`.
- Model disimpan pada `backend/app/Models`.

### 10.3 Database

Database menggunakan MySQL untuk menyimpan data pengguna, pelanggan, produk bouquet, kategori, transaksi, detail transaksi, pembayaran, stok, dan data ringkasan analitik.

---

## 11. Struktur Project

Struktur proyek dibuat dengan pemisahan yang jelas antara **frontend** dan **backend**, serta pemisahan tampilan **admin** dan **user**.

```text
dashboard-bouquet/
│
├── frontend/
│   ├── admin/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   └── navbar.blade.php
│   │   │
│   │   ├── pages/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── produk/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── kategori/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── pelanggan/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── detail.blade.php
│   │   │   ├── transaksi/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── detail.blade.php
│   │   │   ├── stok/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── riwayat.blade.php
│   │   │   └── laporan/
│   │   │       ├── penjualan.blade.php
│   │   │       └── cetak.blade.php
│   │   │
│   │   ├── components/
│   │   │   ├── card-stat.blade.php
│   │   │   ├── chart-card.blade.php
│   │   │   ├── table.blade.php
│   │   │   ├── button.blade.php
│   │   │   └── filter.blade.php
│   │   │
│   │   └── assets/
│   │       ├── css/
│   │       │   └── admin.css
│   │       └── js/
│   │           ├── dashboard-chart.js
│   │           ├── produk.js
│   │           └── laporan.js
│   │
│   ├── user/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   └── navbar.blade.php
│   │   │
│   │   ├── pages/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── produk/
│   │   │   │   └── index.blade.php
│   │   │   ├── transaksi/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── create.blade.php
│   │   │   ├── laporan/
│   │   │   │   └── ringkas.blade.php
│   │   │   └── profil/
│   │   │       └── index.blade.php
│   │   │
│   │   ├── components/
│   │   │   ├── card-stat.blade.php
│   │   │   ├── chart-card.blade.php
│   │   │   └── table.blade.php
│   │   │
│   │   └── assets/
│   │       ├── css/
│   │       │   └── user.css
│   │       └── js/
│   │           ├── dashboard-chart.js
│   │           └── transaksi.js
│   │
│   └── shared/
│       ├── components/
│       │   ├── alert.blade.php
│       │   ├── modal.blade.php
│       │   ├── input.blade.php
│       │   └── empty-state.blade.php
│       └── assets/
│           ├── css/
│           │   └── design-system.css
│           └── js/
│               └── helpers.js
│
├── backend/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Admin/
│   │   │   │   │   ├── DashboardController.php
│   │   │   │   │   ├── ProdukController.php
│   │   │   │   │   ├── KategoriController.php
│   │   │   │   │   ├── PelangganController.php
│   │   │   │   │   ├── TransaksiController.php
│   │   │   │   │   ├── StokController.php
│   │   │   │   │   ├── LaporanController.php
│   │   │   │   │   └── PenggunaController.php
│   │   │   │   │
│   │   │   │   ├── User/
│   │   │   │   │   ├── DashboardController.php
│   │   │   │   │   ├── ProdukController.php
│   │   │   │   │   ├── TransaksiController.php
│   │   │   │   │   ├── LaporanController.php
│   │   │   │   │   └── ProfilController.php
│   │   │   │   │
│   │   │   │   └── Auth/
│   │   │   │       ├── LoginController.php
│   │   │   │       └── LogoutController.php
│   │   │   │
│   │   │   ├── Middleware/
│   │   │   │   ├── CekRoleAdmin.php
│   │   │   │   └── CekRoleUser.php
│   │   │   │
│   │   │   └── Requests/
│   │   │       ├── ProdukRequest.php
│   │   │       ├── TransaksiRequest.php
│   │   │       └── PelangganRequest.php
│   │   │
│   │   ├── Models/
│   │   │   ├── Pengguna.php
│   │   │   ├── Pelanggan.php
│   │   │   ├── KategoriBouquet.php
│   │   │   ├── ProdukBouquet.php
│   │   │   ├── Transaksi.php
│   │   │   ├── DetailTransaksi.php
│   │   │   ├── Pembayaran.php
│   │   │   ├── StokProduk.php
│   │   │   └── RingkasanPenjualanHarian.php
│   │   │
│   │   └── Services/
│   │       ├── AnalitikService.php
│   │       ├── LaporanService.php
│   │       ├── StokService.php
│   │       └── TransaksiService.php
│   │
│   ├── database/
│   │   ├── migrations/
│   │   │   ├── create_pengguna_table.php
│   │   │   ├── create_pelanggan_table.php
│   │   │   ├── create_kategori_bouquet_table.php
│   │   │   ├── create_produk_bouquet_table.php
│   │   │   ├── create_transaksi_table.php
│   │   │   ├── create_detail_transaksi_table.php
│   │   │   ├── create_pembayaran_table.php
│   │   │   ├── create_stok_produk_table.php
│   │   │   └── create_ringkasan_penjualan_harian_table.php
│   │   │
│   │   ├── seeders/
│   │   │   ├── PenggunaSeeder.php
│   │   │   ├── KategoriBouquetSeeder.php
│   │   │   ├── ProdukBouquetSeeder.php
│   │   │   └── TransaksiSeeder.php
│   │   │
│   │   └── factories/
│   │       ├── ProdukBouquetFactory.php
│   │       └── TransaksiFactory.php
│   │
│   ├── routes/
│   │   ├── web.php
│   │   ├── admin.php
│   │   └── user.php
│   │
│   ├── config/
│   │   └── dashboard.php
│   │
│   ├── storage/
│   │   └── app/public/produk-bouquet/
│   │
│   └── tests/
│       ├── Feature/
│       └── Unit/
│
├── public/
│   ├── assets/
│   │   ├── admin/
│   │   ├── user/
│   │   └── shared/
│   └── storage/
│
├── docs/
│   ├── prd.md
│   ├── design.md
│   └── erd.md
│
├── .env
├── composer.json
├── package.json
└── README.md
```

### 11.1 Catatan Implementasi Laravel

Jika proyek dibuat langsung mengikuti struktur Laravel standar, folder di atas dapat dipetakan sebagai berikut:

| Konsep PRD | Struktur Laravel Standar |
|---|---|
| `frontend/admin/pages` | `resources/views/admin/pages` |
| `frontend/admin/components` | `resources/views/admin/components` |
| `frontend/user/pages` | `resources/views/user/pages` |
| `frontend/shared/components` | `resources/views/components` |
| `frontend/admin/assets/css` | `resources/css/admin` |
| `frontend/user/assets/css` | `resources/css/user` |
| `frontend/admin/assets/js` | `resources/js/admin` |
| `frontend/user/assets/js` | `resources/js/user` |
| `backend/app/Http/Controllers/Admin` | `app/Http/Controllers/Admin` |
| `backend/app/Http/Controllers/User` | `app/Http/Controllers/User` |
| `backend/app/Models` | `app/Models` |
| `backend/database/migrations` | `database/migrations` |
| `backend/routes` | `routes` |

Dengan pemetaan ini, struktur tetap sesuai standar Laravel, tetapi pembagian frontend, backend, admin, dan user tetap jelas.

---

## 12. Struktur Route

### 12.1 Route Admin

```php
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/produk', AdminProdukController::class);
        Route::resource('/kategori', AdminKategoriController::class);
        Route::resource('/pelanggan', AdminPelangganController::class);
        Route::resource('/transaksi', AdminTransaksiController::class);
        Route::resource('/stok', AdminStokController::class);
        Route::get('/laporan/penjualan', [AdminLaporanController::class, 'penjualan'])->name('laporan.penjualan');
    });
```

### 12.2 Route User

```php
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/produk', [UserProdukController::class, 'index'])->name('produk.index');
        Route::resource('/transaksi', UserTransaksiController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('/laporan/ringkas', [UserLaporanController::class, 'ringkas'])->name('laporan.ringkas');
        Route::get('/profil', [UserProfilController::class, 'index'])->name('profil.index');
    });
```

---

## 13. Entitas dan Atribut ERD

Seluruh nama entitas dan atribut menggunakan bahasa Indonesia agar mudah dipahami dalam dokumentasi proyek.

### 13.1 Entitas `pengguna`

Digunakan untuk menyimpan akun yang dapat login ke sistem.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_pengguna | BIGINT, PK | ID unik pengguna |
| nama_lengkap | VARCHAR(100) | Nama lengkap pengguna |
| email | VARCHAR(100), UNIQUE | Email untuk login |
| kata_sandi | VARCHAR(255) | Password yang sudah di-hash |
| peran | ENUM('admin', 'user') | Hak akses pengguna |
| status_akun | ENUM('aktif', 'nonaktif') | Status akun |
| terakhir_login | DATETIME, nullable | Waktu terakhir login |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.2 Entitas `pelanggan`

Digunakan untuk menyimpan data pelanggan yang membeli bouquet.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_pelanggan | BIGINT, PK | ID unik pelanggan |
| nama_pelanggan | VARCHAR(100) | Nama pelanggan |
| nomor_telepon | VARCHAR(20) | Nomor telepon pelanggan |
| alamat | TEXT, nullable | Alamat pelanggan |
| jenis_pelanggan | ENUM('baru', 'lama') | Jenis pelanggan |
| catatan | TEXT, nullable | Catatan tambahan |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.3 Entitas `kategori_bouquet`

Digunakan untuk mengelompokkan produk bouquet.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_kategori | BIGINT, PK | ID unik kategori |
| nama_kategori | VARCHAR(100) | Nama kategori, contoh: Bouquet Wisuda, Bouquet Ulang Tahun |
| deskripsi_kategori | TEXT, nullable | Deskripsi kategori |
| status_kategori | ENUM('aktif', 'nonaktif') | Status kategori |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.4 Entitas `produk_bouquet`

Digunakan untuk menyimpan data produk bouquet.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_produk | BIGINT, PK | ID unik produk |
| id_kategori | BIGINT, FK | Relasi ke kategori bouquet |
| nama_produk | VARCHAR(150) | Nama produk bouquet |
| deskripsi_produk | TEXT, nullable | Deskripsi produk |
| harga_produk | DECIMAL(12,2) | Harga jual produk |
| stok_produk | INT | Jumlah stok tersedia |
| batas_stok_rendah | INT | Batas minimal stok |
| foto_produk | VARCHAR(255), nullable | Lokasi foto produk |
| status_produk | ENUM('aktif', 'nonaktif') | Status produk |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.5 Entitas `transaksi`

Digunakan untuk menyimpan data utama transaksi penjualan.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_transaksi | BIGINT, PK | ID unik transaksi |
| id_pelanggan | BIGINT, FK | Relasi ke pelanggan |
| id_pengguna | BIGINT, FK | Pengguna yang menginput transaksi |
| kode_transaksi | VARCHAR(50), UNIQUE | Kode transaksi |
| tanggal_transaksi | DATETIME | Tanggal transaksi |
| total_item | INT | Total jumlah item yang dibeli |
| total_pembayaran | DECIMAL(12,2) | Total pembayaran transaksi |
| metode_pembayaran | ENUM('tunai', 'transfer', 'qris') | Metode pembayaran |
| status_transaksi | ENUM('berhasil', 'dibatalkan') | Status transaksi |
| catatan_transaksi | TEXT, nullable | Catatan transaksi |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.6 Entitas `detail_transaksi`

Digunakan untuk menyimpan daftar produk dalam satu transaksi.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_detail_transaksi | BIGINT, PK | ID unik detail transaksi |
| id_transaksi | BIGINT, FK | Relasi ke transaksi |
| id_produk | BIGINT, FK | Relasi ke produk bouquet |
| jumlah_terjual | INT | Jumlah produk yang dibeli |
| harga_satuan | DECIMAL(12,2) | Harga produk saat transaksi |
| subtotal | DECIMAL(12,2) | Harga satuan dikali jumlah terjual |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.7 Entitas `pembayaran`

Digunakan untuk menyimpan detail pembayaran transaksi.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_pembayaran | BIGINT, PK | ID unik pembayaran |
| id_transaksi | BIGINT, FK | Relasi ke transaksi |
| tanggal_pembayaran | DATETIME | Tanggal pembayaran |
| metode_pembayaran | ENUM('tunai', 'transfer', 'qris') | Metode pembayaran |
| jumlah_bayar | DECIMAL(12,2) | Jumlah uang yang dibayar |
| status_pembayaran | ENUM('lunas', 'belum_lunas') | Status pembayaran |
| bukti_pembayaran | VARCHAR(255), nullable | Bukti pembayaran jika diperlukan |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.8 Entitas `stok_produk`

Digunakan untuk menyimpan riwayat perubahan stok produk.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_stok | BIGINT, PK | ID unik riwayat stok |
| id_produk | BIGINT, FK | Relasi ke produk bouquet |
| id_pengguna | BIGINT, FK | Pengguna yang mengubah stok |
| jenis_perubahan | ENUM('masuk', 'keluar', 'penyesuaian') | Jenis perubahan stok |
| jumlah_perubahan | INT | Jumlah perubahan stok |
| stok_sebelum | INT | Stok sebelum perubahan |
| stok_sesudah | INT | Stok setelah perubahan |
| keterangan | TEXT, nullable | Catatan perubahan stok |
| tanggal_perubahan | DATETIME | Waktu perubahan stok |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.9 Entitas `ringkasan_penjualan_harian`

Digunakan untuk menyimpan hasil ringkasan analitik harian agar dashboard lebih cepat ditampilkan.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_ringkasan | BIGINT, PK | ID unik ringkasan |
| tanggal_ringkasan | DATE | Tanggal ringkasan data |
| total_transaksi | INT | Jumlah transaksi pada tanggal tersebut |
| total_produk_terjual | INT | Jumlah produk terjual |
| total_pendapatan | DECIMAL(12,2) | Total pendapatan harian |
| jumlah_pelanggan_baru | INT | Jumlah pelanggan baru |
| jumlah_pelanggan_lama | INT | Jumlah pelanggan lama |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

### 13.10 Entitas `aktivitas_pengguna`

Digunakan untuk menyimpan catatan aktivitas penting yang dilakukan pengguna.

| Atribut | Tipe Data | Keterangan |
|---|---|---|
| id_aktivitas | BIGINT, PK | ID unik aktivitas |
| id_pengguna | BIGINT, FK | Relasi ke pengguna |
| nama_aktivitas | VARCHAR(150) | Nama aktivitas |
| deskripsi_aktivitas | TEXT, nullable | Detail aktivitas |
| waktu_aktivitas | DATETIME | Waktu aktivitas dilakukan |
| dibuat_pada | TIMESTAMP | Waktu data dibuat |
| diperbarui_pada | TIMESTAMP | Waktu data diperbarui |

---

## 14. Relasi ERD

| Relasi | Keterangan |
|---|---|
| `pengguna` 1 ke banyak `transaksi` | Satu pengguna dapat menginput banyak transaksi |
| `pengguna` 1 ke banyak `stok_produk` | Satu pengguna dapat membuat banyak perubahan stok |
| `pengguna` 1 ke banyak `aktivitas_pengguna` | Satu pengguna memiliki banyak catatan aktivitas |
| `pelanggan` 1 ke banyak `transaksi` | Satu pelanggan dapat melakukan banyak transaksi |
| `kategori_bouquet` 1 ke banyak `produk_bouquet` | Satu kategori memiliki banyak produk bouquet |
| `produk_bouquet` 1 ke banyak `detail_transaksi` | Satu produk dapat muncul pada banyak detail transaksi |
| `transaksi` 1 ke banyak `detail_transaksi` | Satu transaksi dapat memiliki banyak produk |
| `transaksi` 1 ke 1 `pembayaran` | Satu transaksi memiliki satu data pembayaran |
| `produk_bouquet` 1 ke banyak `stok_produk` | Satu produk memiliki banyak riwayat perubahan stok |

---

## 15. Rumus dan Logika Analitik

| Informasi | Rumus / Logika |
|---|---|
| Total Pendapatan | `SUM(transaksi.total_pembayaran)` dengan status transaksi berhasil |
| Total Transaksi | `COUNT(transaksi.id_transaksi)` |
| Produk Terlaris | `SUM(detail_transaksi.jumlah_terjual)` dikelompokkan berdasarkan produk |
| Kategori Terlaris | Total jumlah terjual dikelompokkan berdasarkan kategori produk |
| Rata-rata Nilai Transaksi | Total pendapatan dibagi total transaksi |
| Pelanggan Baru | Pelanggan yang pertama kali muncul pada periode tertentu |
| Pelanggan Lama | Pelanggan yang sudah memiliki transaksi sebelumnya |
| Stok Rendah | Produk dengan `stok_produk <= batas_stok_rendah` |
| Tren Penjualan | Total transaksi atau pendapatan dikelompokkan berdasarkan tanggal/bulan |

---

## 16. Alur Penggunaan Sistem

### 16.1 Alur Admin

1. Admin membuka halaman login.
2. Admin memasukkan email dan password.
3. Sistem memvalidasi akun admin.
4. Admin masuk ke dashboard admin.
5. Admin melihat ringkasan penjualan dan grafik.
6. Admin dapat mengelola produk, kategori, pelanggan, transaksi, stok, dan laporan.
7. Admin menggunakan filter untuk membaca data tertentu.
8. Admin mengambil keputusan berdasarkan hasil dashboard.

### 16.2 Alur User

1. User membuka halaman login.
2. User memasukkan email dan password.
3. Sistem memvalidasi akun user.
4. User masuk ke dashboard user.
5. User melihat ringkasan data yang diizinkan.
6. User dapat melihat produk dan menambahkan transaksi.
7. Sistem menyimpan transaksi dan memperbarui stok.
8. User dapat melihat riwayat transaksi yang sudah diinput.

---

## 17. Kebutuhan Non-Fungsional

### 17.1 Keamanan

- Password harus disimpan menggunakan hashing Laravel.
- Setiap halaman harus dilindungi middleware autentikasi.
- Akses admin dan user harus dibedakan menggunakan middleware role.
- Form harus menggunakan CSRF token.
- Upload gambar produk harus divalidasi berdasarkan tipe file dan ukuran.

### 17.2 Performa

- Dashboard harus dapat dimuat dalam waktu yang wajar.
- Query grafik harus menggunakan filter periode agar tidak terlalu berat.
- Data ringkasan harian dapat disimpan pada tabel khusus untuk mempercepat dashboard.
- Gambar produk harus dikompresi agar tidak memperlambat halaman.

### 17.3 Kemudahan Penggunaan

- Menu navigasi harus jelas.
- Tampilan dashboard harus sederhana dan mudah dipahami.
- Form input harus memiliki label yang jelas.
- Grafik harus memiliki judul, legenda, dan satuan data.
- Tabel harus memiliki fitur pencarian dan filter.

### 17.4 Responsivitas

- Dashboard harus bisa digunakan di laptop, tablet, dan handphone.
- Pada layar kecil, card dashboard disusun satu kolom.
- Sidebar dapat berubah menjadi menu hamburger pada tampilan mobile.
- Grafik harus menyesuaikan lebar layar.

---

## 18. Acceptance Criteria

| Fitur | Kriteria Berhasil |
|---|---|
| Login | Pengguna dapat masuk sesuai role dan diarahkan ke halaman yang benar |
| Dashboard Admin | Admin dapat melihat kartu ringkasan dan grafik utama |
| Dashboard User | User dapat melihat halaman sesuai hak aksesnya |
| Produk | Admin dapat menambah, mengedit, dan menonaktifkan produk bouquet |
| Transaksi | Sistem dapat menyimpan transaksi dan menghitung total otomatis |
| Stok | Stok produk berkurang setelah transaksi berhasil |
| Grafik | Grafik menampilkan data berdasarkan transaksi yang tersimpan |
| Filter | Data dashboard berubah sesuai filter yang dipilih |
| Laporan | Admin dapat melihat laporan penjualan berdasarkan periode |
| Role | User tidak dapat mengakses halaman admin |

---

## 19. Prioritas Pengembangan

### Tahap 1 — Dasar Sistem

- Setup Laravel dan MySQL.
- Membuat autentikasi login.
- Membuat role admin dan user.
- Membuat migration database utama.
- Membuat layout admin dan user.

### Tahap 2 — Data Master

- CRUD kategori bouquet.
- CRUD produk bouquet.
- CRUD pelanggan.
- Upload foto produk.

### Tahap 3 — Transaksi dan Stok

- Input transaksi.
- Detail transaksi.
- Perhitungan total otomatis.
- Pengurangan stok otomatis.
- Riwayat stok produk.

### Tahap 4 — Dashboard Analitik

- Kartu ringkasan.
- Grafik penjualan.
- Grafik pendapatan.
- Grafik produk terlaris.
- Grafik tren pelanggan.
- Grafik stok produk.

### Tahap 5 — Laporan dan Penyempurnaan

- Filter laporan.
- Cetak laporan.
- Export laporan jika dibutuhkan.
- Penyempurnaan UI sesuai `DESIGN.md`.
- Testing fitur admin dan user.

---

## 20. Output yang Diharapkan

Hasil akhir dari proyek ini adalah aplikasi dashboard analitik berbasis web dengan struktur proyek yang rapi, yaitu frontend dan backend dipisahkan, serta halaman admin dan user dikelompokkan dalam folder masing-masing. Sistem mampu mencatat transaksi penjualan bouquet bunga, mengelola produk dan pelanggan, serta menampilkan grafik analitik yang membantu pemilik UMKM memahami penjualan, tren pelanggan, dan performa bisnis.
