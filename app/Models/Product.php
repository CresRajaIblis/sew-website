<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Sesuaikan jika nama tabel berbeda

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'category',
        'gender',
        'badge',
        'rating',
        'reviews_count',
        'image_url',
        'bg_class',
        'colors',
    ];

    // Penting: Ubah kolom JSON menjadi Array otomatis
    protected $casts = [
        'colors' => 'array',
        'rating' => 'float',
        'price' => 'integer',
        'old_price' => 'integer',
        'reviews_count' => 'integer',
    ];
}