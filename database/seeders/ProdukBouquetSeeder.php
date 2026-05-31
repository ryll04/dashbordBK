<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukBouquet;

class ProdukBouquetSeeder extends Seeder
{
    public function run(): void
    {
        $produks = [
            // Wisuda
            ['id_kategori' => 1, 'nama_produk' => 'Bouquet Mawar Merah Wisuda', 'harga_produk' => 150000, 'stok_produk' => 10, 'batas_stok_rendah' => 3],
            ['id_kategori' => 1, 'nama_produk' => 'Bouquet Matahari Boneka Teddy', 'harga_produk' => 200000, 'stok_produk' => 15, 'batas_stok_rendah' => 5],
            // Ulang Tahun
            ['id_kategori' => 2, 'nama_produk' => 'Bouquet Tulip Pink', 'harga_produk' => 180000, 'stok_produk' => 8, 'batas_stok_rendah' => 2],
            ['id_kategori' => 2, 'nama_produk' => 'Bouquet Cokelat Ferrero', 'harga_produk' => 250000, 'stok_produk' => 20, 'batas_stok_rendah' => 5],
            // Anniversary
            ['id_kategori' => 3, 'nama_produk' => 'Bouquet 50 Mawar Merah', 'harga_produk' => 500000, 'stok_produk' => 5, 'batas_stok_rendah' => 2],
            ['id_kategori' => 3, 'nama_produk' => 'Bouquet Lily Putih Premium', 'harga_produk' => 300000, 'stok_produk' => 10, 'batas_stok_rendah' => 3],
            // Hari Ibu
            ['id_kategori' => 4, 'nama_produk' => 'Bouquet Anyelir Klasik', 'harga_produk' => 120000, 'stok_produk' => 12, 'batas_stok_rendah' => 4],
            // Hari Guru
            ['id_kategori' => 5, 'nama_produk' => 'Bouquet Anggrek Simpel', 'harga_produk' => 100000, 'stok_produk' => 25, 'batas_stok_rendah' => 5],
        ];

        foreach ($produks as $produk) {
            ProdukBouquet::create($produk);
        }
    }
}
