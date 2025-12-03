<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Pesanan Pegawai</title>
<style>
 /* --- CSS DARI FILE dppesanan.html KAMU (SAYA PERTAHANKAN) --- */
 *, *::before, *::after { box-sizing: border-box; }

 body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #b1a6f7 0%, #9b8ef5 100%);
  color: #4e4a80;
  display: flex;
  height: 100vh;
  overflow: hidden;
 }

 /* Animasi */
 @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
 @keyframes slideInLeft { from { transform: translateX(-100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
 @keyframes slideInMenu { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
 @keyframes slideInRight { from { opacity: 0; transform: translateX(30px); } to { opacity: 1; transform: translateX(0); } }
 @keyframes cardPopUp { from { opacity: 0; transform: scale(0.8) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
 @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
 @keyframes orderItemFadeIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
 @keyframes fadeInModal { from { opacity: 0; } to { opacity: 1; } }
 @keyframes modalPopUp { from { transform: scale(0.8) translateY(-20px); opacity: 0; } to { transform: scale(1) translateY(0); opacity: 1; } }

 /* Sidebar */
 nav.sidebar {
  background-color: #423c73;
  width: 220px;
  padding: 30px 20px;
  display: flex;
  flex-direction: column;
  color: #ddd;
  font-weight: 500;
  animation: slideInLeft 0.6s ease-out;
  z-index: 10;
 }
 nav.sidebar .greeting { margin-bottom: 50px; font-size: 18px; animation: fadeIn 1s ease-out 0.3s backwards; }
 nav.sidebar a {
  color: #c8c2e7; text-decoration: none; margin-bottom: 30px; display: flex; align-items: center; font-size: 18px; cursor: pointer; transition: all 0.3s ease; padding: 8px 12px; border-radius: 8px; animation: slideInMenu 0.5s ease-out backwards;
 }
 nav.sidebar a:hover, nav.sidebar a.active { color: white; font-weight: 700; background-color: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
 nav.sidebar a svg { margin-right: 12px; fill: currentColor; width: 20px; height: 20px; flex-shrink: 0; transition: transform 0.3s ease; }
 
 nav.sidebar .account { margin-top: auto; font-size: 14px; display: flex; align-items: center; justify-content: space-between; color: #a39dcc; animation: fadeIn 1s ease-out 0.6s backwards; }
 nav.sidebar .logout { display: flex; align-items: center; cursor: pointer; color: #a39dcc; font-size: 14px; text-decoration: none; transition: all 0.3s ease; padding: 6px 10px; border-radius: 8px; background: none; border: none; }
 nav.sidebar .logout:hover { color: white; background-color: rgba(238, 108, 108, 0.2); }

 /* Content */
 main.content { flex-grow: 1; padding: 30px 40px 40px 40px; overflow-y: auto; display: flex; flex-direction: column; position: relative; z-index: 5; }
 .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; font-size: 22px; font-weight: 600; color: #4e4a80; }
 
 /* Cards */
 .info-cards { display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
 .card { background: white; border-radius: 14px; box-shadow: 0 3px 8px rgb(0 0 0 / 0.15); padding: 20px 25px; width: 220px; display: flex; flex-direction: column; transition: all 0.3s ease; cursor: pointer; animation: cardPopUp 0.6s ease-out backwards; }
 .card:hover { transform: translateY(-8px) scale(1.03); box-shadow: 0 8px 20px rgba(0,0,0,0.2); }
 .card p.title { margin: 0 0 8px 0; font-weight: 600; font-size: 16px; color: #222; }
 .card p.number { margin: 0; font-size: 28px; font-weight: 700; transition: transform 0.3s ease; }
 .card.green .number { color: #22863a; }
 .card.orange .number { color: #d68622; }

 /* Sections */
 .pending-section, .working-section { background: white; border-radius: 12px; padding: 25px 25px 35px 25px; box-shadow: 0 3px 10px rgb(0 0 0 / 0.1); margin-bottom: 25px; animation: fadeInUp 0.8s ease-out 1s backwards; }
 .section-header { margin: 0 0 20px 0; color: #4e4a80; font-weight: 600; font-size: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }

 /* Order Items */
 .order-item { border: 1.5px solid #e0e0e0; border-radius: 10px; padding: 16px 20px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s ease; animation: orderItemFadeIn 0.5s ease-out forwards; background: #fff; }
 .order-item:hover { transform: scale(1.01); box-shadow: 0 4px 12px rgba(0,0,0,0.1); background-color: #f8f9fa; border-color: #d0d0d0; }
 
 .order-detail { display: flex; gap: 48px; }
 .order-left { max-width: 200px; }
 .order-left strong { font-weight: 600; font-size: 16px; display: block; margin-bottom: 4px; color: #222; }
 .order-left span { font-size: 13px; color: #666; line-height: 1.4; display: block; }
 .order-right { max-width: 280px; }
 .order-right span { font-size: 13px; color: #666; display: block; line-height: 1.3; margin-bottom: 3px; }

 /* Buttons */
 button.btn-ambil { background: #2323e6; color: white; padding: 8px 38px; font-weight: 500; font-size: 16px; border-radius: 25px; border: none; cursor: pointer; transition: all 0.3s ease; }
 button.btn-ambil:hover { background: #15159b; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(35, 35, 230, 0.4); }

 /* Tombol Selesai (Style Baru agar beda) */
 button.btn-selesai { background: #10b981; color: white; padding: 8px 38px; font-weight: 500; font-size: 16px; border-radius: 25px; border: none; cursor: pointer; transition: all 0.3s ease; }
 button.btn-selesai:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4); }

 /* Alert Sukses */
 .alert-success { background: #d1fae5; color: #065f46; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #10b981; display: flex; align-items: center; animation: fadeIn 0.5s ease; }
 .alert-success svg { width: 20px; height: 20px; margin-right: 10px; fill: currentColor; }

 /* Scrollbar */
 main.content::-webkit-scrollbar { width: 10px; }
 main.content::-webkit-scrollbar-thumb { background: #6b64b1; border-radius: 10px; }
 main.content::-webkit-scrollbar-track { background: #dad6fb; }

 /* Modal Logout */
 .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 10000; animation: fadeInModal 0.3s ease-out; }
 .modal-overlay.active { display: flex; justify-content: center; align-items: center; }
 .modal-box { background: white; padding: 30px 40px; border-radius: 14px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); text-align: center; min-width: 350px; animation: modalPopUp 0.3s ease-out; }
 .modal-buttons { display: flex; gap: 15px; justify-content: center; margin-top: 20px;}
 .btn-cancel { background-color: #dcdcdc; color: #3f2d2d; padding: 10px 20px; border:none; border-radius: 8px; cursor: pointer;}
 .btn-confirm { background-color: #ee6c6c; color: white; padding: 10px 20px; border:none; border-radius: 8px; cursor: pointer;}
 
 @media (max-width: 900px) {
  body { flex-direction: column; height: auto; }
  nav.sidebar { width: 100%; display: flex; overflow-x: auto; padding: 10px 20px; white-space: nowrap; gap: 20px; }
  main.content { padding: 20px; }
  .order-detail { flex-direction: column; gap: 10px; }
  .order-item { flex-direction: column; align-items: flex-start; gap: 15px; }
  button { width: 100%; }
 }
</style>
</head>
<body>

 <!-- SIDEBAR -->
 <nav class="sidebar">
  <div class="greeting">Hello Pegawai</div>
  
  <!-- Link Dashboard (Aktif) -->
  <a href="{{ route('pegawai.dashboard') }}" class="active">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0-4h2V7H3v2zm0 8h2v-2H3v2zm4-8h14V7H7v2zm0 4h14v-2H7v2zm0 4h14v-2H7v2z"/></svg>
   Pesanan
  </a>

  <!-- Link Ulasan -->
  <a href="{{ route('pegawai.ulasan') }}">
   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm.93 4.412a.5.5 0 0 1 .91.417l-1 3a.5.5 0 0 1-.91.083l-1.5-2a.5.5 0 1 1 .8-.6l.457.61 1.243-1.51z"/>
   </svg>
   Ulasan
  </a>

  <div class="account">
   <span>{{ Auth::user()->username }}.acc</span>
   <!-- Tombol Logout memicu Modal -->
   <button class="logout" id="logoutBtn" title="Log Out">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273l-96 96c-9 9-24 3-24-10v-59H192v-32h185v-59c0-13 15-19 24-10l96 96c9 9 9 24 0 33zM288 432H96c-18 0-32-14-32-32v-256c0-18 14-32 32-32h192c8 0 15-7 15-15s-7-15-15-15H96c-40 0-72 32-72 72v256c0 40 32 72 72 72h192c8 0 15-7 15-15s-7-15-15-15z"/></svg>
    Log Out
   </button>
  </div>
 </nav>

 <!-- KONTEN UTAMA -->
 <main class="content">
  
  <!-- Header -->
  <div class="header-top">
   <div>Selamat Datang, {{ Auth::user()->name }}</div>
   <div>{{ now()->translatedFormat('l, d F Y') }}</div>
  </div>

  <!-- PESAN SUKSES (Notifikasi dari Laravel) -->
  @if(session('sukses'))
  <div class="alert-success">
    <svg viewBox="0 0 20 20"><path d="M9.8 14.1a.9.9 0 0 1-.64-.26l-2.8-2.8a.5.5 0 1 1 .7-.7l2.14 2.14 5.37-6.32a.5.5 0 0 1 .77.63l-6.29 7.39a.9.9 0 0 1-.65.32"/></svg>
    <span>{{ session('sukses') }}</span>
  </div>
  @endif

  <!-- KARTU STATISTIK -->
  <div class="info-cards">
   <div class="card green">
    <p class="title">Total Pesanan Usaha</p>
    <p class="number">{{ $totalPesananUsaha }}</p>
   </div>
   <div class="card orange">
    <p class="title">Dalam Proses</p>
    <p class="number">{{ $dalamProses }}</p>
   </div>
   <div class="card green">
    <p class="title">Hasil Jahit Anda</p>
    <p class="number">{{ $hasilJahitAnda }}</p>
   </div>
  </div>

  <!-- 1. DAFTAR PESANAN PENDING (SIAP DIAMBIL) -->
  <section class="pending-section">
   <h2 class="section-header">Daftar Pesanan Pending</h2>

   @forelse($daftarPesanan->where('status', 'pending') as $p) <!-- FIX: Filter dari $daftarPesanan -->
   <div class="order-item">
    <div class="order-detail">
     <div class="order-left">
                <!-- Data Pesanan Baru -->
      <strong>Pesanan #{{ $p->nomor_antrian }}</strong>
      <span>Kode: {{ $p->kode_pesanan }}</span>
      <span>Pelanggan: {{ $p->nama_pemesan }}</span>
      <span style="color: #ef4444; font-weight:bold;">Total Harga: Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
     </div>
     <div class="order-right">
                <!-- Tampilkan Detail Produk Pertama Saja (Jika Ada) -->
                @if($p->detail->isNotEmpty())
                    <span>Produk: {{ $p->detail->first()->nama_produk }}</span>
                    <span>Warna: {{ $p->detail->first()->warna }} ({{ $p->detail->first()->ukuran }})</span>
                    <span>Jumlah: {{ $p->detail->first()->jumlah }} pcs</span>
                @else
                    <span>Rincian Produk: Tidak Tersedia (Input Manual)</span>
                @endif
     </div>
    </div>
    
    <!-- FORM TOMBOL AMBIL -->
    <form action="{{ route('pegawai.pesanan.ambil', $p->id) }}" method="POST">
      @csrf
      <button type="submit" class="btn-ambil">Ambil</button>
    </form>
   </div>
   @empty
    <p style="text-align: center; color: #888;">Tidak ada pesanan pending saat ini.</p>
   @endforelse
  </section>

  <!-- 2. DAFTAR TUGAS SAYA (SEDANG DIKERJAKAN) -->
  <section class="working-section">
   <h2 class="section-header">Sedang Anda Kerjakan</h2>

   @forelse($daftarPesanan->where('status', 'diproses') as $t) <!-- FIX: Filter dari $daftarPesanan -->
   <div class="order-item" style="border-left: 5px solid #d68622;">
    <div class="order-detail">
     <div class="order-left">
                <!-- Data Pesanan Baru -->
      <strong>Pesanan #{{ $t->nomor_antrian }}</strong>
      <span>Kode: {{ $t->kode_pesanan }}</span>
      <span>Pelanggan: {{ $t->nama_pemesan }}</span>
      <span style="color: #d68622; font-weight:bold;">Total Harga: Rp {{ number_format($t->total_harga, 0, ',', '.') }}</span>
     </div>
     <div class="order-right">
                <!-- Tampilkan Detail Produk Pertama Saja (Jika Ada) -->
                @if($t->detail->isNotEmpty())
                    <span>Produk: {{ $t->detail->first()->nama_produk }}</span>
                    <span>Warna: {{ $t->detail->first()->warna }} ({{ $t->detail->first()->ukuran }})</span>
                    <span>Jumlah: {{ $t->detail->first()->jumlah }} pcs</span>
                @else
                    <span>Rincian Produk: Tidak Tersedia (Input Manual)</span>
                @endif
     </div>
    </div>
    
    <!-- FORM TOMBOL SELESAI -->
    <form action="{{ route('pegawai.pesanan.selesai', $t->id) }}" method="POST">
      @csrf
      <button type="submit" class="btn-selesai">Selesai</button>
    </form>
   </div>
   @empty
    <p style="text-align: center; color: #888;">Anda sedang tidak mengerjakan pesanan apapun.</p>
   @endforelse
  </section>

 </main>

 <!-- MODAL LOGOUT -->
 <div class="modal-overlay" id="logoutModal">
  <div class="modal-box">
   <h3>Konfirmasi Logout</h3>
   <p>Apakah Anda yakin ingin keluar dari dashboard?</p>
   <div class="modal-buttons">
    <button class="btn-cancel" id="cancelLogoutBtn">Batal</button>
    
    <!-- Form Logout Asli Laravel -->
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-confirm">Ya, Keluar</button>
    </form>
   </div>
   </div>
 </div>

 <!-- SCRIPT JAVASCRIPT UNTUK MODAL -->
 <script>
  const logoutBtn = document.getElementById('logoutBtn');
  const logoutModal = document.getElementById('logoutModal');
  const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');

  // Buka Modal saat klik Logout
  logoutBtn.addEventListener('click', function(e) {
   e.preventDefault();
   logoutModal.classList.add('active');
  });

  // Tutup Modal saat klik Batal
  cancelLogoutBtn.addEventListener('click', function() {
   logoutModal.classList.remove('active');
  });

  // Tutup Modal saat klik di luar kotak
  logoutModal.addEventListener('click', function(e) {
   if (e.target === logoutModal) {
    logoutModal.classList.remove('active');
   }
  });
 </script>

</body>
</html>