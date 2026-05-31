<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasPengguna extends Model
{
    protected $table = 'aktivitas_pengguna';
    protected $primaryKey = 'id_aktivitas';

    protected $fillable = [
        'id_pengguna',
        'nama_aktivitas',
        'deskripsi_aktivitas',
        'waktu_aktivitas',
    ];

    protected $casts = [
        'waktu_aktivitas' => 'datetime',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
