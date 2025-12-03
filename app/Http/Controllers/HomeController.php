<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // DATA SAMA PERSIS DENGAN FILE VIEW ANDA
        // Gambar dibungkus asset() agar link-nya benar
        $products = [
            [
                'id' => 1,
                'name' => 'Kemeja Formal Slim Fit',
                'price' => 350000,
                'oldPrice' => null,
                'category' => 'formal',
                'rating' => 5,
                'reviews' => 128,
                'desc' => 'Kemeja formal premium dengan potongan modern',
                'badge' => 'best seller',
                'image' => asset('assets/image/kemeja1.png'),
                'bg' => 'formal-bg'
            ],
            [
                'id' => 2,
                'name' => 'Blazer Premium Executive',
                'price' => 850000,
                'oldPrice' => 950000,
                'category' => 'premium',
                'rating' => 5,
                'reviews' => 245,
                'desc' => 'Blazer eksklusif untuk penampilan profesional',
                'badge' => 'hot',
                'image' => asset('assets/image/blazer.jpg'),
                'bg' => 'premium-bg'
            ],
            [
                'id' => 3,
                'name' => 'Casual Outfit Set',
                'price' => 280000,
                'oldPrice' => null,
                'category' => 'casual',
                'rating' => 5,
                'reviews' => 89,
                'desc' => 'Set casual nyaman untuk aktivitas sehari-hari',
                'badge' => 'new',
                'image' => asset('assets/image/casual.jpg'),
                'bg' => 'casual-bg'
            ],
            [
                'id' => 4,
                'name' => 'Dress Elegant Evening',
                'price' => 420000,
                'oldPrice' => 600000,
                'category' => 'formal',
                'rating' => 5,
                'reviews' => 156,
                'desc' => 'Dress elegan untuk acara spesial',
                'badge' => 'sale',
                'image' => asset('assets/image/dress.jpg'),
                'bg' => 'dress-bg'
            ],
            [
                'id' => 5,
                'name' => 'Batik Modern Kombinasi',
                'price' => 450000,
                'oldPrice' => null,
                'category' => 'formal',
                'rating' => 5,
                'reviews' => 203,
                'desc' => 'Batik modern dengan sentuhan kontemporer',
                'badge' => null,
                'image' => asset('assets/image/batik.jpg'),
                'bg' => 'batik-bg'
            ],
            [
                'id' => 6,
                'name' => 'Complete Suit Package',
                'price' => 1250000,
                'oldPrice' => null,
                'category' => 'premium',
                'rating' => 5,
                'reviews' => 178,
                'desc' => 'Paket lengkap suit untuk acara formal',
                'badge' => 'limited',
                'image' => asset('assets/image/jas.jpg'),
                'bg' => 'suit-bg'
            ],
            [
                'id' => 7,
                'name' => 'Casual Summer',
                'price' => 125000,
                'oldPrice' => null,
                'category' => 'casual',
                'rating' => 5,
                'reviews' => 178,
                'desc' => 'Paket santai musim panas',
                'badge' => null,
                'image' => asset('assets/image/casual.jpg'),
                'bg' => 'suit-bg'   
            ],
            [
                'id' => 8,
                'name' => 'Premium Gown',
                'price' => 1250000,
                'oldPrice' => null,
                'category' => 'premium',
                'rating' => 5,
                'reviews' => 178,
                'desc' => 'Gaun malam elegan',
                'badge' => 'new',
                'image' => asset('assets/image/dress.jpg'),
                'bg' => 'dress-bg'   
            ]
        ];

        return view('welcome', compact('products'));
    }
}