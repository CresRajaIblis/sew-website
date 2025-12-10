<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes (FINAL FIX)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PUBLIK & AUTH (Biarkan seperti semula)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/about', function () { return view('user.about'); })->name('about');
Route::post('/checkout', [UserOrderController::class, 'checkout'])->name('checkout.process');

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

Route::middleware(['auth'])->get('/home', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'pegawai') return redirect()->route('pegawai.dashboard');
    return redirect()->route('catalogue'); 
})->name('dashboard_redirect');

Route::middleware(['auth'])->group(function () {
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
});

// ==========================================
// 4. RUTE ADMIN (PERBAIKAN UTAMA DI SINI)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'cekrole:admin,pegawai'])->group(function () {
    
    // Dashboard & Umum
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/keuangan', [AdminController::class, 'keuangan'])->name('admin.keuangan');
    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
    Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
    Route::get('/ulasan', [AdminController::class, 'ulasan'])->name('ulasan');

    // --- RUTE TRANSAKSI (HANYA 3 BARIS INI) ---
    // 1. Simpan Baru
    Route::post('/transaksi/simpan', [AdminController::class, 'simpanTransaksi']);
    
    // 2. Update (Edit) - Kita kirim ID lewat Input Tersembunyi, bukan lewat URL
    Route::post('/transaksi/update', [AdminController::class, 'updateTransaksi']);
    
    // 3. Hapus - Kita kirim ID lewat URL
    Route::post('/transaksi/hapus/{id}', [AdminController::class, 'hapusTransaksi']);

    // --- Route Lainnya (Biarkan tetap ada agar tidak error module lain) ---
    Route::post('/akun/simpan', [AdminController::class, 'simpanAkun'])->name('akun.simpan');
    Route::delete('/akun/{id}', [AdminController::class, 'hapusAkun'])->name('akun.delete_staf'); 
    Route::post('/customer/simpan', [AdminController::class, 'simpanCustomer'])->name('customer.simpan');
    Route::put('/customer/{id}', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::delete('/customer/{id}', [AdminController::class, 'hapusCustomer'])->name('hapus.customer');
    Route::post('/pesanan/simpan', [AdminController::class, 'simpanPesanan'])->name('pesanan.simpan');
    Route::put('/pesanan/status/{id}', [AdminController::class, 'updateStatusPesanan'])->name('pesanan.update_status');
    Route::post('/ulasan/simpan', [AdminController::class, 'simpanUlasan'])->name('ulasan.simpan');
    Route::put('/ulasan/{id}', [AdminController::class, 'updateUlasan'])->name('ulasan.update');
    Route::delete('/ulasan/{id}', [AdminController::class, 'hapusUlasan'])->name('ulasan.hapus');
});

// 5. RUTE PEGAWAI
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('dashboard');
    Route::get('/ulasan', [PegawaiController::class, 'ulasan'])->name('ulasan');
    Route::post('/pesanan/{id}/ambil', [PegawaiController::class, 'ambilPesanan'])->name('pesanan.ambil');
    Route::post('/pesanan/{id}/selesai', [PegawaiController::class, 'selesaikanPesanan'])->name('pesanan.selesai');
});