<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js untuk grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .card { transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-theme-dark text-white flex flex-col justify-between flex-shrink-0 z-20">
        <div class="p-6">
            <h1 class="text-xl font-normal mb-12 tracking-wide pl-2">Hello Admin!</h1>
            <nav class="space-y-4 pl-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4 text-white font-medium scale-105 origin-left transition-all active"><div class="w-6 text-center"><i class="fa-solid fa-table-columns text-lg"></i></div><span>Dashboard</span></a>
                <a href="{{ route('admin.keuangan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-sack-dollar text-lg"></i></div><span>Keuangan</span></a>
                <a href="{{ route('admin.akun') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-user text-lg"></i></div><span>Akun</span></a>
                <a href="{{ route('admin.pesanan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-file-invoice text-lg"></i></div><span>Pesanan</span></a>
                <a href="{{ route('admin.ulasan') }}" class="flex items-center space-x-4 text-gray-400 hover:text-white transition-all"><div class="w-6 text-center"><i class="fa-solid fa-comments text-lg"></i></div><span>Ulasan</span></a>
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
            <h1 class="text-3xl text-theme-text font-normal">Dashboard Admin</h1>
            <p class="text-sm font-medium text-black" id="current-date"></p>
        </div>

        <!-- KARTU STATISTIK (4 Kartu) -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="card bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Orderan Selesai</h3>
                <div class="text-3xl font-medium text-[#00E676]">{{ $pesananSelesai }}</div>
            </div>
            <div class="card bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Orderan Diproses</h3>
                <div class="text-3xl font-medium text-[#FFA000]">{{ $pesananDiproses }}</div>
            </div>
            <div class="card bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Total Pendapatan</h3>
                <div class="text-3xl font-medium text-[#00E676]">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="card bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm">
                <h3 class="text-black text-lg">Rating</h3>
                <div class="text-3xl font-medium text-[#FFA000]"><i class="fa-solid fa-star text-2xl mr-2"></i>{{ $rating }}</div>
            </div>
        </div>

        <!-- GRAFIK & PESANAN POPULER -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <!-- Kolom 1: Grafik Pendapatan -->
            <div class="col-span-2 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Grafik Pendapatan (7 Hari Terakhir)</h2>
                <canvas id="pendapatanChart" height="150"></canvas>
            </div>

            <!-- Kolom 2: Pesanan Populer -->
            <div class="col-span-1 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Pesanan Populer (TOP 3)</h2>
                <div class="space-y-3">
                    @forelse($topPesanan as $item)
                        <div class="p-3 bg-gray-50 rounded-lg flex items-center justify-between">
                            <span class="text-theme-dark font-medium"><i class="fa-solid fa-star text-yellow-500 mr-2"></i> {{ $item->jenis_pakaian }}</span>
                            <span class="text-sm text-gray-500">{{ $item->total }} pesanan</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Belum ada pesanan populer.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- 10 PESANAN TERAKHIR & STATUS MESIN -->
        <div class="grid grid-cols-3 gap-6">
            <!-- Kolom 1-2: 10 Pesanan Terakhir -->
            <div class="col-span-2 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">10 Pesanan Terakhir</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pesananTerakhir as $pesanan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->nama_pelanggan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pesanan->jenis_pakaian }} - {{ $pesanan->ukuran }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kolom 3: Status Mesin Jahit -->
            <div class="col-span-1 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Status Mesin Jahit</h2>
                <div class="space-y-4">
                    @foreach($statusMesin as $mesin)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">{{ $mesin['nama'] }}</span>
                            <div class="h-4 w-1/2 rounded-full" style="background-color: {{ $mesin['warna'] }}"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});

            // Data dari Controller
            const labels = @json($labelHari);
            const data = @json($pendapatanHarian);

            // Inisialisasi Chart.js
            const ctx = document.getElementById('pendapatanChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data,
                        backgroundColor: '#24cf32ff', // Warna cokelat tema
                        borderColor: '#3E2723',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            // Fungsi untuk format mata uang di sumbu Y
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>