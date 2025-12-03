<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Dashboard Ulasan Pegawai</title>
<style>
  /* [SEMUA CSS DARI DPUALASAN.HTML DIMASUKKAN DI SINI (TIDAK DITAMPILKAN UNTUK KERINGKASAN)] */
  /* Reset dan dasar */
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #b3a9ff 0%, #9b8ef5 100%);
    color: #4e4a80;
    display: flex;
    height: 100vh;
    overflow: hidden;
  }

  /* Animasi dasar */
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes slideInLeft {
    from { transform: translateX(-100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }

  @keyframes slideInMenu {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes cardPopUp {
    from { opacity: 0; transform: scale(0.8) translateY(20px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes reviewItemFadeIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes modalPopUp {
    from { transform: scale(0.8) translateY(-20px); opacity: 0; }
    to { transform: scale(1) translateY(0); opacity: 1; }
  }

  @keyframes starPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }

  /* Sidebar kiri */
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

  nav.sidebar .greeting {
    margin-bottom: 50px;
    font-size: 18px;
    animation: fadeIn 1s ease-out 0.3s backwards;
  }

  nav.sidebar a {
    color: #c8c2e7;
    text-decoration: none;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 8px 12px;
    border-radius: 8px;
    animation: slideInMenu 0.5s ease-out backwards;
  }

  nav.sidebar a:nth-child(2) { animation-delay: 0.4s; }
  nav.sidebar a:nth-child(3) { animation-delay: 0.5s; }

  nav.sidebar a:hover,
  nav.sidebar a.active {
    color: white;
    font-weight: 700;
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
  }

  nav.sidebar a svg {
    margin-right: 12px;
    fill: currentColor;
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    transition: transform 0.3s ease;
  }

  nav.sidebar a:hover svg {
    transform: scale(1.15) rotate(5deg);
  }

  nav.sidebar .account {
    margin-top: auto;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #a39dcc;
    animation: fadeIn 1s ease-out 0.6s backwards;
  }

  nav.sidebar .logout {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #a39dcc;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 6px 10px;
    border-radius: 8px;
  }

  nav.sidebar .logout svg {
    width: 18px;
    height: 18px;
    margin-right: 6px;
    fill: currentColor;
    transition: transform 0.3s ease;
  }

  nav.sidebar .logout:hover {
    color: white;
    background-color: rgba(238, 108, 108, 0.2);
  }

  nav.sidebar .logout:hover svg {
    transform: translateX(3px);
  }

  /* Konten utama */
  main.content {
    flex-grow: 1;
    padding: 30px 40px 40px 40px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 5;
  }

  /* Header atas */
  .header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
    color: #4e4a80;
  }

  .header-top > div:first-child {
    animation: slideInRight 0.6s ease-out 0.5s backwards;
  }

  .header-top > div:last-child {
    animation: slideInRight 0.6s ease-out 0.6s backwards;
  }

  /* Card statistik */
  .cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
  }

  .card {
    background: white;
    border-radius: 14px;
    padding: 20px 25px;
    width: 130px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    cursor: pointer;
    animation: cardPopUp 0.6s ease-out backwards;
  }

  .card:nth-child(1) { animation-delay: 0.7s; }
  .card:nth-child(2) { animation-delay: 0.8s; }
  .card:nth-child(3) { animation-delay: 0.9s; }
  .card:nth-child(4) { animation-delay: 1s; }

  .card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  }

  .card p.title {
    margin: 0 0 12px 0;
    font-weight: 600;
    font-size: 16px;
    color: #222;
  }

  .card p.value {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    transition: transform 0.3s ease;
  }

  .card:hover p.value {
    transform: scale(1.1);
  }

  /* Warna nilai */
  .value.green {
    color: #22863a;
  }

  .value.purple {
    color: #423c73;
  }

  /* Daftar ulasan */
  .review-list {
    background: white;
    border-radius: 12px;
    padding: 20px 30px 30px 30px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    flex-grow: 1;
    animation: fadeInUp 0.8s ease-out 1.1s backwards;
  }

  .review-list h2 {
    margin: 0 0 20px 0;
    font-size: 20px;
    font-weight: 600;
    color: #423c73;
  }

  /* Item ulasan */
  .review-item {
    border: 1.5px solid #423c73;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 18px;
    transition: all 0.3s ease;
    opacity: 0;
    animation: reviewItemFadeIn 0.5s ease-out forwards;
  }

  .review-item:nth-child(2) { animation-delay: 1.3s; }
  .review-item:nth-child(3) { animation-delay: 1.4s; }

  .review-item:hover {
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    background-color: #fef5f5;
  }

  /* Profil & info ulasan */
  .review-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    gap: 14px;
  }

  .avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #c4c4c4, #e0e0e0);
    border-radius: 50%;
    flex-shrink: 0;
    transition: transform 0.3s ease;
  }

  .review-item:hover .avatar {
    transform: scale(1.1);
  }

  .reviewer-info {
    display: flex;
    flex-direction: column;
  }

  .reviewer-name {
    font-weight: 600;
    font-size: 16px;
    color: #222;
  }

  .order-info {
    font-size: 13px;
    color: #6e6a9f;
  }

  /* Rating bintang */
  .stars {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 3px;
  }

  .star {
    width: 20px;
    height: 20px;
    fill: #22863a;
    transition: transform 0.3s ease;
  }

  .review-item:hover .star {
    animation: starPulse 0.5s ease-in-out;
  }

  .star.empty {
    fill: #bbb;
  }

  /* Review teks */
  .review-text {
    font-size: 15px;
    color: #222;
    line-height: 1.5;
  }

  /* Scrollbar custom */
  main.content::-webkit-scrollbar {
    width: 10px;
  }

  main.content::-webkit-scrollbar-thumb {
    background: #6b64b1;
    border-radius: 10px;
  }

  main.content::-webkit-scrollbar-track {
    background: #dad6fb;
  }

  /* Modal Logout */
  .modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    animation: fadeInModal 0.3s ease-out;
  }

  .modal-overlay.active {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .modal-box {
    background: white;
    padding: 30px 40px;
    border-radius: 14px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    text-align: center;
    min-width: 350px;
    animation: modalPopUp 0.3s ease-out;
  }

  .modal-box h3 {
    margin-top: 0;
    color: #4c2f2f;
    font-size: 22px;
  }

  .modal-box p {
    color: #3f2d2d;
    font-size: 16px;
    margin-bottom: 25px;
  }

  .modal-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
  }

  .modal-buttons button {
    padding: 10px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .modal-buttons button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
  }

  .modal-buttons button:hover::before {
    width: 300px;
    height: 300px;
  }

  .btn-cancel {
    background-color: #dcdcdc;
    color: #3f2d2d;
  }

  .btn-cancel:hover {
    background-color: #c3bcbc;
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
  }

  .btn-confirm {
    background-color: #ee6c6c;
    color: white;
  }

  .btn-confirm:hover {
    background-color: #d64545;
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(238, 108, 108, 0.4);
  }

  .modal-buttons button:active {
    transform: scale(0.98);
  }

  /* Responsive */
  @media (max-width: 900px) {
    body {
      flex-direction: column;
      height: auto;
    }
    nav.sidebar {
      width: 100%;
      height: auto;
      display: flex;
      overflow-x: auto;
      padding: 10px 20px;
      white-space: nowrap;
      gap: 20px;
    }
    nav.sidebar a {
      margin-bottom: 0;
      font-size: 16px;
    }
    main.content {
      padding: 20px;
    }
    .cards {
      flex-wrap: wrap;
    }
    .card {
      width: 45%;
    }
  }
