<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Halaman produk/katalog
    public function catalogue()
    {
        $products = Product::where('status', 'active')->get();
        return view('user.catalogue', compact('products'));
    }

    // Halaman detail produk
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $related = Product::where('kategori', $product->kategori)
                         ->where('id', '!=', $id)
                         ->limit(4)
                         ->get();
        return view('user.product-detail', compact('product', 'related'));
    }

    // Tambah ke keranjang
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'color' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        // Simpan ke session atau database sesuai kebutuhan
        $cart = session()->get('cart', []);
        
        $cart[$validated['product_id']] = [
            'product_id' => $validated['product_id'],
            'size' => $validated['size'],
            'color' => $validated['color'],
            'quantity' => $validated['quantity']
        ];
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => count($cart)
        ]);
    }

    // Halaman keranjang
    public function cart()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();
        
        $cartItems = [];
        foreach ($products as $product) {
            $cartItems[] = [
                'product' => $product,
                'cart_data' => $cart[$product->id]
            ];
        }
        
        return view('user.cart', compact('cartItems'));
    }

    // Proses checkout
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:transfer,ewallet,cod'
        ]);

        // Simpan data customer jika belum ada
        $customer = Customer::updateOrCreate(
            ['email' => $validated['email']],
            [
                'nama' => $validated['name'],
                'telepon' => $validated['phone'],
                'alamat' => $validated['address'],
                'kota' => $validated['city'],
                'kode_pos' => $validated['postal_code']
            ]
        );

        // Buat pesanan
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();
        
        $total = 0;
        foreach ($products as $product) {
            $cartData = $cart[$product->id];
            $total += $product->harga * $cartData['quantity'];
        }

        $tax = $total * 0.1; // Pajak 10%
        $grandTotal = $total + $tax;

        // Simpan pesanan
        $pesanan = Pesanan::create([
            'customer_id' => $customer->id,
            'tanggal_pesan' => now(),
            'total_harga' => $grandTotal,
            'status' => 'pending',
            'catatan' => $validated['note'],
            'metode_pembayaran' => $validated['payment_method'],
            'alamat_pengiriman' => $validated['address'],
            'kota' => $validated['city'],
            'kode_pos' => $validated['postal_code']
        ]);

        // Simpan detail pesanan
        foreach ($products as $product) {
            $cartData = $cart[$product->id];
            
            $pesanan->detail_pesanans()->create([
                'product_id' => $product->id,
                'jumlah' => $cartData['quantity'],
                'harga' => $product->harga,
                'subtotal' => $product->harga * $cartData['quantity'],
                'ukuran' => $cartData['size'],
                'warna' => $cartData['color']
            ]);
        }

        // Buat transaksi
        $transaksi = Transaksi::create([
            'pesanan_id' => $pesanan->id,
            'customer_id' => $customer->id,
            'total_bayar' => $grandTotal,
            'metode_pembayaran' => $validated['payment_method'],
            'status_pembayaran' => 'pending',
            'tanggal_transaksi' => now()
        ]);

        // Generate nomor antrian
        $queueNumber = Pesanan::whereDate('created_at', today())->count() + 100;
        $pesanan->update(['nomor_antrian' => $queueNumber]);

        // Clear cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'order_id' => $pesanan->id,
            'order_number' => 'ZT' . $pesanan->id,
            'queue_number' => $queueNumber,
            'total' => $grandTotal,
            'estimated_date' => now()->addDays(7)->format('Y-m-d')
        ]);
    }

    // Lacak pesanan
    public function trackOrder(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|string',
            'email' => 'required|email'
        ]);

        $pesanan = Pesanan::where('id', str_replace('ZT', '', $validated['order_id']))
                         ->whereHas('customer', function($query) use ($validated) {
                             $query->where('email', $validated['email']);
                         })
                         ->with(['customer', 'detail_pesanans.product', 'transaksi'])
                         ->first();

        if (!$pesanan) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'order' => $pesanan
        ]);
    }

    // Submit ulasan
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000'
        ]);

        $ulasan = Ulasan::create([
            'customer_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'pesanan_id' => $validated['pesanan_id'],
            'rating' => $validated['rating'],
            'ulasan' => $validated['review'],
            'status' => 'active'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil disimpan'
        ]);
    }

    // Get ulasan produk
    public function getProductReviews($productId)
    {
        $reviews = Ulasan::where('product_id', $productId)
                        ->where('status', 'active')
                        ->with('customer')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json($reviews);
    }

    // Update profile user
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        $user = auth()->user();
        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui'
        ]);
    }

    // Order history
    public function orderHistory()
    {
        $orders = Pesanan::where('customer_id', auth()->id())
                        ->with(['detail_pesanans.product', 'transaksi'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('user.order-history', compact('orders'));
    }
}