<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        /* Style untuk modal backdrop agar berfungsi */
        #modal-add:not(.hidden), #modal-edit:not(.hidden) { display: flex; opacity: 1; }
        .modal-overlay { opacity: 0; transition: opacity 0.3s; }
        .modal-content { transition: transform 0.3s ease-out; }
        .modal-overlay.hidden .modal-content { transform: scale(0.95); }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .alert-error { background-color: #fee2e2; color: #991b1b; border: 1px solid #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .sidebar a.active { background-color: rgba(255, 255, 255, 0.1); }
        .ulasan-item { border: 1px solid #ddd; padding: 20px; border-radius: 12px; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .rating-star { color: #facc15; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ route('admin.keuangan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ route('admin.akun') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
                <a href="{{ route('admin.pesanan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-file-invoice text-lg"></i></div><span>Pesanan</span></a>
                <a href="{{ route('admin.ulasan') }}" class="flex items-center space-x-4 text-white font-medium scale-105 origin-left transition-all active"><div class="w-6 text-center"><i class="fa-solid fa-comments text-lg"></i></div><span>Ulasan</span></a>
            </nav>
        </div>
        <div class="p-8 mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-3 text-white hover:text-rose-200">
                    <i class="fa-solid fa-arrow-right-from-bracket rotate-180"></i> 
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl text-theme-text font-normal">Ulasan</h1>
            <p class="text-sm font-medium text-black" id="current-date"></p>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">
                <strong>Error Input:</strong>
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <!-- KARTU STATISTIK ULASAN -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Total Ulasan</h3>
                <div class="text-3xl font-medium text-[#00E676]">{{ $totalUlasan }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Rating</h3>
                <div class="text-3xl font-medium text-[#FFA000]"><i class="fa-solid fa-star rating-star mr-2"></i>{{ number_format($avgRating, 1) }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Review Baik</h3>
                <div class="text-3xl font-medium text-[#00E676]">{{ $reviewBaik }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Review Buruk</h3>
                <div class="text-3xl font-medium text-[#ef4444]">{{ $reviewBuruk }}</div>
            </div>
        </div>

        <!-- DAFTAR ULASAN -->
        <div class="bg-white rounded-xl p-6 shadow-sm min-h-[500px]">
            <div class="flex justify-between items-center mb-6 border-b-2 border-theme-text pb-2">
                <h2 class="text-2xl text-theme-text font-normal">Daftar Ulasan</h2>
                <!-- Tombol Tambah Ulasan -->
                <button onclick="openAddModal()" class="w-10 h-10 bg-[#3E2723] text-white rounded-lg flex items-center justify-center hover:bg-[#2d1b18] transition shadow-lg transform active:scale-95">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <div class="space-y-4">
                @forelse($ulasans as $u)
                <div class="ulasan-item">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold text-lg text-theme-dark">{{ $u->nama_pengulas }}</p>
                            <p class="text-sm text-gray-500">Pesanan: {{ $u->jenis_pesanan ?? 'Tidak Spesifik' }}</p>
                            
                            <!-- Bintang Rating -->
                            <div class="flex space-x-1 mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $u->rating)
                                        <i class="fa-solid fa-star rating-star"></i>
                                    @else
                                        <i class="fa-regular fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <!-- Tombol Edit -->
                            <button onclick="openEditModal({{ $u->id }}, '{{ $u->nama_pengulas }}', '{{ $u->jenis_pesanan }}', {{ $u->rating }}, '{{ $u->komentar }}')"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.ulasan.hapus', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                    <p class="text-gray-700 mt-2">{{ $u->komentar }}</p>
                </div>
                @empty
                    <p class="text-center text-gray-500 p-10">Belum ada ulasan yang masuk.</p>
                @endforelse
            </div>
        </div>
    </main>
    
    <!-- 1. MODAL TAMBAH ULASAN -->
    <div id="modal-add" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Tambah Ulasan</h3>
            
            <form id="addForm" action="{{ route('admin.ulasan.simpan') }}" method="POST" class="space-y-3">
                @csrf 

                <div>
                    <label class="text-xs font-semibold text-gray-500">Nama Pengulas</label>
                    <input name="nama_pengulas" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Jenis Pesanan (Opsional)</label>
                    <input name="jenis_pesanan" type="text" placeholder="Contoh: Jas Custom" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Rating (1-5)</label>
                    <input name="rating" type="number" min="1" max="5" value="5" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Komentar</label>
                    <textarea name="komentar" rows="3" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></textarea>
                </div>
                
                <div class="flex gap-2 pt-4">
                    <button type="button" onclick="closeAddModal()" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. MODAL EDIT ULASAN -->
    <div id="modal-edit" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Edit Ulasan</h3>
            
            <form id="editForm" method="POST" class="space-y-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="edit-id"> 

                <div>
                    <label class="text-xs font-semibold text-gray-500">Nama Pengulas</label>
                    <input name="nama_pengulas" id="edit-nama_pengulas" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Jenis Pesanan (Opsional)</label>
                    <input name="jenis_pesanan" id="edit-jenis_pesanan" type="text" placeholder="Contoh: Jas Custom" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Rating (1-5)</label>
                    <input name="rating" id="edit-rating" type="number" min="1" max="5" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-500">Komentar</label>
                    <textarea name="komentar" id="edit-komentar" rows="3" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></textarea>
                </div>
                
                <div class="flex gap-2 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm transition shadow-lg">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});
        });
        
        function openAddModal() {
            // Bersihkan form sebelum membuka
            document.getElementById('addForm').reset();
            document.getElementById('modal-add').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('modal-add').classList.add('hidden');
        }

        function openEditModal(id, nama_pengulas, jenis_pesanan, rating, komentar) {
            const form = document.getElementById('editForm');
            
            // Isi data ke form modal edit
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nama_pengulas').value = nama_pengulas;
            document.getElementById('edit-jenis_pesanan').value = jenis_pesanan;
            document.getElementById('edit-rating').value = rating;
            document.getElementById('edit-komentar').value = komentar;

            // Set action URL form update
            form.action = '{{ url("/admin/ulasan") }}/' + id;

            document.getElementById('modal-edit').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('modal-edit').classList.add('hidden');
        }
        
        // Tutup modal jika klik di luar kotak
        document.getElementById('modal-add').addEventListener('click', function(e) {
            if (e.target.id === 'modal-add') {
                closeAddModal();
            }
        });
        document.getElementById('modal-edit').addEventListener('click', function(e) {
            if (e.target.id === 'modal-edit') {
                closeEditModal();
            }
        });
    </script>
</body>
</html>