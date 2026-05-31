<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('kode_transaksi', 50)->unique();
            $table->dateTime('tanggal_transaksi');
            $table->integer('total_item')->default(0);
            $table->decimal('total_pembayaran', 12, 2)->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris'])->default('tunai');
            $table->enum('status_transaksi', ['berhasil', 'dibatalkan'])->default('berhasil');
            $table->text('catatan_transaksi')->nullable();
            $table->timestamps();

            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('restrict');

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
