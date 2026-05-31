<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'kata_sandi',
        'peran',
        'status_akun',
        'terakhir_login',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    protected $casts = [
        'terakhir_login' => 'datetime',
    ];

    /**
     * Override default password field for Laravel auth.
     */
    public function getAuthPassword(): string
    {
        return $this->kata_sandi;
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna', 'id_pengguna');
    }

    public function stokProduk()
    {
        return $this->hasMany(StokProduk::class, 'id_pengguna', 'id_pengguna');
    }

    public function aktivitas()
    {
        return $this->hasMany(AktivitasPengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function isUser(): bool
    {
        return $this->peran === 'user';
    }

    public function isAktif(): bool
    {
        return $this->status_akun === 'aktif';
    }
}
