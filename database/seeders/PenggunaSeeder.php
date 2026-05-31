<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'nama_lengkap' => 'Admin Utama',
            'email' => 'admin@bouquet.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'admin',
            'status_akun' => 'aktif',
        ]);

        Pengguna::create([
            'nama_lengkap' => 'Staf Penjualan',
            'email' => 'user@bouquet.com',
            'kata_sandi' => Hash::make('password123'),
            'peran' => 'user',
            'status_akun' => 'aktif',
        ]);
    }
}
