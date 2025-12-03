<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
            UserSeeder::class, // Penting: User harus dibuat duluan!
            ProductSeeder::class, 
            PesananSeeder::class, // Tambahkan baris ini
            DetailPesananSeeder::class, // Jika Anda membuat Seeder untuk detail pesanan
        ]);

// Ambil user yang rolenya pegawai (untuk simulasi penugasan)
    $pegawai = User::where('role', 'pegawai')->first();

    // Buat Pesanan 1 (Sudah diambil pegawai)
    Pesanan::create([
        'nama_pelanggan' => 'Ahmad Sobri',
        'kontak_pelanggan' => '08123456789',
        'jenis_pakaian' => 'Kemeja Custom',
        'ukuran' => 'XL',
        'jumlah' => 1,
        'harga' => 150000,
        'deadline' => '2025-11-20',
        'status' => 'diproses',
        'user_id' => $pegawai->id ?? null, // Tugaskan ke pegawai
    ]);

    // Buat Pesanan 2 (Pending / Belum diambil)
    Pesanan::create([
        'nama_pelanggan' => 'Mimi',
        'kontak_pelanggan' => '08987654321',
        'jenis_pakaian' => 'Kebaya Modern',
        'ukuran' => 'M',
        'jumlah' => 2,
        'harga' => 300000,
        'deadline' => '2025-11-25',
        'status' => 'pending',
        'user_id' => null, // Belum ada yang mengerjakan
    ]);

    // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@jahit.com',
            'role' => 'admin',
            // Hash::make() wajib dipakai agar password ter-enkripsi
            'password' => Hash::make('password'),
        ]);

        // 2. Buat Akun PEGAWAI
        User::create([
            'name' => 'Pegawai Satu',
            'username' => 'pegawai',
            'email' => 'pegawai@jahit.com',
            'role' => 'pegawai',
            'password' => Hash::make('password'),
        ]);

        //  Buat Akun pelanggan
        \App\Models\Customer::create([
            'nama' => 'Ahmad Sobri',
            'email' => 'ahmad@mail.com',
            'kontak' => '08123456789',
        ]);

        \App\Models\Customer::create([
            'nama' => 'Mimi',
            'email' => 'mimi@mail.com',
            'kontak' => '081209876543',
        ]);

        \App\Models\Customer::create([
            'nama' => 'Kaizo',
            'email' => 'kaizo@mail.com',
            'kontak' => '081243215678',
        ]);

        
}
}
