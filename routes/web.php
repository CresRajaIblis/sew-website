<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PUBLIK
// ==========================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/about', function () { return view('user.about'); })->name('about');
Route::get('/catalogue', function () { return view('user.catalogue'); })->name('catalogue');
Route::post('/checkout', [UserOrderController::class, 'checkout'])->name('checkout.process');


// ==========================================
// 2. OTENTIKASI
// ==========================================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showUserLogin'])->name('login'); 
    Route::post('/masuk', [AuthController::class, 'userLoginProcess'])->name('login.post'); 
    Route::get('/daftar', [AuthController::class, 'showUserRegister'])->name('register'); 
    Route::post('/daftar', [AuthController::class, 'userRegisterProcess']);
});

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


// ==========================================
// 3. DASHBOARD & REDIRECT (FIX RUTE USER)
// ==========================================

Route::middleware(['auth'])->get('/home', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'pegawai') return redirect()->route('pegawai.dashboard');
    
    // FIX KRITIS: Redirect ke rute baru: user.katalog
    return redirect()->route('user.katalog'); 
})->name('dashboard_redirect');


// RUTE DASHBOARD USER (NAMA BARU: user.katalog)
Route::middleware(['auth'])->group(function () {
    // Memanggil fungsi index (yang aman)
    Route::get('/katalog-saya', [UserOrderController::class, 'index'])->name('user.katalog');
});


// ==========================================
// RUTE ADMIN YANG DILENGKAPI
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // --- Dashboard & View Routes ---
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
    Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
    Route::get('/keuangan', [AdminController::class, 'keuangan'])->name('keuangan');
    Route::get('/ulasan', [AdminController::class, 'ulasan'])->name('ulasan');
    
    // --- CRUD Akun Staf/Admin ---
    Route::post('/akun/simpan', [AdminController::class, 'simpanAkun'])->name('akun.simpan');
    Route::delete('/akun/{id}', [AdminController::class, 'hapusAkun'])->name('akun.delete_staf'); 
    
    // --- CRUD Akun Pelanggan (User) ---
    Route::post('/customer/simpan', [AdminController::class, 'simpanCustomer'])->name('customer.simpan');
    Route::put('/customer/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::delete('/customer/{id}', [AdminController::class, 'hapusCustomer'])->name('hapus.customer');
    
    // --- CRUD Pesanan (Input Manual & Update Status) ---
    Route::post('/pesanan/simpan', [AdminController::class, 'simpanPesanan'])->name('pesanan.simpan');
    Route::put('/pesanan/status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.update_status'); // Rute baru untuk update status
    // Tambahkan juga untuk update detail pesanan jika diperlukan, tapi fokus ke status/manual input
    
    // --- CRUD Transaksi Keuangan ---
    Route::post('/transaksi/simpan', [AdminController::class, 'simpanTransaksi'])->name('transaksi.simpan');
    Route::put('/transaksi/{id}', [AdminController::class, 'updateTransaksi'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [AdminController::class, 'hapusTransaksi'])->name('transaksi.hapus');
    
    // --- CRUD Ulasan ---
    Route::post('/ulasan/simpan', [AdminController::class, 'simpanUlasan'])->name('ulasan.simpan');
    Route::put('/ulasan/{id}', [AdminController::class, 'updateUlasan'])->name('ulasan.update'); // Update Ulasan ditambahkan
    Route::delete('/ulasan/{id}', [AdminController::class, 'hapusUlasan'])->name('ulasan.hapus');
});


// ==========================================
// 5. RUTE PEGAWAI
// ==========================================
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('dashboard');
    Route::get('/ulasan', [PegawaiController::class, 'ulasan'])->name('ulasan');
    Route::post('/pesanan/{id}/ambil', [PegawaiController::class, 'ambilPesanan'])->name('pesanan.ambil');
    Route::post('/pesanan/{id}/selesai', [PegawaiController::class, 'selesaikanPesanan'])->name('pesanan.selesai');
});