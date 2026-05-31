<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingkasanPenjualanHarian extends Model
{
    protected $table = 'ringkasan_penjualan_harian';
    protected $primaryKey = 'id_ringkasan';

    protected $fillable = [
        'tanggal_ringkasan',
        'total_transaksi',
        'total_produk_terjual',
        'total_pendapatan',
        'jumlah_pelanggan_baru',
        'jumlah_pelanggan_lama',
    ];

    protected $casts = [
        'tanggal_ringkasan' => 'date',
    ];
}
