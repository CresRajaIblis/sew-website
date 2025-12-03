<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     * Mengisi tabel 'products' dengan data awal katalog Zulaeha Tailor.
     *
     * @return void
     */
    public function run()
    {
        // Untuk menghapus data lama sebelum memasukkan yang baru (opsional, tetapi direkomendasikan saat seeding)
        DB::table('products')->truncate(); 

        // Data Produk yang dikonsolidasikan dari file Blade Anda
        $products = [
            // --- Produk Wanita (dari Catalogue) ---
            [
                'name' => 'Dress Formal Elegant',
                'description' => 'Dress formal dengan detail elegan.',
                'price' => 450000,
                'old_price' => 550000,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => 'hot',
                'rating' => 4.8,
                'reviews_count' => 45,
                'image_url' => 'assets/image/foto1.jpg', // Asumsi path asset
                'bg_class' => 'dress-bg',
                'colors' => json_encode(['black', 'navy', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kebaya Modern Premium',
                'description' => 'Kebaya modern dengan bordir mewah.',
                'price' => 750000,
                'old_price' => 900000,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => 'new',
                'rating' => 4.9,
                'reviews_count' => 62,
                'image_url' => 'assets/image/foto2.jpg', // Asumsi path asset
                'bg_class' => 'kebaya-bg',
                'colors' => json_encode(['white', 'navy', 'black']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tunik Formal Cantik',
                'description' => 'Tunik formal untuk acara resmi.',
                'price' => 380000,
                'old_price' => null,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => null,
                'rating' => 4.7,
                'reviews_count' => 38,
                'image_url' => 'assets/image/foto3.jpg', // Asumsi path asset
                'bg_class' => 'tunic-bg',
                'colors' => json_encode(['black', 'white', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dress Casual Chic',
                'description' => 'Dress casual untuk sehari-hari.',
                'price' => 320000,
                'old_price' => null,
                'category' => 'casual',
                'gender' => 'wanita',
                'badge' => null,
                'rating' => 4.6,
                'reviews_count' => 52,
                'image_url' => 'assets/image/foto3.jpg', // Menggunakan foto3 sebagai placeholder
                'bg_class' => 'casual-bg',
                'colors' => json_encode(['white', 'black', 'navy']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // --- Produk Pria (dari Catalogue & Home) ---
            [
                'name' => 'Jas Formal Executive',
                'description' => 'Jas formal untuk acara bisnis, potongannya rapi.',
                'price' => 850000,
                'old_price' => 1000000,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => 'hot',
                'rating' => 4.9,
                'reviews_count' => 67,
                'image_url' => 'assets/image/promo1.jpg', 
                'bg_class' => 'suit-bg',
                'colors' => json_encode(['black', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kemeja Formal Premium',
                'description' => 'Kemeja formal kualitas premium, nyaman dan tidak mudah kusut.',
                'price' => 380000,
                'old_price' => null,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => null,
                'rating' => 4.7,
                'reviews_count' => 92,
                'image_url' => 'assets/image/promo2.jpg', 
                'bg_class' => 'formal-bg',
                'colors' => json_encode(['white', 'black', 'navy']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Blazer Formal Modern',
                'description' => 'Blazer formal dengan cutting modern dan bahan ringan.',
                'price' => 650000,
                'old_price' => 750000,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => 'new',
                'rating' => 4.8,
                'reviews_count' => 54,
                'image_url' => 'assets/image/promo3.jpg', 
                'bg_class' => 'blazer-bg',
                'colors' => json_encode(['navy', 'black', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kemeja Batik Premium',
                'description' => 'Kemeja batik motif eksklusif, cocok untuk acara resmi dan santai.',
                'price' => 420000,
                'old_price' => null,
                'category' => 'batik',
                'gender' => 'pria',
                'badge' => 'new',
                'rating' => 4.8,
                'reviews_count' => 85,
                'image_url' => 'https://placehold.co/100x100/81C784/ffffff?text=BATIK', 
                'bg_class' => 'batik-bg',
                'colors' => json_encode(['navy', 'black', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jas Premium Tailored',
                'description' => 'Jas custom tailored eksklusif, dibuat sesuai permintaan dan ukuran.',
                'price' => 1500000,
                'old_price' => null,
                'category' => 'premium',
                'gender' => 'pria',
                'badge' => 'hot',
                'rating' => 5.0,
                'reviews_count' => 31,
                'image_url' => 'assets/image/jas.jpg', // Asumsi path asset
                'bg_class' => 'premium-bg',
                'colors' => json_encode(['black', 'navy', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}