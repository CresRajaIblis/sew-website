<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zulaeha Tailor - Baju Formal & Non-Formal Premium</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* =========================================
           1. CSS ASLI HOME (LAYOUT & NAVBAR)
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; color: #2c2c2c; overflow-x: hidden; line-height: 1.6; }

        /* Header (TIDAK DIUBAH) */
        header { background: rgba(255, 255, 255, 0.98); padding: 1rem 5%; box-shadow: 0 4px 20px rgba(0,0,0,0.08); position: fixed; width: 100%; top: 0; z-index: 1000; backdrop-filter: blur(10px); }
        .navbar { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; }
        .logo { display: flex; align-items: center; gap: 0.5rem; font-size: 1.5rem; font-weight: 800; color: #8B4545; text-decoration: none; }
        .logo-icon { font-size: 1.8rem; }
        .nav-menu { display: flex; list-style: none; gap: 2.5rem; }
        .nav-menu a { text-decoration: none; color: #2c2c2c; font-weight: 500; transition: all 0.3s; position: relative; }
        .nav-menu a:hover { color: #F59B9A; }
        .nav-menu a::after { content: ''; position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #F59B9A; transition: width 0.3s; }
        .nav-menu a:hover::after { width: 100%; }
        .nav-actions { display: flex; align-items: center; gap: 1rem; }

        .btn-cart { background: transparent; border: 2px solid #F59B9A; color: #F59B9A; padding: 0.6rem 1.2rem; border-radius: 25px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; position: relative; }
        .btn-cart:hover { background: #F59B9A; color: white; }
        .cart-count { background: #8B4545; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem; position: absolute; top: -5px; right: -5px; }

        .cta-button { text-decoration: none; display: inline-block; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); color: white; border: none; padding: 0.8rem 1.8rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.3s; box-shadow: 0 4px 15px rgba(245, 155, 154, 0.3); }
        .cta-button:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(245, 155, 154, 0.4); }

        .btn-logout-outline { background: transparent; color: #8B4545; border: 2px solid #8B4545; padding: 0.8rem 1.8rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .btn-logout-outline:hover { background: #8B4545; color: white; }

        /* Hero Section */
        .hero { margin-top: 80px; padding: 5rem 5% 3rem; background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 50%, #FFF5F5 100%); display: flex; align-items: center; min-height: 90vh; position: relative; overflow: hidden; }
        .hero-content { flex: 1; max-width: 650px; z-index: 2; }
        .badge { display: inline-block; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); color: white; padding: 0.5rem 1.5rem; border-radius: 30px; font-size: 0.85rem; font-weight: 600; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(245, 155, 154, 0.3); }
        .hero h1 { font-size: 4rem; line-height: 1.2; margin: 1rem 0; color: #2c2c2c; font-weight: 800; }
        .highlight { background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero p { color: #666; line-height: 1.8; margin: 1.5rem 0; font-size: 1.1rem; }
        .hero-stats { display: flex; gap: 3rem; margin: 2rem 0; }
        .stat h3 { font-size: 2.5rem; color: #8B4545; font-weight: 800; }
        .hero-buttons { display: flex; gap: 1rem; margin-top: 2.5rem; }
        
        .btn-primary { text-decoration: none; display: inline-block; background: linear-gradient(135deg, #8B4545 0%, #F59B9A 100%); color: white; border: none; padding: 1.2rem 2.5rem; border-radius: 30px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; box-shadow: 0 6px 20px rgba(139, 69, 69, 0.3); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(139, 69, 69, 0.4); }
        .btn-secondary { text-decoration: none; display: inline-block; background: white; color: #8B4545; border: 2px solid #8B4545; padding: 1.2rem 2.5rem; border-radius: 30px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; }
        .btn-secondary:hover { background: #8B4545; color: white; }

        .hero-image { flex: 1; display: flex; justify-content: center; align-items: center; position: relative; height: 600px; }
        .image-card { position: absolute; background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 10px 40px rgba(0,0,0,0.1); transition: all 0.3s; }
        .image-card:hover { transform: translateY(-10px) scale(1.05); box-shadow: 0 15px 50px rgba(0,0,0,0.15); z-index: 10; }
        .card-1 { width: 250px; height: 300px; top: 50px; left: 0; z-index: 3; }
        .card-2 { width: 280px; height: 350px; top: 100px; left: 150px; z-index: 2; }
        .card-3 { width: 240px; height: 280px; top: 250px; left: 280px; z-index: 1; }
        
        .product-preview { width: 100%; height: 100%; background: linear-gradient(135deg, #FFE8E8 0%, #F59B9A 100%); border-radius: 10px; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; position: relative; }
        .product-tag { position: absolute; top: 10px; right: 10px; background: #8B4545; color: white; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; z-index: 5; }
        .product-tag.hot { background: #FF6B6B; }
        
        .floating-elements { position: absolute; width: 100%; height: 100%; pointer-events: none; }
        .float-element { position: absolute; font-size: 2rem; animation: float 3s ease-in-out infinite; }
        .el-1 { top: 10%; left: 5%; animation-delay: 0s; } .el-2 { top: 30%; right: 10%; animation-delay: 1s; } .el-3 { bottom: 20%; left: 15%; animation-delay: 2s; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }

        /* Features */
        .features { padding: 3rem 5%; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; max-width: 1400px; margin: 0 auto; }
        .feature-card { background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(245, 155, 154, 0.2); }
        .feature-icon { font-size: 3rem; margin-bottom: 1rem; }
        .feature-card h3 { color: #8B4545; margin-bottom: 0.5rem; }

        /* About */
        .about { padding: 5rem 5%; display: flex; align-items: center; gap: 5rem; max-width: 1400px; margin: 0 auto; }
        .about-image { flex: 1; }
        .about-img-wrapper { position: relative; }
        .about-badge { position: absolute; top: -20px; right: -20px; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); color: white; padding: 1rem 1.5rem; border-radius: 50px; font-weight: 600; box-shadow: 0 5px 20px rgba(245, 155, 154, 0.4); z-index: 2; }
        .image-showcase { background: linear-gradient(135deg, #8B4545 0%, #F59B9A 100%); border-radius: 30px; padding: 3rem; height: 500px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 40px rgba(139, 69, 69, 0.3); }
        .about-content { flex: 1; }
        .section-label { color: #F59B9A; font-weight: 600; font-size: 0.95rem; display: block; margin-bottom: 1rem; }
        .about h2 { font-size: 2.8rem; margin-bottom: 1.5rem; line-height: 1.3; font-weight: 700; }
        .about p { color: #666; line-height: 1.9; margin-bottom: 1.5rem; font-size: 1.05rem; }
        .about-features { margin: 2rem 0; }
        .about-feature-item { display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
        .check-icon { background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; }
        .about-feature-item h4 { color: #2c2c2c; margin-bottom: 0.3rem; }

        /* Collection */
        .collection { padding: 5rem 5%; background: linear-gradient(180deg, #8B4545 0%, #723636 100%); }
        .collection-header { text-align: center; color: white; margin-bottom: 3rem; }
        .collection-header h2 { font-size: 3rem; margin-bottom: 1rem; font-weight: 800; }
        .category-tabs { display: flex; justify-content: center; gap: 1rem; margin: 3rem 0; flex-wrap: wrap; }
        .tab { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 0.8rem 1.8rem; border-radius: 30px; cursor: pointer; font-weight: 600; transition: all 0.3s; backdrop-filter: blur(10px); }
        .tab.active, .tab:hover { background: #F59B9A; border-color: #F59B9A; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 155, 154, 0.3); }
        
        /* Product Card Style */
        .collection-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2.5rem; margin: 4rem 0; max-width: 1400px; margin: 0 auto; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; transition: all 0.3s; cursor: pointer; position: relative; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
        
        .product-image { height: 350px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .formal-bg { background: #E3F2FD; }
        
        /* Badge Product */
        .product-badge { position: absolute; top: 15px; left: 15px; background: #8B4545; color: white; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.8rem; font-weight: 600; z-index: 5; }
        .product-badge.hot { background: #FF6B6B; }
        .product-badge.new { background: #4CAF50; }

        .product-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; opacity: 0; transition: all 0.3s; }
        .product-card:hover .product-overlay { opacity: 1; }
        
        .btn-quick-view, .btn-add-cart-card { background: white; color: #8B4545; border: none; padding: 0.8rem 1.5rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.3s; text-decoration: none; }
        .btn-add-cart-card { background: #F59B9A; color: white; }
        .btn-quick-view:hover, .btn-add-cart-card:hover { transform: scale(1.1); }
        
        .product-info { padding: 1.5rem; }
        .product-rating { color: #FFB300; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .product-info h3 { color: #2c2c2c; font-size: 1.2rem; margin-bottom: 0.5rem; }
        .product-desc { color: #666; font-size: 0.9rem; margin-bottom: 1rem; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; }
        .price { color: #8B4545; font-weight: 700; font-size: 1.5rem; }
        .view-all-btn { display: inline-block; text-decoration: none; text-align: center; margin: 3rem auto 0; background: white; color: #8B4545; border: none; padding: 1.2rem 3rem; border-radius: 30px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s; }
        .view-all-btn:hover { transform: scale(1.05); box-shadow: 0 5px 20px rgba(255,255,255,0.3); }

        /* Contact & Footer (Sama) */
        .contact { padding: 5rem 5%; display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; max-width: 1400px; margin: 0 auto; }
        .contact-icon { font-size: 2rem; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: white; margin-right: 1rem; }
        .contact-item { display: flex; align-items: center; margin-bottom: 2rem; }
        .contact-form-section h3 { font-size: 2rem; color: #2c2c2c; margin-bottom: 1.5rem; }
        .contact-form { display: flex; flex-direction: column; gap: 1.2rem; }
        .contact-form input, .contact-form textarea { padding: 1.2rem 1.5rem; border: 2px solid #E0E0E0; border-radius: 15px; font-size: 1rem; font-family: 'Poppins', sans-serif; }

        footer { background-color: #15202b; color: #ccc; padding: 40px 20px; font-family: 'Poppins', sans-serif; font-size: 16px; margin-top: auto; }
        .footer-container { display: flex; justify-content: space-between; max-width: 1100px; margin: 0 auto 30px auto; flex-wrap: wrap; }
        .footer-section { flex: 1 1 220px; margin-right: 30px; min-width: 200px; }
        .footer-section h3 { color: #f19191; font-weight: 700; margin-bottom: 15px; }
        .footer-section a { color: #ccc; text-decoration: none; display: block; margin-bottom: 8px; }
        .footer-bottom { text-align: center; color: #ccc; font-size: 14px; border-top: 1px solid #33475b; padding-top: 15px; margin-top: 30px; }

        /* =========================================
           2. CSS UNTUK KERANJANG BARU (MODERN STYLE)
           ========================================= */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(44, 44, 44, 0.6); z-index: 2000; justify-content: center; align-items: center; backdrop-filter: blur(5px); }
        .modal.active { display: flex; animation: fadeIn 0.3s ease-out; }

        .modal-content { 
            background: white; border-radius: 24px; width: 95%; max-width: 700px; 
            max-height: 90vh; overflow-y: auto; position: relative; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); display: flex; flex-direction: column;
        }

        .modal-header { 
            background: #FFF5F5; padding: 1.5rem 2rem; 
            display: flex; justify-content: space-between; align-items: center; 
            border-bottom: 1px solid rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 10;
        }
        .modal-header h2 { color: #8B4545; font-size: 1.5rem; font-weight: 700; margin: 0; }
        .close-modal { background: white; border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; color: #666; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: 0.3s; }
        .close-modal:hover { background: #8B4545; color: white; transform: rotate(90deg); }

        .modal-body { padding: 2rem; }

        /* Stepper */
        .stepper { display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative; }
        .stepper::before { content: ''; position: absolute; top: 15px; left: 0; width: 100%; height: 2px; background: #eee; z-index: 0; }
        .step { position: relative; z-index: 1; text-align: center; width: 33.33%; }
        .step-circle { width: 32px; height: 32px; background: #eee; border-radius: 50%; margin: 0 auto 8px; display: flex; align-items: center; justify-content: center; color: #999; font-weight: 600; font-size: 0.9rem; transition: 0.3s; border: 2px solid white; }
        .step.active .step-circle { background: #F59B9A; color: white; box-shadow: 0 0 0 3px rgba(245, 155, 154, 0.3); }
        .step.completed .step-circle { background: #8B4545; color: white; }
        .step-label { font-size: 0.8rem; color: #999; font-weight: 500; }
        .step.active .step-label, .step.completed .step-label { color: #8B4545; font-weight: 700; }

        /* Cart Item Modern */
        .cart-item-modern { display: flex; gap: 1rem; padding: 1rem; border: 1px solid #eee; border-radius: 16px; margin-bottom: 1rem; transition: all 0.3s; background: white; align-items: center; }
        .cart-item-modern:hover { border-color: #F59B9A; box-shadow: 0 5px 15px rgba(0,0,0,0.03); transform: translateY(-2px); }
        .cart-img-box { width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #f9f9f9; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
        .cart-img-box img { width: 100%; height: 100%; object-fit: cover; }
        .cart-info { flex: 1; }
        .cart-info h4 { font-size: 1rem; margin-bottom: 4px; color: #333; }
        .cart-meta { font-size: 0.85rem; color: #888; display: flex; gap: 10px; margin-bottom: 5px; }
        .cart-price { color: #8B4545; font-weight: 700; font-size: 1.1rem; }
        .cart-remove-btn { color: #ff6b6b; cursor: pointer; background: #fff0f0; padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; border: none; font-weight: 600; }

        /* Total & Form */
        .cart-total-bar { background: #FFF5F5; border-radius: 16px; padding: 1.5rem; margin-top: 2rem; border: 1px dashed #F59B9A; }
        .total-row { display: flex; justify-content: space-between; margin-bottom: 8px; color: #555; }
        .total-row.final { font-size: 1.4rem; font-weight: 800; color: #8B4545; margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.05); }
        
        .modern-input { width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 12px; font-family: 'Poppins', sans-serif; transition: 0.3s; margin-bottom: 15px; }
        .modern-input:focus { border-color: #F59B9A; outline: none; }
        
        .payment-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1rem; }
        .payment-option-card { border: 2px solid #eee; border-radius: 16px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: 0.3s; background: white; }
        .payment-option-card.active, .payment-option-card:hover { border-color: #F59B9A; background: #FFF5F5; }
        .btn-block { width: 100%; display: block; text-align: center; padding: 1rem; background: #8B4545; color: white; border: none; border-radius: 12px; font-weight: bold; cursor: pointer; margin-top: 1rem; }

        /* Tiket Sukses */
        .queue-ticket { background: white; border: 2px dashed #8B4545; border-radius: 20px; padding: 2rem; margin: 2rem auto; max-width: 350px; text-align: center; }
        .queue-value { font-size: 3.5rem; font-weight: 800; color: #8B4545; }

        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero { flex-direction: column; text-align: center; }
            .payment-grid { grid-template-columns: 1fr; }
            .modal-content { width: 100%; height: 100vh; border-radius: 0; }
        }
    </style>
</head>
<body onbeforeunload="saveCartState()">

    <header>
        <nav class="navbar">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-icon">✂</span>
                <span>ZULAEHA TAILOR</span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}" style="color: #F59B9A;">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('catalogue') }}">Catalogue</a></li>
            </ul>
            
            <div class="nav-actions">
                <button class="btn-cart" onclick="openCart()">
                    🛍️ <span class="cart-count" id="cartCount">0</span>
                </button>
                @auth
                    <a href="{{ route('dashboard_redirect') }}" class="cta-button" style="background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%);">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout-outline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('user.login') }}" class="cta-button">Masuk / Daftar</a>
                @endauth
            </div>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <div class="badge">✨ Koleksi Terbaru 2025</div>
            <h1>Tampil Memukau<br>Dengan <span class="highlight">Busana Impian</span> Anda</h1>
            <p>Koleksi eksklusif baju formal dan non-formal untuk remaja hingga dewasa.</p>
            <div class="hero-stats">
                <div class="stat"><h3>5000+</h3><p>Pelanggan</p></div>
                <div class="stat"><h3>15+</h3><p>Tahun Pengalaman</p></div>
            </div>
            <div class="hero-buttons">
                <a href="#collection-section" class="btn-primary">Lihat Koleksi</a>
                <a href="#contact-section" class="btn-secondary">Hubungi Kami</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="image-card card-1">
                <div class="product-preview">
                    <div class="product-tag new">New</div>
                    <img src="{{ asset('assets/image/foto1.jpg') }}" style="width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0; border-radius:10px; z-index:0;">
                </div>
            </div>
            <div class="image-card card-2">
                <div class="product-preview">
                    <div class="product-tag hot">Hot</div>
                    <img src="{{ asset('assets/image/foto2.jpg') }}" style="width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0; border-radius:10px; z-index:0;">
                </div>
            </div>
            <div class="image-card card-3">
                <div class="product-preview">
                    <div class="product-tag">Sale</div>
                    <img src="{{ asset('assets/image/foto3.jpg') }}" style="width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0; border-radius:10px; z-index:0;">
                </div>
            </div>
        </div>
        <div class="floating-elements">
            <div class="float-element el-1">⭐</div>
            <div class="float-element el-2">✨</div>
            <div class="float-element el-3">🌟</div>
        </div>
    </section>

    <section class="features">
        <div class="feature-card"><div class="feature-icon">✂️</div><h3>Custom Tailoring</h3><p>Jahit sesuai ukuran</p></div>
        <div class="feature-card"><div class="feature-icon">🎨</div><h3>Desain Modern</h3><p>Mengikuti tren fashion</p></div>
        <div class="feature-card"><div class="feature-icon">🏆</div><h3>Bahan Premium</h3><p>Kualitas terbaik</p></div>
        <div class="feature-card"><div class="feature-icon">🚚</div><h3>Pengiriman Cepat</h3><p>Gratis ongkir tertentu</p></div>
    </section>

    <section class="about" id="about">
        <div class="about-image">
            <div class="image-showcase">
                <img src="{{ asset('assets/image/ukuran.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
            </div>
        </div>
        <div class="about-content">
            <span class="section-label">💼 Tentang Kami</span>
            <h2>Menciptakan <span class="highlight">Kepercayaan Diri</span></h2>
            <p>Zulaeha Tailor telah melayani ribuan pelanggan dengan dedikasi penuh selama lebih dari 15 tahun.</p>
            <div class="about-features">
                <div class="about-feature-item"><span class="check-icon">✓</span> <h4>Kualitas Terjamin</h4></div>
                <div class="about-feature-item"><span class="check-icon">✓</span> <h4>Desain Eksklusif</h4></div>
                <div class="about-feature-item"><span class="check-icon">✓</span> <h4>Harga Kompetitif</h4></div>
            </div>
        </div>
    </section>

    <section class="collection" id="collection-section">
        <div class="collection-header">
            <h2>Koleksi Terbaru</h2>
            <p>Temukan busana yang sempurna untuk setiap momen Anda</p>
        </div>
        
        <div class="category-tabs">
            <button class="tab active" data-category="all">Semua Produk</button>
            <button class="tab" data-category="formal">Formal</button>
            <button class="tab" data-category="casual">Casual</button>
            <button class="tab" data-category="new">Terbaru</button>
        </div>

        <div class="collection-grid" id="productContainer">
            </div>

        <center>
            <a href="{{ route('catalogue') }}" class="view-all-btn">Lihat Semua Koleksi →</a>
        </center>
    </section>

    <section class="contact" id="contact-section">
        <div class="contact-info">
            <h2>Hubungi Kami</h2>
            <div class="contact-item"><div class="contact-icon">📍</div><div><h4>Alamat Toko</h4><p>Jl. Prof. Dr. Soepomo No. 561, Palembang</p></div></div>
            <div class="contact-item"><div class="contact-icon">📞</div><div><h4>Telepon</h4><p>+62 813-7367-7824</p></div></div>
            <div class="contact-item"><div class="contact-icon">📧</div><div><h4>Email</h4><p>zulstailor@gmail.com</p></div></div>
        </div>
        <div class="contact-form-section">
            <h3>Kirim Pesan</h3>
            <form class="contact-form">
                <input type="text" id="contactName" placeholder="Nama Anda">
                <input type="tel" id="contactPhone" placeholder="Nomor WhatsApp">
                <textarea id="contactMessage" rows="5" placeholder="Pesan Anda..."></textarea>
                <button type="button" class="btn-primary" style="width:100%" onclick="sendContactWA()">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Tentang Zulaeha Taylor</h3>
            <p>Menyediakan busana berkualitas permium dengan desain modern dan elegan sejak 2010.</p>
        </div>
        <div class="footer-section">
            <h3>Link Cepat</h3>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li> 
                <li><a href="{{ route('catalogue') }}">Kategori</a></li> 
                <li><a href="#collection">Koleksi</a></li> 
                <li><a href="#contact">Kontak</a></li> 
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

    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Keranjang Belanja</h2>
                <button class="close-modal" onclick="closeCart()">×</button>
            </div>
            <div class="modal-body" id="cartBody">
                </div>
        </div>
    </div>

    <script>
        // 1. DATA & VARIABEL GLOBAL
        const products = @json($products);
        const ADMIN_WA_NUMBER = '6281373677824'; 
        const csrfToken = '{{ csrf_token() }}';
        const placeOrderUrl = '{{ route("checkout.process") }}';
        
        const isUserAuthenticated = {{ Auth::check() && Auth::user()->role === 'user' ? 'true' : 'false' }};
        const userData = {
            name: '{{ Auth::user()->name ?? "" }}',
            email: '{{ Auth::user()->email ?? "" }}',
            phone: '{{ Auth::user()->phone ?? "" }}'
        };

        let cart = [];
        window.tempOrderData = {};

        // 2. HELPER GAMBAR (/assets/image/)
        function getImageUrl(imgString) {
            if (!imgString) return 'https://via.placeholder.com/100?text=No+Image';
            if (imgString.startsWith('http')) return imgString;
            return `/assets/image/${imgString}`;
        }

        // Helper Stepper UI
        function renderStepper(step) {
            return `
                <div class="stepper">
                    <div class="step ${step >= 1 ? 'active' : ''} ${step > 1 ? 'completed' : ''}">
                        <div class="step-circle">${step > 1 ? '✓' : '1'}</div>
                        <div class="step-label">Keranjang</div>
                    </div>
                    <div class="step ${step >= 2 ? 'active' : ''} ${step > 2 ? 'completed' : ''}">
                        <div class="step-circle">${step > 2 ? '✓' : '2'}</div>
                        <div class="step-label">Data Diri</div>
                    </div>
                    <div class="step ${step >= 3 ? 'active' : ''}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Bayar</div>
                    </div>
                </div>
            `;
        }

        function saveCartState() { localStorage.setItem('zulaehaCart', JSON.stringify(cart)); }
        function updateCartCount() { document.getElementById('cartCount').innerText = cart.reduce((a,b)=>a+b.quantity, 0); }

        // 3. INITIALIZATION
        document.addEventListener('DOMContentLoaded', function() {
            const savedCart = localStorage.getItem('zulaehaCart');
            if (savedCart) { try { cart = JSON.parse(savedCart); } catch (e) { cart = []; } }
            renderProducts('all');
            updateCartCount();

            // Logic Tab Kategori
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    renderProducts(tab.getAttribute('data-category'));
                });
            });
        });

        // 4. RENDER PRODUK DI HOME (MODIFIKASI: 4 CARD + BADGE)
        function renderProducts(filterCategory) {
            const container = document.getElementById('productContainer');
            container.innerHTML = ''; 

            const filtered = products.filter(p => {
                if (filterCategory === 'all') return true;
                if (filterCategory === 'new') return p.badge === 'new';
                return p.category === filterCategory;
            });

            if (filtered.length === 0) {
                container.innerHTML = '<p style="text-align:center; width:100%; color:white;">Produk tidak ditemukan.</p>';
                return;
            }

            // AMBIL HANYA 4 PRODUK PERTAMA
            filtered.slice(0, 4).forEach(p => { 
                
                // Badge Logic
                let badgeHTML = '';
                if(p.badge === 'hot') badgeHTML = '<div class="product-badge hot">🔥 HOT</div>';
                else if(p.badge === 'new') badgeHTML = '<div class="product-badge new">✨ NEW</div>';
                
                // Image Logic
                const imgUrl = getImageUrl(p.image || p.icon);

                container.innerHTML += `
                    <div class="product-card">
                        <div class="product-image ${p.bg || 'formal-bg'}">
                            <img src="${imgUrl}" alt="${p.name}">
                            ${badgeHTML}
                            <div class="product-overlay">
                                <a href="{{ route('catalogue') }}" class="btn-quick-view">Lihat Detail</a>
                                <button class="btn-add-cart-card" onclick="addToCart(${p.id})">Tambah</button>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-rating">⭐⭐⭐⭐⭐ <span>(${p.reviews || 0})</span></div>
                            <h3>${p.name}</h3>
                            <div class="product-footer"><p class="price">Rp ${p.price.toLocaleString('id-ID')}</p></div>
                        </div>
                    </div>`;
            });
        }

        // 5. ADD TO CART (HOME VERSION - DEFAULT SIZE)
        function addToCart(pid) {
            const p = products.find(i => i.id === pid);
            if (!p) return;

            const exist = cart.find(i => i.id === pid && i.size === "All Size");
            if (exist) {
                exist.quantity++;
            } else {
                cart.push({
                    id: p.id, name: p.name, price: p.price,
                    image: p.image, // Simpan path asli
                    size: "All Size", color: "Standard",
                    quantity: 1
                });
            }
            saveCartState(); updateCartCount();
            alert(`✅ ${p.name} masuk keranjang!`);
        }

        // ============================================================
        // 6. KERANJANG BARU LOGIC (STEPPER)
        // ============================================================

        function openCart() { document.getElementById('cartModal').classList.add('active'); renderCartStep(); }
        function closeCart() { document.getElementById('cartModal').classList.remove('active'); }

        // STEP 1
        function renderCartStep() {
            const body = document.getElementById('cartBody');
            document.getElementById('modalTitle').innerText = 'Keranjang Belanja';

            if (cart.length === 0) {
                body.innerHTML = `<div style="text-align:center; padding:3rem; color:#666;">Keranjang kosong.</div>`;
                return;
            }

            const total = cart.reduce((a,b) => a + (b.price * b.quantity), 0);
            const ppn = total * 0.1;
            const grandTotal = total + ppn;

            let html = renderStepper(1);
            html += `<div style="max-height: 350px; overflow-y: auto;">`;

            cart.forEach((item, idx) => {
                html += `
                    <div class="cart-item-modern">
                        <div class="cart-img-box">
                            <img src="${getImageUrl(item.image)}" alt="${item.name}">
                        </div>
                        <div class="cart-info">
                            <h4>${item.name}</h4>
                            <div class="cart-meta"><span>Size: ${item.size}</span><span>Warna: ${item.color}</span></div>
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <span class="cart-price">Rp ${item.price.toLocaleString('id-ID')}</span>
                                <div>
                                    <span style="font-size:0.9rem; color:#666; margin-right:5px;">x${item.quantity}</span>
                                    <button class="cart-remove-btn" onclick="removeItem(${idx})">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `</div>
                <div class="cart-total-bar">
                    <div class="total-row"><span>Subtotal</span> <span>Rp ${total.toLocaleString('id-ID')}</span></div>
                    <div class="total-row"><span>Pajak (10%)</span> <span>Rp ${ppn.toLocaleString('id-ID')}</span></div>
                    <div class="total-row final"><span>Total</span> <span>Rp ${grandTotal.toLocaleString('id-ID')}</span></div>
                </div>
                <button class="btn-block" onclick="renderDataStep()">Lanjut Isi Data <i class="fa-solid fa-arrow-right"></i></button>
            `;
            body.innerHTML = html;
        }

        // STEP 2
        function renderDataStep() {
            if(!isUserAuthenticated) {
                alert('Silakan login terlebih dahulu!');
                window.location.href = '{{ route("user.login") }}';
                return;
            }
            
            const body = document.getElementById('cartBody');
            document.getElementById('modalTitle').innerText = 'Data Pengiriman';
            
            const name = window.tempOrderData?.name || userData.name;
            const phone = window.tempOrderData?.phone || userData.phone;
            const email = window.tempOrderData?.email || userData.email;
            const address = window.tempOrderData?.address || '';

            let html = renderStepper(2);
            html += `
                <div onclick="renderCartStep()" style="cursor:pointer; color:#666; margin-bottom:1rem;">⬅ Kembali</div>
                <input type="text" class="modern-input" id="fName" value="${name}" placeholder="Nama Penerima">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                    <input type="text" class="modern-input" id="fPhone" value="${phone}" placeholder="No. HP">
                    <input type="email" class="modern-input" id="fEmail" value="${email}" placeholder="Email">
                </div>
                <input type="text" class="modern-input" id="fAddress" value="${address}" placeholder="Alamat Lengkap">
                <input type="text" class="modern-input" id="fNote" value="${window.tempOrderData?.note || ''}" placeholder="Catatan (Opsional)">
                <button class="btn-block" onclick="submitDataStep()">Lanjut Pembayaran <i class="fa-solid fa-credit-card"></i></button>
            `;
            body.innerHTML = html;
        }

        function submitDataStep() {
            const name = document.getElementById('fName').value;
            const phone = document.getElementById('fPhone').value;
            const email = document.getElementById('fEmail').value;
            const address = document.getElementById('fAddress').value;
            const note = document.getElementById('fNote').value;

            if(!name || !phone || !address) { alert('Data harus lengkap!'); return; }
            window.tempOrderData = { name, phone, email, address, note };
            renderPaymentStep();
        }

        // STEP 3
        function renderPaymentStep() {
            const body = document.getElementById('cartBody');
            document.getElementById('modalTitle').innerText = 'Pilih Pembayaran';
            
            let html = renderStepper(3);
            html += `
                <div onclick="renderDataStep()" style="cursor:pointer; color:#666; margin-bottom:1rem;">⬅ Kembali</div>
                <div class="payment-grid">
                    <div class="payment-option-card" onclick="selectPayment('transfer', this)"><i class="fa-solid fa-bank"></i><br>Transfer</div>
                    <div class="payment-option-card" onclick="selectPayment('ewallet', this)"><i class="fa-solid fa-qrcode"></i><br>QRIS</div>
                    <div class="payment-option-card" onclick="selectPayment('cod', this)"><i class="fa-solid fa-truck"></i><br>COD</div>
                </div>
                <div id="paymentDetailArea" style="margin-top:20px;"></div>
            `;
            body.innerHTML = html;
        }

        function selectPayment(method, el) {
            window.tempOrderData.method = method;
            document.querySelectorAll('.payment-option-card').forEach(c => c.classList.remove('active'));
            el.classList.add('active');

            const total = cart.reduce((a,b)=>a+(b.price*b.quantity),0) * 1.1;
            const area = document.getElementById('paymentDetailArea');
            
            let detail = '';
            if(method === 'transfer') detail = '<div style="background:#f9f9f9; padding:15px; border-radius:10px; text-align:center;"><p>Bank BCA: <strong>123-456-7890</strong><br>a.n Zulaeha Tailor</p></div>';
            else if(method === 'ewallet') detail = '<div style="background:#f9f9f9; padding:15px; border-radius:10px; text-align:center;"><p>Scan QRIS saat konfirmasi WA</p></div>';
            else detail = '<div style="background:#f9f9f9; padding:15px; border-radius:10px; text-align:center;"><p>Bayar tunai ke kurir</p></div>';

            area.innerHTML = `
                ${detail}
                <div style="text-align:center; margin-top:20px;">
                    <p>Total Tagihan:</p>
                    <h2 style="color:#8B4545;">Rp ${total.toLocaleString('id-ID')}</h2>
                </div>
                <button class="btn-block" style="background:linear-gradient(135deg, #25D366, #128C7E);" onclick="processOrder()">Konfirmasi via WhatsApp <i class="fa-brands fa-whatsapp"></i></button>
            `;
        }

        // PROSES ORDER
        async function processOrder() {
            const btn = document.querySelector('.btn-block');
            btn.innerHTML = '⏳ Memproses...';
            btn.disabled = true;

            const total = cart.reduce((a,b)=>a+(b.price*b.quantity),0) * 1.1;
            const data = window.tempOrderData;
            
            let methodDb = 'Transfer';
            if(data.method === 'ewallet') methodDb = 'QRIS';
            if(data.method === 'cod') methodDb = 'COD';

            const payload = {
                name: data.name, phone: data.phone, email: data.email,
                address: data.address, note: data.note,
                payment_method: methodDb,
                cart: cart, total_price: total
            };

            try {
                const res = await fetch(placeOrderUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify(payload)
                });
                const result = await res.json();

                if(result.success) {
                    showSuccessScreen(result.order_number, result.queue_number);
                    
                    let wa = `Halo Admin Zulaeha Tailor! Saya konfirmasi order #${result.order_number}.\n\n`;
                    wa += `Nama: ${data.name}\nTotal: Rp ${total.toLocaleString('id-ID')}\nMetode: ${methodDb}\n`;
                    window.open(`https://wa.me/${ADMIN_WA_NUMBER}?text=${encodeURIComponent(wa)}`, '_blank');
                    
                    cart = []; saveCartState(); updateCartCount();
                } else {
                    alert('Gagal: ' + result.message);
                    btn.disabled = false; btn.innerHTML = 'Coba Lagi';
                }
            } catch(e) {
                console.error(e);
                alert('Gagal koneksi.');
                btn.disabled = false; btn.innerHTML = 'Coba Lagi';
            }
        }

        function showSuccessScreen(orderNo, queueNo) {
            const body = document.getElementById('cartBody');
            document.getElementById('modalTitle').innerText = 'Pesanan Berhasil!';
            document.querySelector('.close-modal').style.display = 'none';

            body.innerHTML = `
                <div style="text-align:center; padding:1rem;">
                    <div style="font-size:3rem; color:#4CAF50; margin-bottom:1rem;"><i class="fa-solid fa-circle-check"></i></div>
                    <h3>Terima Kasih!</h3>
                    <p>Pesanan Anda telah diterima.</p>
                    <div class="queue-ticket">
                        <p style="color:#999; font-size:0.9rem; text-transform:uppercase; letter-spacing:1px;">Nomor Antrian</p>
                        <div class="queue-value">#${queueNo}</div>
                        <p style="font-size:0.8rem; margin-top:10px;">Kode Order: ${orderNo}</p>
                    </div>
                    <button class="btn-block" onclick="location.reload()">Selesai & Belanja Lagi</button>
                </div>
            `;
        }

        function removeItem(idx) {
            cart.splice(idx, 1);
            saveCartState(); updateCartCount(); renderCartStep();
        }

        // WA Contact Home
        function sendContactWA() {
            const name = document.getElementById('contactName').value;
            const phone = document.getElementById('contactPhone').value;
            const msg = document.getElementById('contactMessage').value;
            if(!name || !msg) { alert('Lengkapi data kontak dulu ya!'); return; }
            window.open(`https://wa.me/${ADMIN_WA_NUMBER}?text=Halo, saya ${name}. ${msg}`, '_blank');
        }
    </script>
</body>
</html>