</style>
</head>
<body>

  <nav class="sidebar">
    <div class="greeting">Hello {{ Auth::user()->name ?? 'Pegawai' }}</div>
    <a href="{{ route('pegawai.dashboard') }}" class="menu-pesanan">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0-4h2V7H3v2zm0 8h2v-2H3v2zm4-8h14V7H7v2zm0 4h14v-2H7v2zm0 4h14v-2H7v2z"/></svg>
      Pesanan
    </a>
    <a href="{{ route('pegawai.ulasan') }}" class="active menu-ulasan">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 10h-4V6H7v4H3v2h4v4h6v-4h4v-2z"/></svg>
      Ulasan
    </a>
    <div class="account">
      <span>{{ Auth::user()->username ?? 'pegawai' }}.acc</span>
      <!-- Tombol Logout memicu Modal -->
      <button class="logout" id="logoutBtn" title="Log Out">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273l-96 96c-9 9-24 3-24-10v-59H192v-32h185v-59c0-13 15-19 24-10l96 96c9 9 9 24 0 33zM288 432H96c-18 0-32-14-32-32v-256c0-18 14-32 32-32h192c8 0 15-7 15-15s-7-15-15-15H96c-40 0-72 32-72 72v256c0 40 32 72 72 72h192c8 0 15-7 15-15s-7-15-15-15z"/></svg>
        Log Out
      </button>
    </div>
  </nav>

  <main class="content">
    <div class="header-top">
      <div>Ulasan</div>
      <!-- Tanggal Dinamis -->
      <div>{{ Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
    </div>

    <div class="cards">
      <div class="card">
        <p class="title">Total Ulasan</p>
        <p class="value green">{{ $totalUlasan }}</p>
      </div>
      <div class="card">
        <p class="title">Rating</p>
        <p class="value green">★ {{ number_format($avgRating, 1) }}</p>
      </div>
      <div class="card">
        <p class="title">Review Baik</p>
        <p class="value green">{{ $reviewBaik }}</p>
      </div>
      <div class="card">
        <p class="title">Review Buruk</p>
        <p class="value purple">{{ $reviewBuruk }}</p>
      </div>
    </div>

    <section class="review-list">
      <h2>Daftar Ulasan Pelanggan Jahit</h2>
      
      @forelse ($ulasans as $ulasan)
      <article class="review-item" style="animation-delay: {{ $loop->index * 0.1 + 1.2 }}s;">
        <div class="review-header">
          <div class="avatar" aria-label="Foto profil {{ $ulasan->nama_pengulas }}"></div>
          <div class="reviewer-info">
            <div class="reviewer-name">{{ $ulasan->nama_pengulas }}</div>
            <div class="order-info">
                Pesanan ZT-{{ $ulasan->pesanan->id ?? '???' }} - {{ $ulasan->jenis_pesanan }}
            </div>
          </div>
          <div class="stars" aria-label="{{ $ulasan->rating }} dari 5 bintang">
            <!-- Bintang Terisi -->
            @for ($i = 0; $i < floor($ulasan->rating); $i++)
                <svg class="star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.995 1.44 8.181L12 18.896 5.624 23.477l1.44-8.181-6.064-5.995 8.332-1.151z"/></svg>
            @endfor
            <!-- Bintang Kosong -->
            @for ($i = floor($ulasan->rating); $i < 5; $i++)
                <svg class="star empty" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
            @endfor
          </div>
        </div>
        <div class="review-text">
          {{ $ulasan->komentar }}
        </div>
      </article>
      @empty
      <div style="text-align: center; padding: 20px; color: #6e6a9f;">
          Belum ada ulasan untuk pesanan yang Anda tangani.
      </div>
      @endforelse

    </section>
  </main>

  <!-- Modal Logout -->
  <div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
      <h3>Konfirmasi Logout</h3>
      <p>Apakah Anda yakin ingin keluar dari dashboard?</p>
      <div class="modal-buttons">
        <button class="btn-cancel" id="cancelLogoutBtn">Batal</button>
        <button class="btn-confirm" id="confirmLogoutBtn">Ya, Keluar</button>
      </div>
      <!-- Form Logout Tersembunyi -->
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </div>

  <script>
    // Logout confirmation
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    // Memicu Modal
    logoutBtn.addEventListener('click', function(e) {
      e.preventDefault();
      logoutModal.classList.add('active');
    });

    // Batal Logout
    cancelLogoutBtn.addEventListener('click', function() {
      logoutModal.classList.remove('active');
    });

    // Konfirmasi Logout (Mengirim form Laravel)
    confirmLogoutBtn.addEventListener('click', function() {
      logoutForm.submit();
      // Setelah submit, AuthController akan mengarahkan ke halaman login staff
    });

    // Tutup modal jika klik di luar box
    logoutModal.addEventListener('click', function(e) {
      if (e.target === logoutModal) {
        logoutModal.classList.remove('active');
      }
    });
  </script>

</body>
</html>