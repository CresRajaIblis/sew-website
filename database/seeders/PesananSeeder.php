<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     * Membuat satu entri pesanan induk yang valid.
     *
     * @return void
     */
    public function run()
    {
        // Menonaktifkan Foreign Key Check sementara
        Schema::disableForeignKeyConstraints();
        DB::table('pesanans')->truncate(); 

        DB::table('pesanans')->insert([
            [
                // Menggunakan kolom yang benar sesuai Migrasi tabel 'pesanans'
                'kode_pesanan' => 'ZLHT-0001',
                'nomor_antrian' => 1,
                'nama_pemesan' => 'Ahmad Sobri',       // Kolom yang benar
                'no_telepon' => '08123456789',         // Kolom yang benar
                'email' => 'ahmad.sobri@example.com',
                'alamat' => 'Jl. Mawar No. 12, Palembang',
                'catatan' => 'Bahan anti air jika memungkinkan.',
                'total_harga' => 550000.00,
                'metode_pembayaran' => 'Transfer Bank',
                'status' => 'diproses',
                // 'user_id' harus disesuaikan atau dihilangkan jika tidak dibutuhkan oleh migrasi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
        // Mengaktifkan Foreign Key Check kembali
        Schema::enableForeignKeyConstraints();
    }
}