<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogueController; // Pastikan ini ada
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
// 3. DASHBOARD & REDIRECT
// ==========================================

Route::middleware(['auth'])->get('/home', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'pegawai') return redirect()->route('pegawai.dashboard');
    
    // Redirect User ke Katalog Saya
    return redirect()->route('catalogue'); 
})->name('dashboard_redirect');


// RUTE DASHBOARD USER (NAMA BARU: user.katalog)
Route::middleware(['auth'])->group(function () {
    // ⚠️ PASTIKAN UserOrderController::index JUGA MENGIRIM $products
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
});


// ==========================================
// 4. RUTE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
    Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
    Route::get('/keuangan', [AdminController::class, 'keuangan'])->name('keuangan');
    Route::get('/ulasan', [AdminController::class, 'ulasan'])->name('ulasan');
    
    Route::post('/akun/simpan', [AdminController::class, 'simpanAkun'])->name('akun.simpan');
    Route::delete('/akun/{id}', [AdminController::class, 'hapusAkun'])->name('akun.delete_staf'); 
    
    Route::post('/customer/simpan', [AdminController::class, 'simpanCustomer'])->name('customer.simpan');
    Route::put('/customer/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::delete('/customer/{id}', [AdminController::class, 'hapusCustomer'])->name('hapus.customer');
    
    Route::post('/pesanan/simpan', [AdminController::class, 'simpanPesanan'])->name('pesanan.simpan');
    Route::put('/pesanan/status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.update_status');
    
    Route::post('/transaksi/simpan', [AdminController::class, 'simpanTransaksi'])->name('transaksi.simpan');
    Route::put('/transaksi/{id}', [AdminController::class, 'updateTransaksi'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [AdminController::class, 'hapusTransaksi'])->name('transaksi.hapus');
    
    Route::post('/ulasan/simpan', [AdminController::class, 'simpanUlasan'])->name('ulasan.simpan');
    Route::put('/ulasan/{id}', [AdminController::class, 'updateUlasan'])->name('ulasan.update');
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