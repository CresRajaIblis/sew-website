<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            // 1. Tambahkan kolom pesanan_id yang tidak bisa NULL (harus ada ID Pesanan)
            // Kolom ini mengacu pada kolom 'id' di tabel 'pesanans'.
            $table->foreignId('pesanan_id')
                  ->nullable() // Karena kolom mungkin baru ditambahkan, buat nullable sementara jika data lama ada.
                  ->after('id')
                  ->constrained('pesanans')
                  ->onDelete('cascade'); // Jika pesanan dihapus, ulasan ikut dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            // Hapus foreign key sebelum menghapus kolom
            $table->dropForeign(['pesanan_id']); 
            $table->dropColumn('pesanan_id');
        });
    }
};