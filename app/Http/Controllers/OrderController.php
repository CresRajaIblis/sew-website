<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan Anda punya Model Pesanan
use App\Models\DetailPesanan; // Pastikan Anda punya Model DetailPesanan
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'cart' => 'required|array', // Data keranjang dari LocalStorage
            'total_price' => 'required|numeric'
        ]);

        // Gunakan Database Transaction agar data aman (kalau gagal, tidak ada yang tersimpan setengah-setengah)
        DB::beginTransaction();

        try {
            // 2. Simpan Data Utama Pesanan (Header)
            // Sesuaikan nama kolom dengan tabel 'pesanans' Anda di database
            $pesanan = new Pesanan();
            $pesanan->nama_pemesan = $request->name;
            $pesanan->no_telepon = $request->phone;
            $pesanan->email = $request->email;
            $pesanan->alamat = $request->address;
            $pesanan->catatan = $request->note;
            $pesanan->total_harga = $request->total_price;
            $pesanan->metode_pembayaran = $request->payment_method;
            $pesanan->status = 'pending'; // Default status
            $pesanan->nomor_antrian = $this->generateQueueNumber(); // Fungsi helper bikin nomor antrian
            $pesanan->kode_pesanan = 'ZT-' . time();
            $pesanan->save();

            // 3. Simpan Detail Item Belanjaan
            foreach ($request->cart as $item) {
                $detail = new DetailPesanan();
                $detail->pesanan_id = $pesanan->id; // Link ke pesanan utama
                $detail->nama_produk = $item['name'];
                $detail->warna = $item['colorDisplay'] ?? $item['color'];
                $detail->ukuran = $item['size'];
                $detail->jumlah = $item['quantity'];
                $detail->harga_satuan = $item['price'];
                $detail->total_harga = $item['price'] * $item['quantity'];
                $detail->save();
            }

            DB::commit(); // Simpan permanen jika sukses semua

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan ke database!',
                'order_number' => $pesanan->kode_pesanan,
                'queue_number' => $pesanan->nomor_antrian
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function generateQueueNumber() {
        // Logika sederhana nomor antrian, bisa diganti auto increment db
        $lastOrder = Pesanan::latest()->first();
        if ($lastOrder && is_numeric($lastOrder->nomor_antrian)) {
            return $lastOrder->nomor_antrian + 1;
        }
        return 101; // Mulai dari 101
    }
}