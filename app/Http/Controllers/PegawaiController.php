<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Ulasan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PegawaiController extends Controller
{
    /**
     * FUNGSI WAJIB: index() - Menampilkan Dashboard Pegawai.
     */
    public function index()
    {
        $pegawaiId = Auth::id();

        $pesananPending = Pesanan::where('status', 'pending')->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();
        $pesananSelesai = Pesanan::where('status', 'selesai')->count();

        $totalPesananUsaha = $pesananPending + $pesananDiproses + $pesananSelesai;
        $dalamProses = $pesananDiproses; 
        $hasilJahitAnda = $pesananSelesai; // Asumsi: Hasil jahit Anda = Total pesanan selesai

        $daftarPesanan = Pesanan::with('detail')
                                ->whereIn('status', ['pending', 'diproses'])
                                ->orderBy('nomor_antrian', 'asc')
                                ->get();

        return view('pegawai.dashboard', compact(
            'pesananPending', 
            'pesananDiproses', 
            'pesananSelesai', 
            'daftarPesanan', 
            'totalPesananUsaha',
            'dalamProses',
            'hasilJahitAnda'
        ));
    }

    /**
     * FUNGSI WAJIB: ulasan() - Menampilkan Halaman Ulasan dan statistiknya.
     * FIX: Tambahkan variabel statistik ulasan yang dibutuhkan view.
     */
    public function ulasan()
    {
        $ulasans = Ulasan::orderBy('created_at', 'desc')->get();
        
        // FIX BARU: Definisikan semua variabel statistik
        $totalUlasan = $ulasans->count();
        $avgRating = $totalUlasan > 0 ? $ulasans->avg('rating') : 0;
        $rating = number_format($avgRating, 1);

        // FIX TAMBAHAN: Definisikan $reviewBaik dan $reviewBuruk
        $reviewBaik = $ulasans->where('rating', '>', 3)->count();
        $reviewBuruk = $ulasans->where('rating', '<=', 3)->count();
        
        return view('pegawai.ulasan', compact('ulasans', 'totalUlasan', 'avgRating', 'rating', 'reviewBaik', 'reviewBuruk'));
    }

    /**
     * Mengambil Pesanan (Status dari 'pending' menjadi 'diproses')
     */
    public function ambilPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        if ($pesanan->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan ini sudah diproses atau selesai.');
        }

        $pesanan->status = 'diproses';
        // Logika untuk menyimpan pegawai yang mengambil pesanan (jika ada kolom pegawai_id)
        // $pesanan->pegawai_id = Auth::id(); 
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan #' . $pesanan->nomor_antrian . ' berhasil diambil dan mulai diproses.');
    }

    /**
     * Menyelesaikan Pesanan (Status dari 'diproses' menjadi 'selesai')
     */
    public function selesaikanPesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        if ($pesanan->status !== 'diproses') {
            return redirect()->back()->with('error', 'Pesanan harus dalam status "Diproses" sebelum diselesaikan.');
        }

        $pesanan->status = 'selesai';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan #' . $pesanan->nomor_antrian . ' berhasil diselesaikan.');
    }
}