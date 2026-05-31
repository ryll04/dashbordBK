# 🌸 Panduan Instalasi Dashboard UMKM Bouquet

Selamat datang di **Dashboard Analitik UMKM Bouquet Bunga**, aplikasi dashboard modern bertema **Pink & White** dengan standar visual **Shadcn UI** untuk membantu pemilik UMKM memantau performa penjualan secara realtime.

Dokumen ini menjelaskan langkah-langkah instalasi aplikasi di perangkat lokal Anda menggunakan **XAMPP** dan **Windows PowerShell/Command Prompt**.

---

## 📋 Prasyarat Sistem
Pastikan perangkat Anda sudah terpasang:
1. **XAMPP** (dengan versi PHP minimal 8.2)
2. **Node.js** (versi LTS terbaru)
3. **Composer** (jika belum ada secara global, panduan di bawah menggunakan file `composer.phar` lokal yang sangat praktis)

---

## 🛠️ Langkah Instalasi Lengkap

### Langkah 1: Persiapan Folder Project
1. Buka aplikasi terminal pilihan Anda (misalnya **PowerShell**).
2. Arahkan terminal ke dalam direktori project ini:
   ```powershell
   cd "C:\Users\solit\Documents\SEMESTER 6\Projek BK\dashbordBK"
   ```

### Langkah 2: Mengaktifkan Ekstensi PHP di XAMPP
Buka file konfigurasi `php.ini` Anda (biasanya di `C:\xampp\php\php.ini`) dan pastikan ekstensi berikut tidak dikomentari (hilangkan tanda titik koma `;` di depannya):
* `extension=zip` (Wajib untuk mengunduh package composer)
* `extension=gd` (Wajib untuk manipulasi gambar produk)
* `extension=pdo_mysql` (Wajib untuk menghubungkan ke database MySQL)

*Catatan: Anda juga bisa mengedit file ini lewat panel XAMPP Control Panel dengan mengklik tombol **Config** di baris Apache, lalu pilih **PHP (php.ini)**.*

### Langkah 3: Menginstal Dependensi PHP (Composer)
Jika perintah `composer` global belum terpasang di perangkat Anda, gunakan file `composer.phar` lokal yang telah kami unduh ke folder project ini. Jalankan perintah berikut menggunakan PHP dari XAMPP:
```powershell
C:\xampp\php\php.exe composer.phar install
```

### Langkah 4: Setup File Konfigurasi `.env`
1. Duplikat file `.env.example` menjadi file baru bernama `.env`:
   ```powershell
   Copy-Item .env.example .env
   ```
2. Buka file `.env` di VS Code / editor teks lainnya dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dashbord_bk    # Ganti dengan nama database Anda di phpMyAdmin
   DB_USERNAME=root           # Default XAMPP
   DB_PASSWORD=               # Kosongkan untuk default XAMPP
   ```
3. Generate kunci pengaman enkripsi Laravel:
   ```powershell
   C:\xampp\php\php.exe artisan key:generate
   ```

### Langkah 5: Migrasi Database & Seeding Data
1. Aktifkan service **Apache** dan **MySQL** di panel **XAMPP Control Panel**.
2. Masuk ke `http://localhost/phpmyadmin/` lewat browser Anda dan buat database baru bernama `dashbord_bk` (atau sesuai nama yang Anda atur di `.env`).
3. Jalankan migrasi tabel beserta pengisian data uji otomatis (seeder):
   ```powershell
   C:\xampp\php\php.exe artisan migrate --seed
   ```

### Langkah 6: Menginstal & Menjalankan Aset Frontend (Vite)
1. Instal paket dependensi Javascript/CSS:
   ```powershell
   npm install
   ```
2. Jalankan server kompilator aset frontend Vite secara lokal:
   ```powershell
   npm run dev
   ```
   *Biarkan terminal ini tetap terbuka dan berjalan di background agar gaya visual dashboard (CSS/JS) dapat termuat secara dinamis.*

### Langkah 7: Menjalankan Server Laravel
Buka tab terminal baru (atau biarkan berjalan di background jika terminal mendukung) dan jalankan development server Laravel dengan perintah:
```powershell
C:\xampp\php\php.exe artisan serve
```
Aplikasi Anda siap diakses di web browser pada tautan: **`http://127.0.0.1:8000`**

---

## 🔑 Informasi Akun Uji Coba (Login Default)
Gunakan kredensial berikut untuk masuk sebagai administrator di halaman login:

* **Email**: `admin@bouquet.com` (atau email administrator yang ada di database seeder)
* **Password**: `password` (atau password default yang di-seed)

---

## 📈 Fitur Unggulan Dashboard "Pink & White"
* **Ringkasan KPI Bisnis**: Tampilan total pendapatan, jumlah transaksi, total produk terjual, dan jumlah pelanggan aktif secara realtime.
* **Grafik Interaktif Bulanan**: Pilih bulan lewat dropdown select, dan grafik batang gradasi pink premium akan menampilkan tren harian untuk bulan terpilih.
* **Produk Terlaris**: Daftar visual produk terpopuler lengkap dengan bar persentase representasi penjualan.
* **Tabel Transaksi Modern**: Dilengkapi dengan badge lunas (hijau), proses (kuning), dan batal (merah) bergaya minimalis ala Shadcn UI.
* **Notifikasi Stok Kritis**: Chip pemberitahuan pintar saat stok bahan atau produk di inventori Anda mendekati atau telah habis.
