<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Tambahkan semua kolom baru dari tabel pesanans di sini
    protected $fillable = [
        'id', // PASTIKAN KOLOM INI ADA DI TABEL ANDA!
        'kode_pesanan',
        'nomor_antrian',
        'nama_pemesan',
        'email',
        'no_telepon',
        'alamat',
        'catatan',
        'total_harga',
        'metode_pembayaran',
        'status',
        // Tambahkan kolom lain jika ada 
    ];

    // Relasi ke DetailPesanan (Satu Pesanan punya banyak Detail)
    public function detail()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'id');
    }
    
    // Relasi ke User (Jika pemesan adalah user terdaftar)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}