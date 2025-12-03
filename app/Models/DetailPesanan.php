<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $table = 'detail_pesanans'; // Pastikan nama tabel benar

    protected $fillable = [
        'pesanan_id',
        'nama_produk',
        'warna',
        'ukuran',
        'jumlah',
        'harga_satuan',
        'total_harga'
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}