<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <--- JANGAN LUPA TAMBAHKAN INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Gunakan Raw SQL agar tidak perlu install doctrine/dbal
        // Perintah ini mengubah kolom 'role' menjadi VARCHAR(20) dan default 'user'
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(20) DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Kembalikan ke ENUM jika di-rollback (Opsional)
        // DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pegawai')");
    }
};