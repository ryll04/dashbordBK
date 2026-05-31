<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    protected $table = 'stok_produk';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'id_produk',
        'id_pengguna',
        'jenis_perubahan',
        'jumlah_perubahan',
        'stok_sebelum',
        'stok_sesudah',
        'keterangan',
        'tanggal_perubahan',
    ];

    protected $casts = [
        'tanggal_perubahan' => 'datetime',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukBouquet::class, 'id_produk', 'id_produk');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
