<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'nama_pengulas',
        'jenis_pesanan',
        'rating',
        'komentar',
    ];

    // --- RELASI MODEL ---
    /**
     * Relasi: Ulasan terkait dengan satu Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}