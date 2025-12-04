<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan Model Product ada

class CatalogueController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari database
        $productsData = Product::all();

        // 2. Format data agar sesuai format Javascript Frontend
        $products = $productsData->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'oldPrice' => $item->old_price, 
                'category' => $item->category,
                'gender' => $item->gender,
                'rating' => $item->rating,
                'reviews' => $item->reviews_count, 
                'desc' => $item->description,      
                'badge' => $item->badge,
                // Pastikan path gambar valid, gunakan asset()
                'icon' => filter_var($item->image_url, FILTER_VALIDATE_URL) ? $item->image_url : asset($item->image_url),
                'bg' => $item->bg_class,           
                'colors' => $item->colors ?? [],
            ];
        });

        // 3. KIRIM VARIABEL KE VIEW (Ini yang memperbaiki error)
        return view('user.catalogue', compact('products')); 
    }
}