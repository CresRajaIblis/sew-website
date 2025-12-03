<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'tipe',
        'kategori',
        'nominal',
        'deskripsi',
        'status',

    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
