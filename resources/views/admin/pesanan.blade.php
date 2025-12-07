<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        /* Style untuk modal backdrop agar berfungsi */
        #modal:not(.hidden) { display: flex; opacity: 1; }
        #modal { opacity: 0; transition: opacity 0.3s; }
        .modal-content { transition: transform 0.3s ease-out; }
        #modal.hidden .modal-content { transform: scale(0.95); }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20 shadow-xl">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2 border-b border-gray-600 pb-4">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ url('/admin/keuangan') }}" class="flex items-center space-x-4 text-gray-400  scale-105 origin-left transition-all active p-2 rounded"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ url('/admin/akun') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
                <a href="{{ url('/admin/pesanan') }}" class="flex items-center space-x-4 text-white font-medium hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-file-invoice text-lg"></i></div><span>Pesanan</span></a>
                <a href="{{ url('/admin/ulasan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-comments text-lg"></i></div><span>Ulasan</span></a>
            </nav>
        </div>
        <div class="p-8 mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-3 text-white hover:text-rose-300 w-full transition-colors"><i class="fa-solid fa-arrow-right-from-bracket rotate-180"></i><span>Log Out</span></button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl text-theme-text font-normal">Pesanan</h1>
            <p class="text-sm font-medium text-black" id="current-date"></p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        <!-- STATISTIK -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            @php
                // Hitung statistik untuk kartu (diambil langsung dari $semuaPesanan)
                $totalPesanan = $semuaPesanan->count();
                $diproses = $semuaPesanan->where('status', 'diproses')->count();
                $selesai = $semuaPesanan->where('status', 'selesai')->count();
            @endphp
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Total Pesanan</h3><div class="text-3xl font-medium text-[#00E676]">{{ $totalPesanan }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Dalam Proses</h3><div class="text-3xl font-medium text-[#FFA000]">{{ $diproses }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Selesai</h3><div class="text-3xl font-medium text-[#00E676]">{{ $selesai }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm min-h-[500px]">
            <div class="flex justify-between items-center mb-6 border-b-2 border-theme-text pb-2">
                <h2 class="text-2xl text-theme-text font-normal">Daftar Pesanan</h2>
                <button onclick="openModal()" class="w-10 h-10 bg-[#3E2723] text-white rounded-lg flex items-center justify-center hover:bg-[#2d1b18] transition shadow-lg transform active:scale-95">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <div class="space-y-4" id="order-container">
                
                @forelse($semuaPesanan as $p)
                    <div class="border border-black rounded-2xl p-6 relative fade-in">
                        <div class="flex justify-between items-start">
                            <div class="w-1/2">
                                <div class="flex items-center gap-4 mb-1">
                                    {{-- FIX: Menggunakan kode_pesanan dan nomor_antrian --}}
                                    <h3 class="text-lg font-medium text-black">Pesanan #{{ $p->nomor_antrian }} ({{ $p->kode_pesanan }})</h3>
                                    @php
                                        $badgeColor = match($p->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-[#EFA00B] text-white',
                                            'selesai' => 'bg-[#81C784] text-black',
                                            default => 'bg-gray-400 text-white',
                                        };
                                        $statusText = ucfirst($p->status);
                                    @endphp
                                    <span class="{{ $badgeColor }} px-4 py-1 rounded-full text-xs">{{ $statusText }}</span>
                                </div>
                                {{-- FIX: Menggunakan nama_pemesan --}}
                                <p class="text-gray-500 text-sm mb-1">Pelanggan : {{ $p->nama_pemesan }}</p> 
                                <p class="text-gray-500 text-sm">Total Harga : Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
                                <p class="text-gray-500 text-sm">Dibuat : {{ date('d-m-Y', strtotime($p->created_at)) }}</p>
                            </div>
                            <div class="w-1/2 text-right">
                                @if($p->detail->isNotEmpty())
                                    <p class="text-gray-600 text-sm mb-1 font-semibold">Rincian Produk:</p>
                                    @foreach($p->detail as $detail)
                                        <p class="text-gray-600 text-xs">{{ $detail->nama_produk }} - {{ $detail->warna }} ({{ $detail->ukuran }}) x {{ $detail->jumlah }}</p>
                                    @endforeach
                                @else
                                    <p class="text-gray-600 text-sm mb-1 font-semibold">Rincian Produk: (Input Manual)</p>
                                    <p class="text-gray-600 text-sm">Catatan : {{ $p->catatan ?? 'Tidak ada' }}</p>
                                @endif
                                
                                <p class="text-gray-600 text-sm mt-2">Dipesan Via: {{ $p->metode_pembayaran }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 p-10">Tidak ada data pesanan saat ini.</p>
                @endforelse

            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH PESANAN (Form dipertahankan) -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content" id="modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Input Pesanan Baru (Manual)</h3>
            
            <form action="{{ route('admin.pesanan.simpan') }}" method="POST" id="main-pesanan-form" class="space-y-3">
                @csrf 

                <div><label class="text-xs font-semibold text-gray-500">Jenis Pakaian</label><input name="jenis_pakaian" type="text" placeholder="Contoh: Jas Custom" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                {{-- FIX: Menggunakan nama_pelanggan di form (sesuai Controller mapping) --}}
                <div><label class="text-xs font-semibold text-gray-500">Nama Pelanggan</label><input name="nama_pelanggan" type="text" placeholder="Contoh: Budi" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                
                <div class="grid grid-cols-2 gap-2">
                    <div><label class="text-xs font-semibold text-gray-500">Ukuran</label><select name="ukuran" class="w-full p-2 border rounded bg-gray-50 focus:border-theme-dark outline-none text-sm" required>
                            <option value="S">S</option><option value="M">M</option><option value="L">L</option><option value="XL">XL</option><option value="XXL">XXL</option><option value="Custom">Custom</option>
                        </select></div>
                    <div><label class="text-xs font-semibold text-gray-500">Jumlah (Pcs)</label><input name="jumlah" type="number" value="1" min="1" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    {{-- FIX: Harga di form (sesuai Controller mapping) --}}
                    <div><label class="text-xs font-semibold text-gray-500">Harga (Rp)</label><input name="harga" type="number" placeholder="150000" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                    <div><label class="text-xs font-semibold text-gray-500">Deadline</label><input name="deadline" type="date" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                </div>

                <div><label class="text-xs font-semibold text-gray-500">Catatan</label><textarea name="catatan" rows="2" placeholder="Detail warna, bahan, atau ukuran khusus." class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></textarea></div>
                
                <div class="flex gap-2 mt-6 pt-2">
                    <button type="button" onclick="closeModal()" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});

        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
        
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target.id === 'modal') {
                closeModal();
            }
        });
    </script>
</body>
</html>