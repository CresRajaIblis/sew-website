<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tentang Kami - Zulaeha Tailor</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  /* Animasi Dasar */
  @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes scaleIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
  @keyframes slideInLeft { from { opacity: 0; transform: translateX(-50px); } to { opacity: 1; transform: translateX(0); } }
  @keyframes slideInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body { font-family: 'Poppins', sans-serif; background-color: #fce3e3; color: #333; overflow-x: hidden; }

  /* --- HEADER & NAVBAR (Konsisten dengan Home) --- */
  header {
      background: rgba(255, 255, 255, 0.98);
      padding: 1rem 5%;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      position: fixed; width: 100%; top: 0; z-index: 1000;
      backdrop-filter: blur(10px);
  }

  .navbar { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; }
  
  .logo { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 800; color: #8B4545; text-decoration: none; }
  .logo-icon { font-size: 1.8rem; }

  .nav-menu { display: flex; list-style: none; gap: 2.5rem; }
  .nav-menu a { text-decoration: none; color: #2c2c2c; font-weight: 500; transition: all 0.3s; position: relative; }
  .nav-menu a:hover { color: #F59B9A; }
  
  .nav-actions { display: flex; align-items: center; gap: 1rem; }

  .cta-button {
      text-decoration: none; display: inline-block;
      background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%);
      color: white; border: none; padding: 0.8rem 1.8rem; border-radius: 25px;
      cursor: pointer; font-weight: 600; transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(245, 155, 154, 0.3);
  }
  .cta-button:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(245, 155, 154, 0.4); }

  .btn-outline {
      text-decoration: none; display: inline-block; border: 2px solid #8B4545;
      color: #8B4545; padding: 0.6rem 1.5rem; border-radius: 25px;
      font-weight: 600; transition: all 0.3s;
  }
  .btn-outline:hover { background: #8B4545; color: white; }

  /* --- ABOUT SECTION --- */
  .about-section { text-align: center; padding: 120px 20px 40px; animation: fadeInUp 1s ease; }
  .about-section h1 { font-size: 3rem; color: #333; margin-bottom: 20px; }
  .about-section h1 span { color: #a66b6b; }
  .about-section p { color: #555; font-size: 16px; max-width: 700px; margin: 0 auto; line-height: 1.6; }

  /* --- OWNER SECTION --- */
  .owner-section { background-color: #fce3e3; padding: 50px 20px; animation: fadeInUp 1.2s ease; }
  .owner-container {
    max-width: 1100px; margin: 0 auto; display: flex; align-items: center; gap: 50px;
    background-color: #f5d4d4; border-radius: 20px; padding: 40px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1); animation: scaleIn 1s ease;
  }
  .owner-image { position: relative; flex-shrink: 0; animation: slideInLeft 1.2s ease; }
  .owner-badge {
    position: absolute; top: -10px; left: 50%; transform: translateX(-50%);
    background-color: #d98080; color: white; padding: 5px 20px; border-radius: 15px;
    font-size: 13px; font-weight: 600; z-index: 2;
  }
  .owner-image img {
    width: 280px; height: 350px; object-fit: cover; border-radius: 15px;
    border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  .owner-text { flex: 1; animation: slideInRight 1.2s ease; }
  .owner-text h2 { font-size: 2.5rem; color: #333; margin-bottom: 20px; }
  .owner-text h2 span { color: #a66b6b; }
  .owner-text p { color: #555; line-height: 1.8; font-size: 15px; margin-bottom: 1rem; }

  /* --- VALUES SECTION --- */
  .values-section { background-color: white; padding: 60px 20px; text-align: center; animation: fadeInUp 1.4s ease; }
  .values-section h2 { font-size: 2.5rem; color: #a66b6b; margin-bottom: 10px; }
  .values-section .subtitle { color: #666; margin-bottom: 50px; font-size: 16px; }
  .values-container {
    max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;
  }
  .value-card {
    background-color: #fce3e3; padding: 40px 30px; border-radius: 15px; transition: all 0.3s; animation: scaleIn 1s ease;
  }
  .value-card:hover { transform: translateY(-10px); box-shadow: 0 10px 30px rgba(166, 107, 107, 0.2); }
  .value-card h3 { font-size: 1.5rem; color: #333; margin-bottom: 15px; }
  .value-card p { color: #555; line-height: 1.6; font-size: 14px; }

  /* --- CONTACT SECTION --- */
  .contact-section { background-color: #8b4a4a; color: white; padding: 60px 20px; text-align: center; animation: fadeInUp 1.6s ease; }
  .contact-section h2 { font-size: 2.5rem; margin-bottom: 15px; }
  .contact-section .subtitle { margin-bottom: 50px; font-size: 15px; opacity: 0.9; }
  .contact-container {
    max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 50px;
  }
  .contact-card {
    background-color: #fce3e3; color: #333; padding: 40px 30px; border-radius: 15px; transition: all 0.3s; animation: scaleIn 1s ease;
  }
  .contact-card:hover { transform: translateY(-10px); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
  .contact-icon { font-size: 3rem; margin-bottom: 15px; }
  .contact-card h3 { font-size: 1.3rem; margin-bottom: 10px; color: #333; }
  .contact-card p { font-size: 14px; color: #555; line-height: 1.5; }

  /* Map */
  .map-container {
    max-width: 1100px; margin: 0 auto; border-radius: 15px; overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2); margin-bottom: 80px; animation: scaleIn 1.8s ease; height: 450px;
  }
  iframe { width: 100%; height: 100%; border: 0; }

  /* --- FOOTER --- */
  footer { background-color: #15202b; color: #ccc; padding: 40px 20px; font-size: 16px; }
  .footer-container { display: flex; justify-content: space-between; max-width: 1100px; margin: 0 auto 30px auto; flex-wrap: wrap; }
  .footer-section { flex: 1 1 220px; margin-right: 30px; min-width: 200px; margin-bottom: 20px; }
  .footer-section h3 { color: #f19191; font-weight: 700; margin-bottom: 15px; }
  .footer-section ul { list-style: none; padding: 0; margin: 0; }
  .footer-section ul li { margin-bottom: 8px; }
  .footer-section ul li a { color: #ccc; text-decoration: none; }
  .footer-section ul li a:hover { color: white; }
  .footer-bottom { text-align: center; color: #ccc; font-size: 14px; border-top: 1px solid #33475b; padding-top: 15px; margin-top: 30px; }

  /* Responsive */
  @media (max-width: 768px) {
    .nav-menu { display: none; } /* Mobile menu logic needed or simplify */
    .owner-container { flex-direction: column; text-align: center; }
    .owner-image { margin-bottom: 20px; }
  }
</style>
</head>
<body>

   <!-- Header -->
    <header>
        <nav class="navbar">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-icon">✂</span>
                <span>ZULAEHA TAILOR</span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}" style="color: #F59B9A;">About Us</a></li>
                <!-- Arahkan Catalogue ke bagian koleksi di Home -->
                <li><a href="{{ route('catalogue') }}">Catalogue</a></li>
            </ul>

            <div class="nav-actions">
                <!-- Logika Login/Dashboard -->
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="cta-button">Dashboard</a>
                    @else
                        <a href="{{ route('user.login') }}" class="btn-outline">Masuk</a>
                        <a href="{{ route('user.register') }}" class="cta-button">Daftar</a>
                    @endauth
                @endif
            </div>
        </nav>
    </header>

  <!-- About Intro -->
  <section class="about-section">
    <h1>About <span>Us</span></h1>
    <p>Zulaeha Tailor berdiri dengan semangat menghadirkan busana yang tidak hanya indah dipandang, tetapi juga nyaman dikenakan.</p>
  </section>

  <!-- Owner Section -->
  <section class="owner-section">
    <div class="owner-container">
      <div class="owner-image">
        <span class="owner-badge">Our Owner</span>
        <!-- Gambar Placeholder Wanita Profesional (Pengganti owner1.jpg) -->
        <img src="{{ asset('assets/image/owner1.jpg') }}" alt="Ibu Zulaeha">
      </div>
      <div class="owner-text">
        <h2>Ibu <span>Zulaeha</span></h2>
        <p>Ibu Zulaeha adalah pendiri Zulaeha Tailor dengan pengalaman lebih dari 10 tahun di dunia penjahitan.</p>
        <p>Motivasi utamanya adalah menghadirkan busana berkualitas tinggi yang mencerminkan keindahan budaya Indonesia, dengan filosofi bahwa setiap jahitan adalah bentuk ketulusan dan dedikasi.</p>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="values-section">
    <h2>Nilai dan Filosofi</h2>
    <p class="subtitle">Nilai yang kami terapkan untuk Usaha yang profesional</p>
    <div class="values-container">
      <div class="value-card">
        <h3>Kualitas</h3>
        <p>Mengutamakan material terbaik dan detail presisi.</p>
      </div>
      <div class="value-card">
        <h3>Personal Touch</h3>
        <p>Setiap desain disesuaikan dengan karakter pelanggan.</p>
      </div>
      <div class="value-card">
        <h3>Dedikasi</h3>
        <p>Setiap jahitan dibuat dengan ketelitian dan ketulusan.</p>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact-section">
    <h2>Contact Us</h2>
    <p class="subtitle">Butuh bantuan atau ingin konsultasi? Kami siap membantu Anda.</p>
    <div class="contact-container">
      <div class="contact-card">
        <div class="contact-icon">📞</div>
        <h3>WhatsApp</h3>
        <p>+62 813-7367-7824</p>
      </div>
      <div class="contact-card">
        <div class="contact-icon">📧</div>
        <h3>Email</h3>
        <p>zulstailor@gmail.com</p>
      </div>
      <div class="contact-card">
        <div class="contact-icon">🕐</div>
        <h3>Jam Operasional</h3>
        <p>Senin - Jumat: 08.00 - 20.00<br>Sabtu - Minggu: 12.00 - 18.00</p>
      </div>
    </div>

    <!-- Map -->
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.1234567890123!2d104.745!3d-2.976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75c123456789%3A0x123456789abcdef!2sJl.%20Prof.%20Dr.%20Soepomo%2C%20Lorong%20Rizka%20No.%20561%2C%20Palembang!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Tentang Zulaeha Tailor</h3>
            <p>Menyediakan busana berkualitas permium dengan desain modern dan elegan sejak 2010.</p>
        </div>
        <div class="footer-section">
            <h3>Link Cepat</h3>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li> 
                <li><a href="{{ url('/#collection-section') }}">Koleksi</a></li> 
                <li><a href="{{ route('user.register') }}">Daftar</a></li> 
            </ul>
        </div>
        <div class="footer-section">
            <h3>Kontak</h3>
            <p>📞 +62 813-7367-7824</p>
            <p>✉️ zulstailor@gmail.com</p>
            <p>📍 Jl. Prof. Dr. Soepomo. Lrg. Rizka No. 561, Palembang</p>
        </div>
        <div class="footer-section">
            <h3>Jam Operasional</h3>
            <p>Senin - Jumat: 08.00 - 20.00</p>
            <p>Sabtu - Minggu: 12.00 - 18.00</p>
        </div>
    </div>
    <p class="footer-bottom">© 2025 Zulaeha Tailor. All Rights Reserved.</p>
  </footer>

  <script>
    // Intersection Observer untuk animasi scroll
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe elemen yang mau dianimasikan
    document.querySelectorAll('.value-card, .contact-card').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'all 0.6s ease';
      observer.observe(el);
    });
  </script>
</body>
</html>