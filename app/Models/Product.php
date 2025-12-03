<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
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

    /**
     * Atribut yang harus di-cast ke tipe bawaan.
     * Mengkonversi kolom 'colors' dari JSON string ke array PHP secara otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'colors' => 'array',
    ];

    /**
     * Atribut tambahan yang harus diakses dari model (contoh: 'icon' dari data dummy Anda)
     * Dalam kasus data ini, kita akan menggunakan 'image_url' untuk icon.
     * Jika Anda ingin menggunakan 'icon' sebagai properti terpisah dari 'image_url', 
     * tambahkan kolom baru di migrasi atau definisikan Accessor (getIconAttribute).
     */
}