<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script> tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        #modal-add:not(.hidden), #modal-edit:not(.hidden) { display: flex; opacity: 1; }
        .sidebar a.active { background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #fff; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20 shadow-xl">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2 border-b border-gray-600 pb-4">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ url('/admin/keuangan') }}" class="flex items-center space-x-4 text-white font-medium scale-105 origin-left transition-all active p-2 rounded"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ url('/admin/akun') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all p-2 rounded hover:bg-white/5"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
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

    <main class="flex-1 p-8 overflow-y-auto relative">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl text-theme-text font-normal">Keuangan</h1>
            <p class="text-sm font-medium text-theme-text bg-white/50 px-4 py-2 rounded-full shadow-sm" id="current-date"></p>
        </div>

        @if(session('success')) <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 fade-in"><i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}</div> @endif
        @if(session('error')) <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 fade-in"><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ session('error') }}</div> @endif

        <div class="bg-white p-4 rounded-xl shadow-sm flex flex-wrap items-center gap-4 mb-6">
            <div class="flex space-x-2">
                <a href="{{ url('/admin/keuangan') }}?filter=bulanan" class="px-3 py-1 rounded-full text-sm {{ request('filter') == 'bulanan' || !request('filter') ? 'bg-theme-dark text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Bulanan</a>
                <a href="{{ url('/admin/keuangan') }}?filter=mingguan" class="px-3 py-1 rounded-full text-sm {{ request('filter') == 'mingguan' ? 'bg-theme-dark text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Mingguan</a>
                <a href="{{ url('/admin/keuangan') }}?filter=harian" class="px-3 py-1 rounded-full text-sm {{ request('filter') == 'harian' ? 'bg-theme-dark text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Harian</a>
                <a href="{{ url('/admin/keuangan') }}?filter=semua" class="px-3 py-1 rounded-full text-sm {{ request('filter') == 'semua' ? 'bg-theme-dark text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Semua</a>
            </div>
            <div class="flex-grow"></div>
            <form action="{{ url('/admin/keuangan') }}" method="GET" class="flex items-center space-x-2 bg-gray-50 p-1 rounded-lg border">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="p-1.5 bg-transparent text-sm outline-none" required>
                <span class="text-gray-400">-</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="p-1.5 bg-transparent text-sm outline-none" required>
                <button type="submit" class="bg-theme-dark text-white p-2 rounded hover:bg-theme-text transition"><i class="fa-solid fa-magnifying-glass text-xs"></i></button>
            </form>
            <button onclick="openAddModal()" class="flex items-center space-x-2 bg-[#3E2723] text-white px-5 py-2.5 rounded-lg hover:bg-[#2d1b18] transition shadow-md"><i class="fa-solid fa-plus"></i><span>Tambah</span></button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm border-l-4 border-[#00E676]">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Pemasukan</h3>
                <div class="text-2xl font-bold text-gray-800 mt-4">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm border-l-4 border-[#ef4444]">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Pengeluaran</h3>
                <div class="text-2xl font-bold text-gray-800 mt-4">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-2xl p-6 flex flex-col justify-between shadow-sm border-l-4 border-blue-500">
                <h3 class="text-gray-500 text-sm font-semibold uppercase">Laba Bersih</h3>
                <div class="text-2xl font-bold {{ $labaBersih >= 0 ? 'text-gray-800' : 'text-red-600' }}">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100"><h2 class="text-xl font-bold text-theme-text">Daftar Transaksi</h2></div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nominal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transaksis as $t)
                        <tr class="hover:bg-orange-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ date('d M Y', strtotime($t->tanggal)) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $t->tipe == 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($t->tipe) }}</span></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $t->kategori }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $t->status == 'lunas' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">{{ ucfirst($t->status) }}</span></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-3">
        
                                    <button 
                                    type="button"
                                    onclick="openEditModal(this)"
                                    data-kode="{{ $t->kode }}" 
                                    data-tanggal="{{ $t->tanggal }}"
                                    data-tipe="{{ $t->tipe }}"
                                    data-kategori="{{ $t->kategori }}"
                                    data-nominal="{{ $t->nominal }}"
                                    data-status="{{ $t->status }}"
                                    data-deskripsi="{{ $t->deskripsi }}"
                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded-lg hover:bg-indigo-100 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

        <form action="{{ url('/admin/transaksi/hapus/' . $t->kode) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi {{ $t->kode }}?');">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg hover:bg-red-100 transition">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>

    </div>
</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50">Belum ada data transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="modal-add" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-[450px] shadow-2xl p-6">
            <h3 class="text-xl font-bold mb-4 text-theme-dark">Tambah Transaksi</h3>
            <form id="addForm" action="{{ url('/admin/transaksi/simpan') }}" method="POST" class="space-y-4">
                @csrf 
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-xs font-bold mb-1">Tanggal</label><input name="tanggal" type="date" class="w-full p-2 border rounded" required value="{{ date('Y-m-d') }}"></div>
                    <div><label class="block text-xs font-bold mb-1">Tipe</label><select name="tipe" class="w-full p-2 border rounded"><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
                </div>
                <div><label class="block text-xs font-bold mb-1">Kategori</label><input name="kategori" type="text" class="w-full p-2 border rounded" required></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-xs font-bold mb-1">Nominal</label><input name="nominal" type="number" class="w-full p-2 border rounded" required></div>
                    <div><label class="block text-xs font-bold mb-1">Status</label><select name="status" class="w-full p-2 border rounded"><option value="lunas">Lunas</option><option value="pending">Pending</option></select></div>
                </div>
                <div><label class="block text-xs font-bold mb-1">Deskripsi</label><textarea name="deskripsi" rows="2" class="w-full p-2 border rounded"></textarea></div>
                <div class="flex gap-2 pt-2">
                    <button type="button" onclick="closeAddModal()" class="flex-1 py-2 border rounded hover:bg-gray-100">Batal</button>
                    <button type="submit" class="flex-1 py-2 bg-theme-dark text-white rounded hover:bg-[#2d1b18]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-edit" class="fixed inset-0 bg-black/60 hidden flex items-center justify-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-[450px] shadow-2xl p-6">
        <h3 class="text-xl font-bold mb-4 text-theme-dark">Edit Transaksi</h3>
        
        <form id="editForm" action="{{ url('/admin/transaksi/update') }}" method="POST" class="space-y-4">
            @csrf 
            
            <input type="hidden" name="kode" id="edit-kode">

            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-xs font-bold mb-1">Tanggal</label><input name="tanggal" id="edit-tanggal" type="date" class="w-full p-2 border rounded" required></div>
                <div><label class="block text-xs font-bold mb-1">Tipe</label><select name="tipe" id="edit-tipe" class="w-full p-2 border rounded"><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
            </div>
            <div><label class="block text-xs font-bold mb-1">Kategori</label><input name="kategori" id="edit-kategori" type="text" class="w-full p-2 border rounded" required></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-xs font-bold mb-1">Nominal</label><input name="nominal" id="edit-nominal" type="number" class="w-full p-2 border rounded" required></div>
                <div><label class="block text-xs font-bold mb-1">Status</label><select name="status" id="edit-status" class="w-full p-2 border rounded"><option value="lunas">Lunas</option><option value="pending">Pending</option></select></div>
            </div>
            <div><label class="block text-xs font-bold mb-1">Deskripsi</label><textarea name="deskripsi" id="edit-deskripsi" rows="2" class="w-full p-2 border rounded"></textarea></div>
            
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-2 border rounded hover:bg-gray-100">Batal</button>
                <button type="submit" class="flex-1 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</div>

    <script>
        function formatDate(dateString) {
            if(!dateString) return '';
            // Ambil bagian tanggal saja (YYYY-MM-DD)
            return dateString.split(' ')[0];
        }

        function openAddModal() { document.getElementById('addForm').reset(); document.getElementById('modal-add').classList.remove('hidden'); }
        function closeAddModal() { document.getElementById('modal-add').classList.add('hidden'); }
        function closeEditModal() { document.getElementById('modal-edit').classList.add('hidden'); }
        
        function openEditModal(button) {
    // 1. Ambil data dari tombol
    const kode = button.getAttribute('data-kode');
// DEBUG: Cek apakah ID terbaca
    if (!kode || kode === "") {
        alert("Error: kode Transaksi Kosong! Cek kode Blade data-id.");
        return; // Stop proses jika ID kosong
    }

    const inputKode = document.getElementById('edit-kode');
    if (inputKode) {
        inputKode.value = kode;
    } else {
        alert("Error: Input Hidden 'edit-kode' tidak ditemukan di Form!");
        return;
    }

    const tanggal = button.getAttribute('data-tanggal');
    const tipe = button.getAttribute('data-tipe');
    const kategori = button.getAttribute('data-kategori');
    const nominal = button.getAttribute('data-nominal');
    const status = button.getAttribute('data-status');
    const deskripsi = button.getAttribute('data-deskripsi');

    // 2. Masukkan ID ke input tersembunyi
    document.getElementById('edit-kode').value = kode;

    // 3. Masukkan data lain ke input biasa
    // Format tanggal dipotong agar pas dengan input type="date"
    document.getElementById('edit-tanggal').value = tanggal ? tanggal.split(' ')[0] : '';
    document.getElementById('edit-tipe').value = tipe;
    document.getElementById('edit-kategori').value = kategori;
    document.getElementById('edit-nominal').value = nominal;
    document.getElementById('edit-status').value = status;
    document.getElementById('edit-deskripsi').value = (deskripsi && deskripsi !== 'null') ? deskripsi : '';

    // 4. Tampilkan Modal
    document.getElementById('modal-edit').classList.remove('hidden');
}

        function closeEditModal() { document.getElementById('modal-edit').classList.add('hidden'); }
        document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});
    </script>
</body>
</html>