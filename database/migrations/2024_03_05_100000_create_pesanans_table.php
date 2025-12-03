<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Pesanan Utama (Header)
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique(); // Contoh: ZT-1708999
            $table->integer('nomor_antrian');
            $table->string('nama_pemesan');
            $table->string('no_telepon');
            $table->string('email');
            $table->text('alamat');
            $table->text('catatan')->nullable();
            $table->decimal('total_harga', 15, 2);
            $table->string('metode_pembayaran');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamps();
        });

        // 2. Tabel Detail Pesanan (Isi Keranjang)
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('warna')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pesanans');
        Schema::dropIfExists('pesanans');
    }
};