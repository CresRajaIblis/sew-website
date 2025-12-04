<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel (opsional, tapi bagus untuk kepastian)
    protected $table = 'transaksis';

    // 2. Tentukan Primary Key karena kamu pakai 'kode', bukan 'id'
    protected $primaryKey = 'kode';

    // 3. Sesuaikan Fillable dengan Migration kamu
    protected $fillable = [
        'tanggal',
        'tipe',       // enum: pemasukan, pengeluaran
        'kategori',   // Di controller sebelumnya ini 'deskripsi', harus diganti
        'nominal',
        'status',     // enum: lunas, pending
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
