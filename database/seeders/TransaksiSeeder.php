<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 sample transactions over the last 7 days
        for ($i = 1; $i <= 10; $i++) {
            $tanggal = Carbon::now()->subDays(rand(0, 7));
            $total_pembayaran = rand(150000, 600000);
            
            $transaksi = Transaksi::create([
                'id_pelanggan' => rand(1, 5),
                'id_pengguna' => rand(1, 2),
                'kode_transaksi' => 'TRX-' . $tanggal->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal_transaksi' => $tanggal,
                'total_item' => rand(1, 3),
                'total_pembayaran' => $total_pembayaran,
                'metode_pembayaran' => ['tunai', 'transfer', 'qris'][array_rand(['tunai', 'transfer', 'qris'])],
                'status_transaksi' => 'berhasil',
            ]);

            // Create 1-2 details for each transaction
            for ($j = 1; $j <= rand(1, 2); $j++) {
                $harga = rand(100000, 300000);
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => rand(1, 8),
                    'jumlah_terjual' => 1,
                    'harga_satuan' => $harga,
                    'subtotal' => $harga,
                ]);
            }

            // Create payment
            Pembayaran::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'tanggal_pembayaran' => $tanggal,
                'metode_pembayaran' => $transaksi->metode_pembayaran,
                'jumlah_bayar' => $total_pembayaran,
                'status_pembayaran' => 'lunas',
            ]);
        }
    }
}
