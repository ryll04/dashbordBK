<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_bouquet', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk', 150);
            $table->text('deskripsi_produk')->nullable();
            $table->decimal('harga_produk', 12, 2);
            $table->integer('stok_produk')->default(0);
            $table->integer('batas_stok_rendah')->default(5);
            $table->string('foto_produk', 255)->nullable();
            $table->enum('status_produk', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('kategori_bouquet')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_bouquet');
    }
};
