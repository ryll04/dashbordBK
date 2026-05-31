<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukBouquet extends Model
{
    use HasFactory;

    protected $table = 'produk_bouquet';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'stok_produk',
        'batas_stok_rendah',
        'foto_produk',
        'status_produk',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBouquet::class, 'id_kategori', 'id_kategori');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk', 'id_produk');
    }

    public function riwayatStok()
    {
        return $this->hasMany(StokProduk::class, 'id_produk', 'id_produk');
    }

    public function getStokRendahAttribute()
    {
        return $this->stok_produk <= $this->batas_stok_rendah;
    }
}
