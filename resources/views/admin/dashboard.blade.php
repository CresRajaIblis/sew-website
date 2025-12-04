<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script> 
        tailwind.config = { theme: { extend: { colors: { 'theme-bg': '#ffbaba', 'theme-dark': '#3E2723', 'theme-text': '#5D4037', 'btn-primary': '#4E342E' } } } } 
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); transition: 0.3s; }
    </style>
</head>
<body class="flex h-screen overflow-hidden bg-theme-bg font-sans">

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

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl text-theme-text font-normal">Dashboard Admin</h1>
            <p class="text-sm font-medium text-black" id="current-date"></p>
        </div>

        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm card-hover">
                <h3 class="text-black text-lg">Orderan Selesai</h3>
                <div class="text-3xl font-medium text-[#00E676]">{{ $pesananSelesai }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm card-hover">
                <h3 class="text-black text-lg">Orderan Diproses</h3>
                <div class="text-3xl font-medium text-[#FFA000]">{{ $pesananDiproses }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm card-hover">
                <h3 class="text-black text-lg">Total Pendapatan</h3>
                <div class="text-3xl font-medium text-[#00E676]">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-3xl p-6 h-32 flex flex-col justify-between shadow-sm card-hover">
                <h3 class="text-black text-lg">Rating</h3>
                <div class="text-3xl font-medium text-[#FFA000]"><i class="fa-solid fa-star text-2xl mr-2"></i>{{ $rating }}</div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="col-span-2 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Grafik Pendapatan (7 Hari Terakhir)</h2>
                <div class="relative h-72 w-full"> 
                    <canvas id="pendapatanChart"></canvas>
                </div>
            </div>

            <div class="col-span-1 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Pesanan Populer</h2>
                <div class="space-y-3">
                    @forelse($topPesanan as $item)
                        <div class="p-3 bg-gray-50 rounded-lg flex items-center justify-between border-l-4 border-yellow-400">
                            <span class="text-theme-dark font-medium truncate w-2/3" title="{{ $item->nama_produk }}">
                                <i class="fa-solid fa-crown text-yellow-500 mr-2"></i> {{ $item->nama_produk }}
                            </span>
                            <span class="text-xs font-bold text-gray-500 bg-white px-2 py-1 rounded shadow-sm">
                                {{ $item->total_terjual }}x Terjual
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada pesanan.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">10 Pesanan Terakhir</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kode</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Harga</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pesananTerakhir as $pesanan)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm font-bold text-theme-dark">{{ $pesanan->kode_pesanan }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $pesanan->nama_pemesan }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    @if($pesanan->detail && $pesanan->detail->count() > 0)
                                        <span class="font-medium">{{ $pesanan->detail->first()->nama_produk }}</span>
                                        @if($pesanan->detail->count() > 1)
                                            <span class="text-xs text-gray-400">(+{{ $pesanan->detail->count() - 1 }})</span>
                                        @endif
                                    @else
                                        <span class="text-red-400 text-xs">Detail kosong</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-bold text-[#00E676]">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-bold rounded-full 
                                        {{ $pesanan->status == 'selesai' ? 'bg-green-100 text-green-800' : 
                                          ($pesanan->status == 'diproses' ? 'bg-yellow-100 text-yellow-800' : 
                                          ($pesanan->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ ucfirst($pesanan->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-span-1 bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-xl text-theme-text font-normal mb-4">Status Mesin</h2>
                <div class="space-y-4">
                    @foreach($statusMesin as $mesin)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">{{ $mesin['nama'] }}</span>
                            <div class="px-3 py-1 rounded text-xs text-white font-bold uppercase" style="background-color: {{ $mesin['warna'] }}">
                                {{ $mesin['status'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'});

            const labels = @json($labelHari);
            const data = @json($pendapatanHarian);

            const ctx = document.getElementById('pendapatanChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data,
                        backgroundColor: '#00E676', 
                        borderColor: '#3E2723', 
                        borderWidth: 1,
                        borderRadius: 5,
                        barPercentage: 0.6,
                        maxBarThickness: 50 // MENCEGAH BATANG JADI RAKSASA JIKA DATA SEDIKIT
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // WAJIB AGAR IKUT UKURAN CONTAINER
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [2, 2] },
                            ticks: {
                                // MENCEGAH ANGKA SUMBU Y TERLALU LEBAR DAN MENGGESER GRAFIK
                                callback: function(value) {
                                    if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + ' Jt';
                                    if (value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + ' Rb';
                                    return 'Rp ' + value;
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>