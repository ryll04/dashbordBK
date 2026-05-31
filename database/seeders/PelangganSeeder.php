<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggans = [
            ['nama_pelanggan' => 'Andi Susanto', 'nomor_telepon' => '081234567890', 'alamat' => 'Jl. Mawar No. 12', 'jenis_pelanggan' => 'lama'],
            ['nama_pelanggan' => 'Budi Pratama', 'nomor_telepon' => '081987654321', 'alamat' => 'Jl. Melati No. 5', 'jenis_pelanggan' => 'baru'],
            ['nama_pelanggan' => 'Citra Dewi', 'nomor_telepon' => '081223344556', 'alamat' => 'Perum Indah Blok B', 'jenis_pelanggan' => 'lama'],
            ['nama_pelanggan' => 'Deni Ramadhan', 'nomor_telepon' => '081334455667', 'alamat' => 'Jl. Kamboja Raya', 'jenis_pelanggan' => 'baru'],
            ['nama_pelanggan' => 'Eka Putri', 'nomor_telepon' => '081445566778', 'alamat' => 'Apartemen Cempaka', 'jenis_pelanggan' => 'lama'],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
