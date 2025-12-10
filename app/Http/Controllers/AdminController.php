<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan; 
use App\Models\User;
// use App\Models\Customer; // DIHAPUS: Karena sudah tidak dipakai (diganti User role user)
use App\Models\Transaksi;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD
    // ==========================================
    public function index() 
    {
        // Statistik Utama
        $pesananSelesai = Pesanan::where('status', 'selesai')->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('total_harga'); 
        
        // Rating
        $totalUlasan = Ulasan::count(); 
        $avgRating = $totalUlasan > 0 ? Ulasan::avg('rating') : 0;
        $rating = number_format($avgRating, 1); 

        // Grafik Pendapatan 7 Hari Terakhir
        $pendapatanHarian = []; 
        $labelHari = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $labelHari[] = $tanggal->translatedFormat('D, d'); 
            $pendapatan = Pesanan::whereDate('updated_at', $tanggal)
                                ->where('status', 'selesai')
                                ->sum('total_harga'); 
            $pendapatanHarian[] = $pendapatan;
        }

        // Pesanan Terakhir
        $pesananTerakhir = Pesanan::with('detail')->orderBy('id', 'desc')->take(10)->get();

        // Top Pesanan (Produk Terlaris)
        $topPesanan = DetailPesanan::select('nama_produk', DB::raw('SUM(jumlah) as total_terjual'))
                                ->groupBy('nama_produk')
                                ->orderByDesc('total_terjual')
                                ->take(3)
                                ->get();

        // Status Mesin (Dummy Data)
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

    // ==========================================
    // KEUANGAN (TRANSAKSI) - FOKUS PERBAIKAN
    // ==========================================
    public function keuangan(Request $request) 
    { 
        $query = Transaksi::orderBy('tanggal', 'desc');

        $filter = $request->input('filter', 'bulanan');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif ($filter === 'harian') {
            $query->whereDate('tanggal', today());
        } elseif ($filter === 'mingguan') {
            $query->where('tanggal', '>=', now()->subDays(6)->startOfDay());
        } elseif ($filter === 'bulanan') {
            $query->whereYear('tanggal', now()->year)->whereMonth('tanggal', now()->month);
        } 

        $transaksis = $query->get();
        
        $pemasukan = $transaksis->where('tipe', 'pemasukan')->where('status', 'lunas')->sum('nominal');
        $pengeluaran = $transaksis->where('tipe', 'pengeluaran')->where('status', 'lunas')->sum('nominal');
        $labaBersih = $pemasukan - $pengeluaran;
        
        return view('admin.keuangan', compact('transaksis', 'pemasukan', 'pengeluaran', 'labaBersih')); 
    }

    public function simpanTransaksi(Request $request) 
    { 
        $request->validate([
            'kategori'  => 'required|string|max:255',
            'nominal'   => 'required|numeric|min:1',
            'tipe'      => 'required|in:pemasukan,pengeluaran',
            'status'    => 'required|in:lunas,pending',
            'tanggal'   => 'required|date',
            'deskripsi' => 'nullable|string', 
        ]);
        
        try {
            Transaksi::create([
                'kategori'  => $request->kategori,
                'nominal'   => $request->nominal,
                'tipe'      => $request->tipe,
                'status'    => $request->status,
                'tanggal'   => $request->tanggal,
                'deskripsi' => $request->deskripsi, 
            ]);
            
            return redirect()->to('/admin/keuangan')->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal Simpan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function updateTransaksi(Request $request) 
    { 
        // Ambil ID dari input hidden di form
        $kode = $request->kode; 

        // Cek jika ID tidak ada
        if(!$kode) {
            return redirect()->back()->with('error', 'ID Transaksi tidak ditemukan!');
        }

        try {
            $transaksi = Transaksi::findOrFail($kode);
            
            $transaksi->update([
                'kategori'  => $request->kategori,
                'nominal'   => $request->nominal,
                'tipe'      => $request->tipe,
                'status'    => $request->status,
                'tanggal'   => $request->tanggal,
                'deskripsi' => $request->deskripsi, 
            ]);

            return redirect()->to('/admin/keuangan')->with('success', 'Berhasil update!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }
    
    // Hapus Transaksi (Tetap pakai parameter ID karena lewat URL)
    public function hapusTransaksi($kode) 
    { 
        try {
            $transaksi = Transaksi::findOrFail($kode);
            $transaksi->delete();
            return redirect()->to('/admin/keuangan')->with('success', 'Berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus.');
        }
    }
    // ==========================================
    // 3. PESANAN
    // ==========================================
    public function pesanan()
    {
        $semuaPesanan = Pesanan::with(['user', 'detail'])->orderBy('id', 'desc')->get();
        return view('admin.pesanan', compact('semuaPesanan'));
    }

    public function simpanPesanan(Request $request) 
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'jenis_pakaian' => 'required|string|max:255',
                'ukuran' => 'required|string|max:50',
                'jumlah' => 'required|integer|min:1',
                'harga' => 'required|numeric|min:1000', 
                'deadline' => 'nullable|date',
                'catatan' => 'nullable|string',
            ]);
            
            $totalHarga = $request->harga; 
            $hargaSatuan = $totalHarga / $request->jumlah;

            // Generate Nomor Antrian
            $lastPesanan = Pesanan::latest('id')->first();
            $nextNomorAntrian = ($lastPesanan ? $lastPesanan->nomor_antrian : 100) + 1;

            $pesanan = Pesanan::create([
                'nama_pemesan' => $request->nama_pelanggan, 
                'total_harga' => $totalHarga, 
                'kode_pesanan' => 'M-' . strtoupper(substr(uniqid(), -5)), 
                'nomor_antrian' => $nextNomorAntrian,
                'no_telepon' => '0', 
                'email' => 'manual@admin.com', 
                'alamat' => 'Input Manual', 
                'metode_pembayaran' => 'Cash', 
                'status' => 'diproses', 
                'user_id' => Auth::id(), 
            ]);
            
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

    // ==========================================
    // 4. AKUN (STAF & CUSTOMER)
    // ==========================================
    public function akun() 
    { 
        $stafs = User::whereIn('role', ['admin', 'pegawai'])->orderBy('role', 'asc')->get();
        $customers = User::where('role', 'user')->get();
        
        $totalPegawai = $stafs->where('role', 'pegawai')->count();
        $totalAdmin = $stafs->where('role', 'admin')->count();
        $totalPelanggan = $customers->count(); 
        
        return view('admin.akun', compact('stafs', 'customers', 'totalPegawai', 'totalAdmin', 'totalPelanggan')); 
    }
    
    // CRUD Staf/Admin
    public function simpanAkun(Request $request) 
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
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

    // CRUD Customer
    public function simpanCustomer(Request $request) 
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user', 
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
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user->name = $request->name;
            $user->username = $request->username;
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

    // ==========================================
    // 5. ULASAN
    // ==========================================
    public function ulasan() 
    { 
        $ulasans = Ulasan::orderBy('created_at', 'desc')->get();
        $totalUlasan = $ulasans->count();
        $avgRating = $totalUlasan > 0 ? $ulasans->avg('rating') : 0;
        $reviewBaik = $ulasans->where('rating', '>', 3)->count();
        $reviewBuruk = $ulasans->where('rating', '<=', 3)->count();
        return view('admin.ulasan', compact('ulasans', 'totalUlasan', 'avgRating', 'reviewBaik', 'reviewBuruk')); 
    }
    
    public function simpanUlasan(Request $request) 
    { 
        $request->validate([
            'nama_pengulas' => 'required|string|max:255',
            'jenis_pesanan' => 'nullable|string|max:255',
            'rating'       => 'required|integer|min:1|max:5',
            'komentar'     => 'nullable|string',
        ]);

        try {
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
        $request->validate([
            'nama_pengulas' => 'required|string|max:255',
            'jenis_pesanan' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        try {
            $ulasan = Ulasan::findOrFail($id);
            
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