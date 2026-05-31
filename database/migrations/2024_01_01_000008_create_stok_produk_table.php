<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_produk', function (Blueprint $table) {
            $table->id('id_stok');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pengguna');
            $table->enum('jenis_perubahan', ['masuk', 'keluar', 'penyesuaian']);
            $table->integer('jumlah_perubahan');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal_perubahan');
            $table->timestamps();

            $table->foreign('id_produk')
                  ->references('id_produk')
                  ->on('produk_bouquet')
                  ->onDelete('cascade');

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_produk');
    }
};
