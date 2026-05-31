<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use App\Models\ProdukBouquet;
use App\Models\RingkasanPenjualanHarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiService
{
    protected StokService $stokService;

    public function __construct(StokService $stokService)
    {
        $this->stokService = $stokService;
    }

    /**
     * Membuat transaksi baru beserta detail, pembayaran, pengurangan stok, dan update ringkasan.
     */
    public function buatTransaksi(array $dataTransaksi, array $items, array $dataPembayaran)
    {
        return DB::transaction(function () use ($dataTransaksi, $items, $dataPembayaran) {
            // Generate Kode Transaksi TRX-YYYYMMDD-XXXX
            $tanggal = Carbon::parse($dataTransaksi['tanggal_transaksi'] ?? now());
            $kodePrefix = 'TRX-' . $tanggal->format('Ymd') . '-';
            
            $lastTrx = Transaksi::where('kode_transaksi', 'like', $kodePrefix . '%')
                        ->orderBy('id_transaksi', 'desc')
                        ->first();
                        
            $urutan = $lastTrx ? intval(substr($lastTrx->kode_transaksi, -4)) + 1 : 1;
            $kodeTransaksi = $kodePrefix . str_pad($urutan, 4, '0', STR_PAD_LEFT);

            // 1. Buat Transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $dataTransaksi['id_pelanggan'],
                'id_pengguna' => Auth::id() ?? 1, // Fallback if CLI
                'kode_transaksi' => $kodeTransaksi,
                'tanggal_transaksi' => $tanggal,
                'total_item' => 0, // Dihitung di bawah
                'total_pembayaran' => 0, // Dihitung di bawah
                'metode_pembayaran' => $dataPembayaran['metode_pembayaran'] ?? 'tunai',
                'status_transaksi' => 'berhasil',
                'catatan_transaksi' => $dataTransaksi['catatan_transaksi'] ?? null,
            ]);

            $totalItem = 0;
            $totalPembayaran = 0;

            // 2. Buat Detail Transaksi dan Kurangi Stok
            foreach ($items as $item) {
                $produk = ProdukBouquet::findOrFail($item['id_produk']);
                
                // Cek Stok
                if ($produk->stok_produk < $item['jumlah_terjual']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi. Tersisa: {$produk->stok_produk}");
                }

                $subtotal = $produk->harga_produk * $item['jumlah_terjual'];

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $produk->id_produk,
                    'jumlah_terjual' => $item['jumlah_terjual'],
                    'harga_satuan' => $produk->harga_produk,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi Stok menggunakan Service
                $this->stokService->catatStok(
                    $produk, 
                    'keluar', 
                    $item['jumlah_terjual'], 
                    "Penjualan dari Transaksi {$kodeTransaksi}"
                );

                $totalItem += $item['jumlah_terjual'];
                $totalPembayaran += $subtotal;
            }

            // Update Transaksi Totals
            $transaksi->update([
                'total_item' => $totalItem,
                'total_pembayaran' => $totalPembayaran,
            ]);

            // 3. Catat Pembayaran
            Pembayaran::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'tanggal_pembayaran' => $tanggal,
                'metode_pembayaran' => $transaksi->metode_pembayaran,
                'jumlah_bayar' => $dataPembayaran['jumlah_bayar'] ?? $totalPembayaran,
                'status_pembayaran' => 'lunas',
            ]);

            // 4. Update Ringkasan Penjualan Harian
            $this->updateRingkasanHarian($tanggal->toDateString(), $transaksi);

            return $transaksi;
        });
    }

    private function updateRingkasanHarian($tanggal, Transaksi $transaksi)
    {
        $ringkasan = RingkasanPenjualanHarian::firstOrCreate(
            ['tanggal_ringkasan' => $tanggal],
            [
                'total_transaksi' => 0,
                'total_produk_terjual' => 0,
                'total_pendapatan' => 0,
                'jumlah_pelanggan_baru' => 0,
                'jumlah_pelanggan_lama' => 0,
            ]
        );

        $ringkasan->total_transaksi += 1;
        $ringkasan->total_produk_terjual += $transaksi->total_item;
        $ringkasan->total_pendapatan += $transaksi->total_pembayaran;
        
        if ($transaksi->pelanggan && $transaksi->pelanggan->jenis_pelanggan === 'baru') {
            $ringkasan->jumlah_pelanggan_baru += 1;
        } else {
            $ringkasan->jumlah_pelanggan_lama += 1;
        }

        $ringkasan->save();
    }
}
