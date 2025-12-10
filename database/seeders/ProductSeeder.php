<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     * Mengisi tabel 'products' dengan data dari JavaScript yang telah dikonversi.
     *
     * @return void
     */
    public function run()
    {
        // Menghapus data lama agar tidak duplikat saat seeding ulang
        DB::table('products')->truncate();

        $products = [
            // 1. Dress Formal Elegant
            [
                'name' => 'Dress Formal Elegant',
                'description' => 'Dress formal dengan detail elegan',
                'price' => 450000,
                'old_price' => 550000,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => 'hot',
                'rating' => 4.8,
                'reviews_count' => 45,
                'image_url' => 'assets/image/dresssasap.jpg',
                'bg_class' => 'dress-bg',
                'colors' => json_encode(['black', 'navy', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 2. Kebaya Modern Premium
            [
                'name' => 'Kebaya Modern Premium',
                'description' => 'Kebaya modern dengan bordir mewah',
                'price' => 750000,
                'old_price' => 900000,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => 'new',
                'rating' => 4.9,
                'reviews_count' => 62,
                'image_url' => 'assets/image/kebayasasap.jpg',
                'bg_class' => 'kebaya-bg',
                'colors' => json_encode(['white', 'navy', 'black']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 3. Tunik Formal Cantik
            [
                'name' => 'Tunik Formal Cantik',
                'description' => 'Tunik formal untuk acara resmi',
                'price' => 380000,
                'old_price' => null,
                'category' => 'formal',
                'gender' => 'wanita',
                'badge' => null,
                'rating' => 4.7,
                'reviews_count' => 38,
                'image_url' => 'assets/image/dresssasap2.jpg',
                'bg_class' => 'tunic-bg',
                'colors' => json_encode(['black', 'white', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 4. Dress Casual Chic
            [
                'name' => 'Dress Casual Chic',
                'description' => 'Dress casual untuk sehari-hari',
                'price' => 320000,
                'old_price' => null,
                'category' => 'casual',
                'gender' => 'wanita',
                'badge' => null,
                'rating' => 4.6,
                'reviews_count' => 52,
                'image_url' => 'assets/image/dress2.jpg',
                'bg_class' => 'casual-bg',
                'colors' => json_encode(['white', 'black', 'navy']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 5. Tunik Casual Modern
            [
                'name' => 'Tunik Casual Modern',
                'description' => 'Tunik casual yang nyaman',
                'price' => 280000,
                'old_price' => 350000,
                'category' => 'casual',
                'gender' => 'wanita',
                'badge' => 'hot',
                'rating' => 4.7,
                'reviews_count' => 41,
                'image_url' => 'assets/image/tunik.jpg',
                'bg_class' => 'tunic-bg',
                'colors' => json_encode(['army', 'navy', 'black']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 6. Dress Batik Eksklusif
            [
                'name' => 'Dress Batik Eksklusif',
                'description' => 'Dress batik dengan motif premium',
                'price' => 520000,
                'old_price' => null,
                'category' => 'batik',
                'gender' => 'wanita',
                'badge' => 'new',
                'rating' => 4.9,
                'reviews_count' => 55,
                'image_url' => 'assets/image/batikcewe.jpg',
                'bg_class' => 'batik-bg',
                'colors' => json_encode(['navy', 'black', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 7. Kebaya Batik Kombinasi
            [
                'name' => 'Kebaya Batik Kombinasi',
                'description' => 'Kebaya batik kombinasi modern',
                'price' => 680000,
                'old_price' => 800000,
                'category' => 'batik',
                'gender' => 'wanita',
                'badge' => null,
                'rating' => 4.8,
                'reviews_count' => 48,
                'image_url' => 'assets/image/kebaya.jpg',
                'bg_class' => 'kebaya-bg',
                'colors' => json_encode(['black', 'navy', 'white', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 8. Gaun Malam Premium
            [
                'name' => 'Gaun Malam Premium',
                'description' => 'Gaun malam eksklusif',
                'price' => 1200000,
                'old_price' => null,
                'category' => 'premium',
                'gender' => 'wanita',
                'badge' => 'hot',
                'rating' => 5.0,
                'reviews_count' => 28,
                'image_url' => 'assets/image/dress.jpg',
                'bg_class' => 'premium-bg',
                'colors' => json_encode(['black', 'navy', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 9. Jas Formal Executive (PRIA)
            [
                'name' => 'Jas Formal Executive',
                'description' => 'Jas formal untuk acara bisnis',
                'price' => 850000,
                'old_price' => 1000000,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => 'hot',
                'rating' => 4.9,
                'reviews_count' => 67,
                'image_url' => 'assets/image/jas.jpg',
                'bg_class' => 'suit-bg',
                'colors' => json_encode(['black', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 10. Kemeja Formal Premium
            [
                'name' => 'Kemeja Formal Premium',
                'description' => 'Kemeja formal kualitas premium',
                'price' => 380000,
                'old_price' => null,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => null,
                'rating' => 4.7,
                'reviews_count' => 92,
                'image_url' => 'assets/image/kemeja1.png',
                'bg_class' => 'formal-bg',
                'colors' => json_encode(['white', 'black', 'navy']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 11. Blazer Formal Modern
            [
                'name' => 'Blazer Formal Modern',
                'description' => 'Blazer formal dengan cutting modern',
                'price' => 650000,
                'old_price' => 750000,
                'category' => 'formal',
                'gender' => 'pria',
                'badge' => 'new',
                'rating' => 4.8,
                'reviews_count' => 54,
                'image_url' => 'assets/image/blazer.jpg',
                'bg_class' => 'blazer-bg',
                'colors' => json_encode(['navy', 'black', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 12. Kemeja Casual Slim Fit
            [
                'name' => 'Kemeja Casual Slim Fit',
                'description' => 'Kemeja casual untuk sehari-hari',
                'price' => 290000,
                'old_price' => null,
                'category' => 'casual',
                'gender' => 'pria',
                'badge' => null,
                'rating' => 4.6,
                'reviews_count' => 78,
                'image_url' => 'assets/image/kemeja1.png',
                'bg_class' => 'shirt-bg',
                'colors' => json_encode(['white', 'black', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 13. Blazer Casual Smart
            [
                'name' => 'Blazer Casual Smart',
                'description' => 'Blazer casual untuk gaya smart casual',
                'price' => 480000,
                'old_price' => 580000,
                'category' => 'casual',
                'gender' => 'pria',
                'badge' => 'hot',
                'rating' => 4.7,
                'reviews_count' => 43,
                'image_url' => 'assets/image/blazer.jpg',
                'bg_class' => 'blazer-bg',
                'colors' => json_encode(['army', 'navy', 'black']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 14. Kemeja Batik Premium
            [
                'name' => 'Kemeja Batik Premium',
                'description' => 'Kemeja batik motif eksklusif',
                'price' => 420000,
                'old_price' => null,
                'category' => 'batik',
                'gender' => 'pria',
                'badge' => 'new',
                'rating' => 4.8,
                'reviews_count' => 85,
                'image_url' => 'assets/image/batik.jpg',
                'bg_class' => 'batik.jpg', // Sesuai data JS, pastikan ini benar nama class CSS
                'colors' => json_encode(['navy', 'black', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 15. Jas Batik Kombinasi
            [
                'name' => 'Jas Batik Kombinasi',
                'description' => 'Jas batik kombinasi modern',
                'price' => 920000,
                'old_price' => 1100000,
                'category' => 'batik',
                'gender' => 'pria',
                'badge' => null,
                'rating' => 4.9,
                'reviews_count' => 39,
                'image_url' => 'assets/image/jasbatik.jpg',
                'bg_class' => 'jasbatik.jpg', // Sesuai data JS, pastikan ini benar nama class CSS
                'colors' => json_encode(['black', 'navy', 'army']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 16. Jas Premium Tailored
            [
                'name' => 'Jas Premium Tailored',
                'description' => 'Jas custom tailored eksklusif',
                'price' => 1500000,
                'old_price' => null,
                'category' => 'premium',
                'gender' => 'pria',
                'badge' => 'hot',
                'rating' => 5.0,
                'reviews_count' => 31,
                'image_url' => 'assets/image/promo3.jpg',
                'bg_class' => 'premium-bg',
                'colors' => json_encode(['black', 'navy', 'white']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}