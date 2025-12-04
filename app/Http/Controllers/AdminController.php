<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan; 
use App\Models\User;
use App\Models\Customer; // Diasumsikan model Customer untuk data detail pelanggan
use App\Models\Transaksi;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // --- DASHBOARD & VIEW FUNCTIONS ---
    public function index() 
    {
        $pesananSelesai = Pesanan::where('status', 'selesai')->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('total_harga'); 
        $totalUlasan = Ulasan::count(); 
        $avgRating = $totalUlasan > 0 ? Ulasan::avg('rating') : 0;
        $rating = number_format($avgRating, 1); 
        $pendapatanHarian = []; $labelHari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $labelHari[] = $tanggal->translatedFormat('D, d'); 
            $pendapatan = Pesanan::whereDate('updated_at', $tanggal)->where('status', 'selesai')->sum('total_harga'); 
            $pendapatanHarian[] = $pendapatan;
        }
        $pesananTerakhir = Pesanan::with('detail')->orderBy('id', 'desc')->take(10)->get();

        // Query Top Pesanan (Sudah benar mengelompokkan berdasarkan nama_produk)
        $topPesanan = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah) as total_terjual'))
                        ->groupBy('nama_produk')
                        ->orderByDesc('total_terjual')
                        ->take(3)
                        ->get();
        // Pastikan nama_produk di DetailPesanan relevan, atau gunakan ID jika ada
        $topPesanan = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah) as total_terjual'))->groupBy('nama_produk')->orderByDesc('total_terjual')->take(3)->get();
        $statusMesin = [
            ['nama' => 'MSN-001', 'status' => 'aktif', 'warna' => '#4ade80'],
            ['nama' => 'MSN-002', 'status' => 'rusak', 'warna' => '#f87171'],
            ['nama' => 'MSN-003', 'status' => 'maintenance', 'warna' => '#fbbf24'],
        ];

        return view('admin.dashboard', compact(
            'pesananSelesai', 'pesananDiproses', 'totalPendapatan', 'rating',
            'labelHari', 'pendapatanHarian', 'pesananTerakhir', 'topPesanan', 'statusMesin'
        ));
    }
    
    
    
    public function pesanan()
    {
        // FIX: Eager load user, detail, dan customer (jika ada relasi)
        $semuaPesanan = Pesanan::with(['user', 'detail'])->orderBy('id', 'desc')->get();
        return view('admin.pesanan', compact('semuaPesanan'));
    }
    
    public function ulasan() 
    { 
        $ulasans = Ulasan::orderBy('created_at', 'desc')->get();
        $totalUlasan = $ulasans->count();
        $avgRating = $totalUlasan > 0 ? $ulasans->avg('rating') : 0;
        $reviewBaik = $ulasans->where('rating', '>', 3)->count();
        $reviewBuruk = $ulasans->where('rating', '<=', 3)->count();
        return view('admin.ulasan', compact('ulasans', 'totalUlasan', 'avgRating', 'reviewBaik', 'reviewBuruk')); 
    }
    
    public function keuangan(Request $request) 
{ 
    $query = Transaksi::orderBy('tanggal', 'desc');

    // --- LOGIKA FILTER WAKTU ---
    $filter = $request->input('filter', 'bulanan'); // Default: bulanan
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($startDate && $endDate) {
        // Filter Tanggal Manual
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    } elseif ($filter === 'harian') {
        // Filter Harian (Hari Ini)
        $query->whereDate('tanggal', today());
    } elseif ($filter === 'mingguan') {
        // Filter Mingguan (7 Hari Terakhir)
        $query->where('tanggal', '>=', now()->subDays(6)->startOfDay());
    } elseif ($filter === 'bulanan') {
        // Filter Bulanan (Bulan Ini)
        $query->whereYear('tanggal', now()->year)
              ->whereMonth('tanggal', now()->month);
    } 
    // Jika filter === 'semua', tidak perlu menambahkan kondisi WHERE

    $transaksis = $query->get();
    
    // --- PERHITUNGAN STATISTIK ---
    // Pastikan perhitungan ini hanya menggunakan data $transaksis yang sudah difilter
    $pemasukan = $transaksis->where('tipe', 'pemasukan')->where('status', 'lunas')->sum('nominal');
    $pengeluaran = $transaksis->where('tipe', 'pengeluaran')->where('status', 'lunas')->sum('nominal');
    $labaBersih = $pemasukan - $pengeluaran;
    
    return view('admin.keuangan', compact('transaksis', 'pemasukan', 'pengeluaran', 'labaBersih')); 
}

    // --- CRUD PESANAN: TAMBAH MANUAL & UPDATE STATUS ---
    public function simpanPesanan(Request $request) 
    {
        DB::beginTransaction();
        try {
            // Validasi menggunakan field dari form admin
            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'jenis_pakaian' => 'required|string|max:255',
                'ukuran' => 'required|string|max:50',
                'jumlah' => 'required|integer|min:1',
                'harga' => 'required|numeric|min:1000', 
                'deadline' => 'nullable|date',
                'catatan' => 'nullable|string',
            ]);
            
            // Hitung harga satuan dan total harga
            $totalHarga = $request->harga; // Total harga di form
            $hargaSatuan = $totalHarga / $request->jumlah;

            // 1. INPUT KE TABEL PESANAN (HEADER)
            $lastPesanan = Pesanan::latest('id')->first();
            // Nomor antrian dimulai dari 101 jika belum ada pesanan
            $nextNomorAntrian = ($lastPesanan ? $lastPesanan->nomor_antrian : 100) + 1;

            $pesanan = Pesanan::create([
                'nama_pemesan' => $request->nama_pelanggan, 
                'total_harga' => $totalHarga, 
                'kode_pesanan' => 'M-' . strtoupper(substr(uniqid(), -5)), 
                'nomor_antrian' => $nextNomorAntrian,
                'no_telepon' => '0', // Default
                'email' => 'manual@admin.com', // Default
                'alamat' => 'Input Manual', // Default
                'metode_pembayaran' => 'Cash', // Diubah dari 'Manual' menjadi 'Cash'
                'status' => 'diproses', // Status awal 'diproses' untuk input admin
                'user_id' => Auth::id(), // User yang input adalah Admin/Pegawai yang sedang login
            ]);
            
            // 2. INPUT KE TABEL DETAIL PESANAN (RINCIAN)
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'nama_produk' => $request->jenis_pakaian,
                'warna' => '-', 
                'ukuran' => $request->ukuran,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $hargaSatuan, 
                'total_harga' => $totalHarga,
                'catatan_item' => $request->catatan,
            ]);

            DB::commit();
            return redirect()->route('admin.pesanan')->with('success', 'Pesanan manual berhasil ditambahkan dan siap diproses!');

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal Simpan Pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    public function updateStatusPesanan(Request $request, $id) 
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,siap_ambil,selesai,dibatalkan',
        ]);

        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->status = $request->status;
            $pesanan->save();

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal Update Status Pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui status pesanan.');
        }
    }

    // --- CRUD AKUN STAFF/ADMIN ---
    public function akun() 
    { 
        // Mengambil Staf (Admin & Pegawai)
        $stafs = User::whereIn('role', ['admin', 'pegawai'])->orderBy('role', 'asc')->get();
        
        // Mengambil Pelanggan (User role 'user')
        $customers = User::where('role', 'user')->get();
        
        $totalPegawai = $stafs->where('role', 'pegawai')->count();
        $totalAdmin = $stafs->where('role', 'admin')->count();
        $totalPelanggan = $customers->count(); 
        
        // Model Customer Dihapus, hanya menggunakan User::class
        return view('admin.akun', compact('stafs', 'customers', 'totalPegawai', 'totalAdmin', 'totalPelanggan')); 
    }
    
    // --- CRUD AKUN STAFF/ADMIN ---
    public function simpanAkun(Request $request) 
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username', // Ditambahkan username
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,pegawai',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            return redirect()->route('admin.akun')->with('success', 'Akun staf/admin berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal Simpan Akun: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan akun: ' . $e->getMessage());
        }
    }

    public function hapusAkun($id) 
    { 
        if ($id == Auth::id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }
        
        try {
            $user = User::whereIn('role', ['admin', 'pegawai'])->findOrFail($id);
            $user->delete();
            return redirect()->route('admin.akun')->with('success', 'Akun staf/admin berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal Hapus Akun: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus akun.');
        }
    }

    // --- CRUD AKUN PELANGGAN (USER ROLE='USER') ---
    public function simpanCustomer(Request $request) 
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username', // Ditambahkan username
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user', // Selalu user untuk pelanggan
            ]);
            return redirect()->route('admin.akun')->with('success', 'Akun pelanggan berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal Simpan Pelanggan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan akun pelanggan: ' . $e->getMessage());
        }
    }

    public function updateCustomer(Request $request, $id) 
    { 
        $user = User::where('role', 'user')->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id, // Ditambahkan username
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user->name = $request->name;
            $user->username = $request->username; // Diperbarui
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->route('admin.akun')->with('success', 'Akun pelanggan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal Update Pelanggan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui akun pelanggan.');
        }
    }

    public function hapusCustomer($id) 
    { 
        try {
            $user = User::where('role', 'user')->findOrFail($id);
            $user->delete();
            return redirect()->route('admin.akun')->with('success', 'Akun pelanggan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal Hapus Pelanggan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus akun pelanggan.');
        }
    }

    // --- CRUD TRANSAKSI KEUANGAN ---
    // --- CRUD TRANSAKSI KEUANGAN (FIXED) ---
    public function simpanTransaksi(Request $request) 
    { 
        // Validasi disesuaikan dengan kolom database 'kategori'
        $request->validate([
            'kategori' => 'required|string|max:255', // Ganti 'deskripsi' jadi 'kategori'
            'nominal'   => 'required|numeric|min:1',
            'tipe'      => 'required|in:pemasukan,pengeluaran',
            'status'    => 'required|in:lunas,pending', // Sesuaikan enum di migration
            'tanggal'   => 'required|date',
        ]);
        
        try {
            Transaksi::create([
                'kategori' => $request->kategori, // Input dari form name="kategori"
                'nominal'   => $request->nominal,
                'tipe'      => $request->tipe,
                'status'    => $request->status,
                'tanggal'   => $request->tanggal,
                // Hapus user_id karena tidak ada di migration
            ]);
            
            return redirect()->route('admin.keuangan')->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal Simpan Transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function updateTransaksi(Request $request, $id) 
    { 
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nominal'   => 'required|numeric|min:1',
            'tipe'      => 'required|in:pemasukan,pengeluaran',
            'status'    => 'required|in:lunas,pending',
            'tanggal'   => 'required|date',
        ]);

        try {
            // Karena primary key custom, findOrFail tetap aman
            $transaksi = Transaksi::findOrFail($id);
            
            $transaksi->update([
                'kategori' => $request->kategori,
                'nominal'   => $request->nominal,
                'tipe'      => $request->tipe,
                'status'    => $request->status,
                'tanggal'   => $request->tanggal,
            ]);

            return redirect()->route('admin.keuangan')->with('success', 'Transaksi berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal Update Transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui transaksi.');
        }
    }
    
    public function hapusTransaksi($id) 
    { 
        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();
            return redirect()->route('admin.keuangan')->with('success', 'Transaksi berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal Hapus Transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }
    }
    // --- CRUD ULASAN ---
    // --- CRUD ULASAN (DIPERBAIKI) ---
    public function simpanUlasan(Request $request) 
    { 
        // 1. VALIDASI: Hapus user_id & pesanan_id karena tidak ada di database
        $request->validate([
            'nama_pengulas' => 'required|string|max:255',
            'jenis_pesanan' => 'nullable|string|max:255',
            'rating'       => 'required|integer|min:1|max:5',
            'komentar'     => 'nullable|string',
        ]);

        try {
            // 2. SIMPAN: Hanya kolom yang ada di migration Anda
            Ulasan::create([
                'nama_pengulas' => $request->nama_pengulas,
                'jenis_pesanan' => $request->jenis_pesanan,
                'rating'        => $request->rating,
                'komentar'      => $request->komentar,
            ]);

            return redirect()->route('admin.ulasan')->with('success', 'Ulasan berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal Simpan Ulasan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan ulasan: ' . $e->getMessage());
        }
    }
    
    public function updateUlasan(Request $request, $id) 
    { 
        // Update validasi untuk mencakup nama dan jenis pesanan juga
        $request->validate([
            'nama_pengulas' => 'required|string|max:255',
            'jenis_pesanan' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        try {
            $ulasan = Ulasan::findOrFail($id);
            
            // Update semua field yang bisa diedit admin
            $ulasan->update([
                'nama_pengulas' => $request->nama_pengulas,
                'jenis_pesanan' => $request->jenis_pesanan,
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]);

            return redirect()->route('admin.ulasan')->with('success', 'Ulasan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal Update Ulasan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui ulasan.');
        }
    }

    public function hapusUlasan($id) 
    { 
        try {
            $ulasan = Ulasan::findOrFail($id);
            $ulasan->delete();
            return redirect()->route('admin.ulasan')->with('success', 'Ulasan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal Hapus Ulasan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus ulasan.');
        }
    }
}