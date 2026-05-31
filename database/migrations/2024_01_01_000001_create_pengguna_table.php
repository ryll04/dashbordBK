<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('kata_sandi', 255);
            $table->enum('peran', ['admin', 'user'])->default('user');
            $table->enum('status_akun', ['aktif', 'nonaktif'])->default('aktif');
            $table->dateTime('terakhir_login')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
