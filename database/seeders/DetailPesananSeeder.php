<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPesananSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     * Mengisi tabel detail_pesanans, yang merujuk ke tabel induk 'pesanans'.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan tabel dibersihkan
        DB::table('detail_pesanans')->truncate(); 

        // ASUMSI: Pesanan pertama yang dibuat oleh PesananSeeder memiliki ID = 1.
        $pesanan_id_dummy = 1;
        
        DB::table('detail_pesanans')->insert([
            [
                'pesanan_id' => $pesanan_id_dummy,
                'nama_produk' => 'Kemeja Formal Premium',
                'jumlah' => 1,
                'harga_satuan' => 380000,
                'total_harga' => 380000, // DITAMBAHKAN: total_harga = 380000 * 1
                'ukuran' => 'XL',
                'warna' => 'White',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pesanan_id' => $pesanan_id_dummy,
                'nama_produk' => 'Dress Formal Elegant',
                'jumlah' => 2,
                'harga_satuan' => 450000,
                'total_harga' => 900000, // DITAMBAHKAN: total_harga = 450000 * 2
                'ukuran' => 'M',
                'warna' => 'Navy',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pesanan_id' => $pesanan_id_dummy,
                'nama_produk' => 'Jahit Custom',
                'jumlah' => 1,
                'harga_satuan' => 120000,
                'total_harga' => 120000, // DITAMBAHKAN: total_harga = 120000 * 1
                'ukuran' => 'Custom: 175cm',
                'warna' => 'Custom: Maroon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}