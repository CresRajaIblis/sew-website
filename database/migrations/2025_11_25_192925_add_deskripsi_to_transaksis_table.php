<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom 'deskripsi' yang hilang.
     */
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Kolom ini tidak ada di tabel, jadi kita tambahkan sekarang.
            $table->text('deskripsi')->nullable()->after('nominal');
        });
    }

    /**
     * Reverse the migrations.
     * Mengembalikan keadaan semula jika rollback.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};