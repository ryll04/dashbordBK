<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas_pengguna', function (Blueprint $table) {
            $table->id('id_aktivitas');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nama_aktivitas', 150);
            $table->text('deskripsi_aktivitas')->nullable();
            $table->dateTime('waktu_aktivitas');
            $table->timestamps();

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas_pengguna');
    }
};
