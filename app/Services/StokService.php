<?php

namespace App\Services;

use App\Models\ProdukBouquet;
use App\Models\StokProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StokService
{
    /**
     * Catat perubahan stok dan perbarui jumlah stok di tabel produk.
     */
    public function catatStok(ProdukBouquet $produk, $jenis, $jumlah, $keterangan = null)
    {
        return DB::transaction(function () use ($produk, $jenis, $jumlah, $keterangan) {
            $stokSebelum = $produk->stok_produk;
            $stokSesudah = $stokSebelum;

            if ($jenis === 'masuk') {
                $stokSesudah += $jumlah;
            } elseif ($jenis === 'keluar') {
                $stokSesudah -= $jumlah;
            } elseif ($jenis === 'penyesuaian') {
                // Untuk penyesuaian, parameter $jumlah merepresentasikan stok akhir
                $stokSesudah = $jumlah;
                $jumlah = abs($stokSesudah - $stokSebelum);
            }

            if ($stokSesudah < 0) {
                throw new \Exception("Stok tidak boleh kurang dari 0.");
            }

            $produk->update(['stok_produk' => $stokSesudah]);

            return StokProduk::create([
                'id_produk' => $produk->id_produk,
                'id_pengguna' => Auth::id() ?? 1, // Fallback if CLI
                'jenis_perubahan' => $jenis,
                'jumlah_perubahan' => $jumlah,
                'stok_sebelum' => $stokSebelum,
                'stok_sesudah' => $stokSesudah,
                'keterangan' => $keterangan,
                'tanggal_perubahan' => now(),
            ]);
        });
    }
}
