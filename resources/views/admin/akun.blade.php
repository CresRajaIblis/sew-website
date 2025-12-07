<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        /* Style untuk modal backdrop agar berfungsi */
        .modal-overlay { opacity: 0; transition: opacity 0.3s; display: none; }
        .modal-overlay.open { opacity: 1; display: flex; }
        .modal-content { transition: transform 0.3s ease-out; }
        .modal-overlay:not(.open) .modal-content { transform: scale(0.95); }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .alert-error { background-color: #fee2e2; color: #991b1b; border: 1px solid #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .sidebar a.active { background-color: rgba(255, 255, 255, 0.1); }
        /* Style Tabs */
        .tab-button { padding: 10px 20px; cursor: pointer; border-bottom: 3px solid transparent; transition: all 0.2s; font-weight: 500; }
        .tab-button.active { color: #3E2723; border-bottom-color: #3E2723; font-weight: 700; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20 shadow-xl">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2 border-b border-gray-600 pb-4">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ url('/admin/keuangan') }}" class="flex items-center space-x-4 text-gray-400 scale-105 origin-left transition-all active p-2 rounded"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ url('/admin/akun') }}" class="flex items-center space-x-4 text-white font-medium hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
                <a href="{{ url('/admin/pesanan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-file-invoice text-lg"></i></div><span>Pesanan</span></a>
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
            <h1 class="text-3xl text-theme-text font-normal">Kelola Akun</h1>
            <p class="text-sm font-medium text-black" id="current-date">{{ now()->translatedFormat('d F Y') }}</p>
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


        <!-- STATISTIK AKUN -->
        {{-- Pastikan semua variabel ini ada di controller: $totalPegawai, $totalPelanggan, $totalAdmin --}}
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Pegawai</h3><div class="text-3xl font-medium text-[#00E676]">{{ $totalPegawai }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Pelanggan</h3><div class="text-3xl font-medium text-[#FFA000]">{{ $totalPelanggan }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Admin</h3><div class="text-3xl font-medium text-[#00E676]">{{ $totalAdmin }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm min-h-[500px]">
            <!-- TAB BUTTONS -->
            <div class="flex border-b border-gray-200 mb-6">
                <button id="tab-pegawai-btn" onclick="switchTab('pegawai')" class="tab-button active">Pegawai & Admin</button>
                <button id="tab-pelanggan-btn" onclick="switchTab('pelanggan')" class="tab-button">Pelanggan</button>
            </div>

            <!-- TAB CONTENT: PEGAWAI -->
            <div id="tab-pegawai-content" class="tab-content active">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl text-theme-text font-normal">Daftar Pegawai & Admin</h2>
                    <!-- Tombol Tambah Pegawai (Buka Modal Tambah User) -->
                    <button onclick="openAddModal('user')" class="w-10 h-10 bg-[#3E2723] text-white rounded-lg flex items-center justify-center hover:bg-[#2d1b18] transition shadow-lg transform active:scale-95">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- LOOPING $stafs (Admin & Pegawai) --}}
                            @forelse($stafs as $staf)
                            <tr class="{{ $staf->role == 'admin' ? 'bg-theme-bg/30' : 'hover:bg-gray-50' }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $staf->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $staf->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $staf->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $staf->role == 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($staf->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    {{-- Tombol Edit User --}}
                                    <button onclick="openEditModal('user', '{{ $staf->id }}', '{{ $staf->name }}', '{{ $staf->username }}', '{{ $staf->email }}', '{{ $staf->role }}')" 
                                            class="text-indigo-600 hover:text-indigo-900"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    
                                    {{-- Tombol Hapus User --}}
                                    @if(Auth::id() != $staf->id)
                                    <form action="{{ route('admin.akun.delete_staf', ['id'=> $staf->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun {{ $staf->username }}? Tindakan ini permanen.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </form>
                                    @else
                                    <span class="text-gray-400 text-xs">Anda</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data user.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB CONTENT: PELANGGAN -->
            <div id="tab-pelanggan-content" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl text-theme-text font-normal">Daftar Pelanggan</h2>
                    <!-- Tombol Tambah Pelanggan (Buka Modal Tambah Customer) -->
                    <button onclick="openAddModal('customer')" class="w-10 h-10 bg-[#3E2723] text-white rounded-lg flex items-center justify-center hover:bg-[#2d1b18] transition shadow-lg transform active:scale-95">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- LOOPING $customers --}}
                            @forelse($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                {{-- PERHATIAN: Customer di sini seharusnya adalah Model User dengan role 'user', 
                                   tapi karena di controller Anda masih memanggil $customer->nama, saya asumsikan 
                                   Model Customer terpisah atau Model User punya kolom 'nama' dan 'kontak'.
                                   Jika error, perlu penyesuaian di AdminController.php. --}}
                                <td class="px-6 py-4 whitespace-nowrap">CUST-{{ $customer->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->name ?? $customer->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->kontak ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    {{-- Tombol Edit Customer --}}
                                    <button onclick="openEditModal('customer', '{{ $customer->id }}', '{{ $customer->name ?? $customer->nama }}', '{{ $customer->kontak ?? '' }}', '{{ $customer->email ?? '' }}')" 
                                            class="text-indigo-600 hover:text-indigo-900"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    
                                    {{-- Tombol Hapus Customer (FIXED: Route name) --}}
                                    <form action="{{ route('admin.hapus.customer', $customer->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan {{ $customer->name ?? $customer->nama }}? Histori pesanannya tidak akan ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pelanggan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
    
    <!-- 1. MODAL TAMBAH (User/Customer) -->
    <div id="modal-add" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark" id="add-modal-title">Tambah Akun</h3>
            
            {{-- FORM TAMBAH USER (Pegawai/Admin) --}}
            <form id="add-user-form" action="{{ route('admin.akun.simpan') }}" method="POST" class="space-y-3">
                @csrf 
                <div><label class="text-xs font-semibold text-gray-500">Nama Lengkap</label><input name="name" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Username</label><input name="username" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Email</label><input name="email" type="email" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Role</label>
                    <select name="role" class="w-full p-2 border rounded bg-gray-50 focus:border-theme-dark outline-none text-sm" required>
                        <option value="pegawai">Pegawai</option><option value="admin">Admin</option>
                    </select>
                </div>
                 <div><label class="text-xs font-semibold text-gray-500">Password</label><input name="password" type="password" minlength="6" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                 <div><label class="text-xs font-semibold text-gray-500">Konfirmasi Password</label><input name="password_confirmation" type="password" minlength="6" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeModal('add')" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button></div>
            </form>

            {{-- FORM TAMBAH CUSTOMER (Pelanggan) --}}
            <form id="add-customer-form" action="{{ route('admin.customer.simpan') }}" method="POST" class="space-y-3 hidden">
                @csrf 
                <div><label class="text-xs font-semibold text-gray-500">Nama Pelanggan</label><input name="nama" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Nomor Kontak (HP/WA)</label><input name="kontak" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></div>
                <div><label class="text-xs font-semibold text-gray-500">Email (Opsional)</label><input name="email" type="email" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></div>
                
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeModal('add')" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button></div>
            </form>
        </div>
    </div>

    <!-- 2. MODAL EDIT (User/Customer) -->
    <div id="modal-edit" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark" id="edit-modal-title">Edit Akun</h3>
            
            {{-- FORM EDIT USER (Pegawai/Admin) --}}
            <form id="edit-user-form" method="POST" class="space-y-3">
                {{-- NOTE: Action URL akan diisi oleh JS --}}
                @csrf @method('PUT') 
                <div><label class="text-xs font-semibold text-gray-500">Nama Lengkap</label><input name="name" id="edit-user-name" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Username</label><input name="username" id="edit-user-username" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Email</label><input name="email" id="edit-user-email" type="email" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" disabled></div>
                <div><label class="text-xs font-semibold text-gray-500">Role</label>
                    <select name="role" id="edit-user-role" class="w-full p-2 border rounded bg-gray-50 focus:border-theme-dark outline-none text-sm" required>
                        <option value="pegawai">Pegawai</option><option value="admin">Admin</option>
                    </select>
                </div>
                 <div><label class="text-xs font-semibold text-gray-500">Password Baru (Kosongkan jika tidak diubah)</label><input name="password" type="password" minlength="6" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></div>
                
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeModal('edit')" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button></div>
            </form>

            {{-- FORM EDIT CUSTOMER (Pelanggan) --}}
            <form id="edit-customer-form" method="POST" class="space-y-3 hidden">
                {{-- NOTE: Action URL akan diisi oleh JS --}}
                @csrf @method('PUT') 
                <div><label class="text-xs font-semibold text-gray-500">Nama Pelanggan</label><input name="nama" id="edit-customer-nama" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Nomor Kontak (HP/WA)</label><input name="kontak" id="edit-customer-kontak" type="text" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></div>
                <div><label class="text-xs font-semibold text-gray-500">Email (Opsional)</label><input name="email" id="edit-customer-email" type="email" class="w-full p-2 border rounded focus:border-theme-dark outline-none text-sm"></div>
                
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeModal('edit')" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm transition">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm transition shadow-lg">Simpan</button></div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Inisialisasi State
        let currentTab = 'pegawai';

        function switchTab(tabId) {
            // Update active button
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.getElementById(`tab-${tabId}-btn`).classList.add('active');
            
            // Update content visibility
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.getElementById(`tab-${tabId}-content`).classList.add('active');
            
            currentTab = tabId;
        }

        function openAddModal(type) {
            const modal = document.getElementById('modal-add');
            document.getElementById('add-user-form').classList.add('hidden');
            document.getElementById('add-customer-form').classList.add('hidden');

            if (type === 'user') {
                document.getElementById('add-modal-title').textContent = 'Tambah Akun Pegawai/Admin';
                document.getElementById('add-user-form').classList.remove('hidden');
            } else if (type === 'customer') {
                document.getElementById('add-modal-title').textContent = 'Tambah Akun Pelanggan';
                document.getElementById('add-customer-form').classList.remove('hidden');
            }

            modal.classList.add('open');
            modal.style.display = 'flex';
        }

        function openEditModal(type, id, name, usernameOrContact, email, role) {
            const modal = document.getElementById('modal-edit');
            document.getElementById('edit-user-form').classList.add('hidden');
            document.getElementById('edit-customer-form').classList.add('hidden');

            if (type === 'user') {
                // Edit Staf (Pegawai/Admin)
                document.getElementById('edit-modal-title').textContent = 'Edit Akun Staf/Admin';
                document.getElementById('edit-user-form').classList.remove('hidden');

                // Isi data
                document.getElementById('edit-user-form').action = `{{ route('admin.akun.simpan') }}/${id}`;
                document.getElementById('edit-user-name').value = name;
                document.getElementById('edit-user-username').value = usernameOrContact;
                document.getElementById('edit-user-email').value = email;
                document.getElementById('edit-user-role').value = role;

            } else if (type === 'customer') {
                // Edit Pelanggan
                document.getElementById('edit-modal-title').textContent = 'Edit Akun Pelanggan';
                document.getElementById('edit-customer-form').classList.remove('hidden');

                // Isi data
                document.getElementById('edit-customer-form').action = `{{ route('admin.customer.update', '') }}/${id}`;
                document.getElementById('edit-customer-nama').value = name;
                document.getElementById('edit-customer-kontak').value = usernameOrContact;
                document.getElementById('edit-customer-email').value = email;
            }

            modal.classList.add('open');
            modal.style.display = 'flex';
        }

        function closeModal(modalType) {
            const modal = document.getElementById(`modal-${modalType}`);
            modal.classList.remove('open');
            // Timeout untuk transisi, lalu sembunyikan
            setTimeout(() => { modal.style.display = 'none'; }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('modal-add').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('add');
            }
        });
        document.getElementById('modal-edit').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('edit');
            }
        });

        // Initialize active tab on load
        document.addEventListener('DOMContentLoaded', () => {
            switchTab('pegawai');
        });
    </script>
</body>
</html>