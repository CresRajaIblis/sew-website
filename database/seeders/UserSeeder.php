<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema; // PENTING: Import Schema
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     * Membuat user dasar (Admin dan User biasa).
     *
     * @return void
     */
    public function run()
    {
        // --- 1. NONAKTIFKAN FOREIGN KEY CHECKS ---
        Schema::disableForeignKeyConstraints();
        
        // Bersihkan tabel users (sekarang aman karena checks nonaktif)
        DB::table('users')->truncate(); 

        DB::table('users')->insert([
            [
                'name' => 'Admin Zulaeha',
                'username' => 'admin', // DITAMBAHKAN: Kolom username
                'email' => 'admin@zulaehat.com',
                'password' => Hash::make('password'),
                'role' => 'admin', 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User Pelanggan',
                'username' => 'userpelanggan', // DITAMBAHKAN: Kolom username
                'email' => 'user@zulaehat.com',
                'password' => Hash::make('password'),
                'role' => 'user', 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        
        // --- 2. AKTIFKAN KEMBALI FOREIGN KEY CHECKS ---
        Schema::enableForeignKeyConstraints();
    }
}