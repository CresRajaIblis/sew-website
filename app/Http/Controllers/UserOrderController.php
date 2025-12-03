<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; 
use App\Models\DetailPesanan; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;

// KRITIS: Nama kelas HARUS UserOrderController dan TIDAK statis
class UserOrderController extends Controller 
{
    /**
     * FUNGSI WAJIB: loadCartState().
     * Dipanggil oleh rute user.dashboard setelah login sukses.
     */
    public function loadCartState()
    {
        // Mengembalikan view catalogue (katalog/dashboard user)
        return view('user.catalogue'); 
    }
    
    // Fungsi index() juga ditambahkan untuk rute yang memanggil method 'index'
    public function index()
    {
        return $this->loadCartState(); 
    }
    
    // ... (Fungsi checkout dan helper lainnya di sini) ...
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'cart' => 'required|array', 
            'total_price' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $pesanan = new Pesanan();
            $pesanan->nama_pemesan = $request->name;
            $pesanan->no_telepon = $request->phone;
            $pesanan->email = $request->email;
            $pesanan->alamat = $request->address;
            $pesanan->catatan = $request->note;
            $pesanan->total_harga = $request->total_price;
            $pesanan->metode_pembayaran = $request->payment_method;
            $pesanan->status = 'pending'; 
            $pesanan->nomor_antrian = $this->generateQueueNumber(); 
            $pesanan->kode_pesanan = 'ZT-' . time();
            $pesanan->save();

            foreach ($request->cart as $item) {
                $detail = new DetailPesanan();
                $detail->pesanan_id = $pesanan->id; 
                $detail->nama_produk = $item['name'];
                $warna = $item['colorDisplay'] ?? $item['color'] ?? '-';
                if(is_array($warna)) $warna = implode(', ', $warna);
                $detail->warna = $warna;
                $detail->ukuran = $item['size'];
                $detail->jumlah = $item['quantity'];
                $detail->harga_satuan = $item['price'];
                $detail->total_harga = $item['price'] * $item['quantity'];
                $detail->save();
            }
            DB::commit(); 
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan ke database!',
                'order_number' => $pesanan->kode_pesanan,
                'queue_number' => $pesanan->nomor_antrian
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); 
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    // FUNGSI BARU: Ini yang dipanggil oleh AuthController
    public function getCartDataForSession($userId) 
    {
        // Ganti Model Cart dengan Model yang sesuai di DB Anda
        $cart = Cart::where('user_id', $userId)->first(); 
        
        // Asumsi data cart disimpan dalam kolom 'data' berbentuk JSON string
        return $cart ? $cart->data : '[]'; 
    }

    private function generateQueueNumber() {
        $lastOrder = Pesanan::latest()->first();
        if ($lastOrder && is_numeric($lastOrder->nomor_antrian)) {
            return $lastOrder->nomor_antrian + 1;
        }
        return 101; 
    }
}