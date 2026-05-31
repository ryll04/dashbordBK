<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBouquet extends Model
{
    protected $table = 'kategori_bouquet';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi_kategori',
        'status_kategori',
    ];

    public function produk()
    {
        return $this->hasMany(ProdukBouquet::class, 'id_kategori', 'id_kategori');
    }

    public function produkAktif()
    {
        return $this->hasMany(ProdukBouquet::class, 'id_kategori', 'id_kategori')
                    ->where('status_produk', 'aktif');
    }
}
