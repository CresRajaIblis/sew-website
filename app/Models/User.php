<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role', // admin, pegawai, user
        'google_id',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- RELASI MODEL ---
    /**
     * Relasi: User (Pelanggan) memiliki banyak Ulasan
     */
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'user_id');
    }

    /**
     * Relasi: User (Pegawai) memiliki banyak Pesanan yang ditangani
     */
    public function pesananDitangani(){
        return $this->hasMany(Pesanan::class, 'user_id');
    }

    //pelanggan memilik banyak pesanan
    public function pesananPelanggan(){
        return $this->hasMany(Pesanan::class, 'customer_id');
    }
}