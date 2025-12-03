<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom google_id
            $table->string('google_id')->nullable()->after('email');
            // Ubah password jadi boleh kosong (karena login Google gapake password)
            $table->string('password')->nullable()->change();
            // Tambah kolom username & role jika belum ada di migrasi awal
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            // Kembalikan password jadi wajib (hati-hati jika rollback)
            // $table->string('password')->nullable(false)->change(); 
        });
    }
};
