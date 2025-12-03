<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        #modal-add:not(.hidden), #modal-edit:not(.hidden) { display: flex; opacity: 1; }
        .modal-overlay { opacity: 0; transition: opacity 0.3s; }
        .modal-content { transition: transform 0.3s ease-out; }
        .modal-overlay.hidden .modal-content { transform: scale(0.95); }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .sidebar a.active { background-color: rgba(255, 255, 255, 0.1); }
        
        .tab-filter { padding: 8px 16px; border-radius: 9999px; font-weight: 500; cursor: pointer; transition: all 0.2s; border: 1px solid transparent; }
        .tab-filter.active { background-color: #3E2723; color: white; border-color: #3E2723; }
        .tab-filter:hover { background-color: #5D4037; color: white; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ url('/admin/keuangan') }}" class="flex items-center space-x-4 text-white font-medium scale-105 origin-left transition-all active"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ url('/admin/akun') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
                <a href="{{ url('/admin/pesanan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-file-invoice text-lg"></i></div><span>Pesanan</span></a>
                <a href="{{ url('/admin/ulasan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-comments text-lg"></i></div><span>Ulasan</span></a>
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
            <h1 class="text-3xl text-theme-text font-normal">Keuangan</h1>
            <p class="text-sm font-medium text-black" id="current-date"></p>
        </div>

        @if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif
        
        <!-- FILTER TAB -->
        <div class="flex items-center space-x-4 mb-6">
            <!-- Kita gunakan Logika Request GET sederhana -->
            <a href="{{ url('/admin/keuangan') }}?filter=bulanan" class="tab-filter {{ request('filter') == 'bulanan' || !request('filter') ? 'active' : '' }}">Bulanan</a>
            <a href="{{ url('/admin/keuangan') }}?filter=mingguan" class="tab-filter {{ request('filter') == 'mingguan' ? 'active' : '' }}">Mingguan</a>
            <a href="{{ url('/admin/keuangan') }}?filter=harian" class="tab-filter {{ request('filter') == 'harian' ? 'active' : '' }}">Harian</a>
            <a href="{{ url('/admin/keuangan') }}?filter=semua" class="tab-filter {{ request('filter') == 'semua' ? 'active' : '' }}">Semua</a>

            <!-- Form Filter Tanggal Manual -->
            <form action="{{ url('/admin/keuangan') }}" method="GET" class="flex items-center space-x-2">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="p-2 border rounded text-sm" required>
                <span class="text-theme-text">-</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="p-2 border rounded text-sm" required>
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded text-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            
            <button onclick="openAddModal()" class="flex items-center space-x-2 bg-[#3E2723] text-white px-4 py-2 rounded-lg hover:bg-[#2d1b18] transition shadow-lg transform active:scale-95 ml-auto">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Transaksi</span>
            </button>
        </div>

        <!-- KARTU STATISTIK -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Pemasukan</h3>
                <div class="text-3xl font-medium text-[#00E676]">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Pengeluaran</h3>
                <div class="text-3xl font-medium text-[#ef4444]">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Laba Bersih</h3>
                <div class="text-3xl font-medium text-[#00E676]">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- TABEL TRANSAKSI -->
        <div class="bg-white rounded-xl p-6 shadow-sm min-h-[500px]">
            <h2 class="text-2xl text-theme-text font-normal mb-6 border-b-2 border-theme-text pb-2">Daftar Transaksi</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transaksis as $t)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $t->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $t->tipe == 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($t->tipe) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $t->kategori }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $t->status == 'lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <button onclick="openEditModal({{ $t->id }}, '{{ $t->tanggal }}', '{{ $t->tipe }}', '{{ $t->kategori }}', '{{ $t->nominal }}', '{{ $t->status }}', '{{ $t->deskripsi }}')"
                                    class="text-indigo-600 hover:text-indigo-900"><i class="fa-solid fa-pen-to-square"></i> Edit</button>

                                <!-- FORM HAPUS DIPERBAIKI (Pastikan URL sesuai dengan routes/web.php) -->
                                <form action="{{ url('/admin/transaksi/' . $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH & EDIT (Sama seperti sebelumnya, gunakan url manual) -->
    <div id="modal-add" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Tambah Transaksi</h3>
            <form id="addForm" action="{{ url('/admin/transaksi/simpan') }}" method="POST" class="space-y-3">
                @csrf 
                <div><label class="text-xs font-semibold text-gray-500">Tanggal</label><input name="tanggal" type="date" class="w-full p-2 border rounded text-sm" required value="{{ date('Y-m-d') }}"></div>
                <div><label class="text-xs font-semibold text-gray-500">Tipe</label><select name="tipe" class="w-full p-2 border rounded bg-gray-50 text-sm"><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
                <div><label class="text-xs font-semibold text-gray-500">Kategori</label><input name="kategori" type="text" class="w-full p-2 border rounded text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Nominal</label><input name="nominal" type="number" class="w-full p-2 border rounded text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Status</label><select name="status" class="w-full p-2 border rounded bg-gray-50 text-sm"><option value="lunas">Lunas</option><option value="pending">Pending</option></select></div>
                <div><label class="text-xs font-semibold text-gray-500">Deskripsi</label><textarea name="deskripsi" rows="2" class="w-full p-2 border rounded text-sm"></textarea></div>
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeAddModal()" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm">Batal</button><button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18] text-sm">Simpan</button></div>
            </form>
        </div>
    </div>

    <div id="modal-edit" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl w-96 shadow-2xl modal-content">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Edit Transaksi</h3>
            <form id="editForm" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div><label class="text-xs font-semibold text-gray-500">Tanggal</label><input name="tanggal" id="edit-tanggal" type="date" class="w-full p-2 border rounded text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Tipe</label><select name="tipe" id="edit-tipe" class="w-full p-2 border rounded bg-gray-50 text-sm"><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
                <div><label class="text-xs font-semibold text-gray-500">Kategori</label><input name="kategori" id="edit-kategori" type="text" class="w-full p-2 border rounded text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Nominal</label><input name="nominal" id="edit-nominal" type="number" class="w-full p-2 border rounded text-sm" required></div>
                <div><label class="text-xs font-semibold text-gray-500">Status</label><select name="status" id="edit-status" class="w-full p-2 border rounded bg-gray-50 text-sm"><option value="lunas">Lunas</option><option value="pending">Pending</option></select></div>
                <div><label class="text-xs font-semibold text-gray-500">Deskripsi</label><textarea name="deskripsi" id="edit-deskripsi" rows="2" class="w-full p-2 border rounded text-sm"></textarea></div>
                <div class="flex gap-2 pt-4"><button type="button" onclick="closeEditModal()" class="flex-1 py-2 border rounded hover:bg-gray-100 text-sm">Batal</button><button type="submit" class="flex-1 py-2 bg-indigo-600 text-white rounded text-sm">Update</button></div>
            </form>
        </div>
    </div>

    <script>
        function formatDate(dateString) {
            const date = new Date(dateString);
            return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
        }
        function openAddModal() { document.getElementById('addForm').reset(); document.getElementById('modal-add').classList.remove('hidden'); }
        function closeAddModal() { document.getElementById('modal-add').classList.add('hidden'); }
        function openEditModal(id, tanggal, tipe, kategori, nominal, status, deskripsi) {
            const form = document.getElementById('editForm');
            form.action = '/admin/transaksi/' + id; // URL MANUAL
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-tanggal').value = formatDate(tanggal);
            document.getElementById('edit-tipe').value = tipe;
            document.getElementById('edit-kategori').value = kategori;
            document.getElementById('edit-nominal').value = nominal;
            document.getElementById('edit-status').value = status;
            document.getElementById('edit-deskripsi').value = deskripsi === 'null' ? '' : deskripsi;
            document.getElementById('modal-edit').classList.remove('hidden');
        }
        function closeEditModal() { document.getElementById('modal-edit').classList.add('hidden'); }
        document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});
    </script>
</body>
</html>