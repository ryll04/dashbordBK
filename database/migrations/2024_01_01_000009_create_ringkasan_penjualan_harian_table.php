<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ringkasan_penjualan_harian', function (Blueprint $table) {
            $table->id('id_ringkasan');
            $table->date('tanggal_ringkasan')->unique();
            $table->integer('total_transaksi')->default(0);
            $table->integer('total_produk_terjual')->default(0);
            $table->decimal('total_pendapatan', 12, 2)->default(0);
            $table->integer('jumlah_pelanggan_baru')->default(0);
            $table->integer('jumlah_pelanggan_lama')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ringkasan_penjualan_harian');
    }
};
