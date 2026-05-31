<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBouquet;

class KategoriBouquetSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Bouquet Wisuda', 'deskripsi_kategori' => 'Bouquet khusus untuk perayaan wisuda kelulusan.'],
            ['nama_kategori' => 'Bouquet Ulang Tahun', 'deskripsi_kategori' => 'Hadiah bouquet cantik untuk perayaan ulang tahun.'],
            ['nama_kategori' => 'Bouquet Anniversary', 'deskripsi_kategori' => 'Bouquet romantis untuk momen anniversary.'],
            ['nama_kategori' => 'Bouquet Hari Ibu', 'deskripsi_kategori' => 'Bouquet spesial untuk hadiah di Hari Ibu.'],
            ['nama_kategori' => 'Bouquet Hari Guru', 'deskripsi_kategori' => 'Bouquet ucapan terima kasih untuk perayaan Hari Guru.'],
            ['nama_kategori' => 'Bouquet Custom', 'deskripsi_kategori' => 'Bouquet dengan desain dan pilihan bunga bebas.'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriBouquet::create($kategori);
        }
    }
}
