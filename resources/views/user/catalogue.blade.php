<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- PENTING: Token Keamanan Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Katalog - Zulaeha Tailor</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; color: #2c2c2c; overflow-x: hidden; line-height: 1.6; }

        /* Header */
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

        .btn-logout-outline {
            background: transparent;
            color: #8B4545;
            border: 2px solid #8B4545;
            padding: 0.8rem 1.8rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-logout-outline:hover {
            background: #8B4545;
            color: white;
        }

        /* Hero Section */
        .hero { margin-top: 80px; padding: 5rem 5% 3rem; background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 50%, #FFF5F5 100%); display: flex; align-items: center; min-height: 90vh; position: relative; overflow: hidden; }
        .hero-content { flex: 1; max-width: 650px; z-index: 2; }
        .badge { display: inline-block; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); color: white; padding: 0.5rem 1.5rem; border-radius: 30px; font-size: 0.85rem; font-weight: 600; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(245, 155, 154, 0.3); }
        .hero h1 { font-size: 4rem; line-height: 1.2; margin: 1rem 0; color: #2c2c2c; font-weight: 800; }
        .highlight { background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero p { color: #666; line-height: 1.8; margin: 1.5rem 0; font-size: 1.1rem; }
        .hero-stats { display: flex; gap: 3rem; margin: 2rem 0; }
        .stat { text-align: left; }
        .stat h3 { font-size: 2.5rem; color: #8B4545; font-weight: 800; }
        .stat p { color: #666; font-size: 0.9rem; margin: 0; }
        .hero-buttons { display: flex; gap: 1rem; margin-top: 2.5rem; }
        .btn-primary { background: linear-gradient(135deg, #8B4545 0%, #F59B9A 100%); color: white; border: none; padding: 1.2rem 2.5rem; border-radius: 30px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; box-shadow: 0 6px 20px rgba(139, 69, 69, 0.3); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(139, 69, 69, 0.4); }
        .btn-secondary { background: white; color: #8B4545; border: 2px solid #8B4545; padding: 1.2rem 2.5rem; border-radius: 30px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; }
        .btn-secondary:hover { background: #8B4545; color: white; }

        /* Gender Section */
        .gender-section { padding: 5rem 5%; background: white; }
        .gender-header { text-align: center; margin-bottom: 4rem; }
        .gender-header h2 { font-size: 3rem; color: #2c2c2c; margin-bottom: 1rem; font-weight: 800; }
        .gender-header p { color: #666; font-size: 1.1rem; }
        .gender-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 3rem; max-width: 1200px; margin: 0 auto; }
        .gender-card { background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 100%); border-radius: 30px; padding: 3rem; text-align: center; cursor: pointer; transition: all 0.4s; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .gender-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); opacity: 0; transition: all 0.4s; z-index: 1; }
        .gender-card:hover::before { opacity: 0.95; }
        .gender-card:hover { transform: translateY(-10px); box-shadow: 0 20px 50px rgba(245, 155, 154, 0.3); }
        .gender-card-content { position: relative; z-index: 2; transition: all 0.4s; }
        .gender-card:hover .gender-card-content { color: white; }
        .gender-icon { font-size: 5rem; margin-bottom: 1.5rem; }
        .gender-card h3 { font-size: 2.5rem; margin-bottom: 1rem; font-weight: 700; }
        .gender-card p { font-size: 1.1rem; margin-bottom: 2rem; opacity: 0.9; }
        .gender-card .btn-explore { background: white; color: #8B4545; border: none; padding: 1rem 2.5rem; border-radius: 30px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s; }
        .gender-card:hover .btn-explore { background: #8B4545; color: white; transform: scale(1.1); }

        /* Collection Section */
        .collection { padding: 5rem 5%; background: linear-gradient(180deg, #8B4545 0%, #723636 100%); }
        .collection-header { text-align: center; color: white; margin-bottom: 3rem; }
        .collection-header h2 { font-size: 3rem; margin-bottom: 1rem; font-weight: 800; }
        .collection-header p { font-size: 1.1rem; opacity: 0.9; }
        .gender-filter { display: flex; justify-content: center; gap: 1rem; margin: 2rem 0; }
        .gender-btn { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 1rem 3rem; border-radius: 30px; cursor: pointer; font-weight: 700; font-size: 1.2rem; transition: all 0.3s; backdrop-filter: blur(10px); }
        .gender-btn.active, .gender-btn:hover { background: #F59B9A; border-color: #F59B9A; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 155, 154, 0.3); }
        .category-tabs { display: flex; justify-content: center; gap: 1rem; margin: 3rem 0; flex-wrap: wrap; }
        .tab { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 0.8rem 1.8rem; border-radius: 30px; cursor: pointer; font-weight: 600; transition: all 0.3s; backdrop-filter: blur(10px); }
        .tab.active, .tab:hover { background: #F59B9A; border-color: #F59B9A; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 155, 154, 0.3); }
        .collection-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin: 4rem 0; max-width: 1400px; margin-left: auto; margin-right: auto; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; transition: all 0.3s; cursor: pointer; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
        
        .product-image { 
            height: 350px; 
            position: relative; 
            overflow: hidden; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 6rem; 
        }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }

        .formal-bg { background: linear-gradient(135deg, #E3F2FD 0%, #90CAF9 100%); }
        .premium-bg { background: linear-gradient(135deg, #FFF3E0 0%, #FFB74D 100%); }
        .casual-bg { background: linear-gradient(135deg, #F3E5F5 0%, #CE93D8 100%); }
        .dress-bg { background: linear-gradient(135deg, #FCE4EC 0%, #F48FB1 100%); }
        .batik-bg { background: linear-gradient(135deg, #E8F5E9 0%, #81C784 100%); }
        .suit-bg { background: linear-gradient(135deg, #EFEBE9 0%, #A1887F 100%); }
        .blazer-bg { background: linear-gradient(135deg, #E0F2F1 0%, #4DB6AC 100%); }
        .tunic-bg { background: linear-gradient(135deg, #FFF9C4 0%, #FFD54F 100%); }
        .kebaya-bg { background: linear-gradient(135deg, #F8BBD0 0%, #F06292 100%); }
        .shirt-bg { background: linear-gradient(135deg, #B3E5FC 0%, #4FC3F7 100%); }

        .product-badge { position: absolute; top: 15px; left: 15px; background: #8B4545; color: white; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.8rem; font-weight: 600; z-index: 2; }
        .product-badge.hot { background: #FF6B6B; }
        .product-badge.new { background: #4CAF50; }
        .product-info { padding: 1.5rem; }
        .product-rating { color: #FFB300; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .product-rating span { color: #999; font-size: 0.85rem; }
        .product-info h3 { color: #2c2c2c; font-size: 1.2rem; margin-bottom: 0.5rem; }
        .product-desc { color: #666; font-size: 0.9rem; margin-bottom: 1rem; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; }
        .price { color: #8B4545; font-weight: 700; font-size: 1.5rem; }
        .old-price { color: #999; text-decoration: line-through; font-size: 1rem; font-weight: 400; margin-left: 0.5rem; }
        
        /* Selectors */
        .size-select { margin: 1rem 0; }
        .size-select label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c2c2c; }
        .size-options { display: flex; gap: 0.5rem; flex-wrap: wrap; }
        .size-option { padding: 0.5rem 1rem; border: 2px solid #E0E0E0; border-radius: 8px; cursor: pointer; transition: all 0.3s; font-weight: 500; }
        .size-option:hover, .size-option.selected { border-color: #F59B9A; background: #F59B9A; color: white; }
        .custom-input { width: 100%; padding: 0.5rem; margin-top: 0.5rem; border: 2px solid #E0E0E0; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 0.9rem; display: none; }
        .custom-input:focus { outline: none; border-color: #F59B9A; }
        .custom-input.active { display: block; }

        .color-select { margin: 1rem 0; }
        .color-select label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c2c2c; }
        .color-options { display: flex; gap: 0.8rem; flex-wrap: wrap; }
        .color-option { width: 40px; height: 40px; border: 3px solid #E0E0E0; border-radius: 50%; cursor: pointer; transition: all 0.3s; position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden;}
        .color-option:hover { transform: scale(1.1); border-color: #8B4545; }
        .color-option.selected { border-color: #8B4545; box-shadow: 0 0 0 2px white, 0 0 0 4px #8B4545; }
        .color-option.selected::after { content: '✓'; color: white; font-weight: bold; font-size: 1.2rem; text-shadow: 0 0 3px rgba(0,0,0,0.5); }
        .color-custom { background: linear-gradient(135deg, #eee 0%, #ccc 100%); font-size: 0.7rem; font-weight: bold; color: #666; text-align: center; line-height: 1; }
        .color-custom.selected::after { content: ''; } 
        .color-black { background: #000000; }
        .color-white { background: #FFFFFF; border-color: #CCCCCC; }
        .color-navy { background: #001F3F; }
        .color-army { background: #4B5320; }

        .btn-add-cart { background: #F59B9A; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.3s; width: 100%; margin-top: 1rem; }
        .btn-add-cart:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(245, 155, 154, 0.3); }

        /* Cart Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 2000; justify-content: center; align-items: center; }
        .modal.active { display: flex; }
        .modal-content { background: white; border-radius: 20px; padding: 2rem; max-width: 800px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #E0E0E0; }
        .modal-header h2 { color: #8B4545; font-size: 2rem; }
        .close-modal { background: none; border: none; font-size: 2rem; cursor: pointer; color: #666; transition: all 0.3s; }
        .close-modal:hover { color: #8B4545; }
        .cart-empty { text-align: center; padding: 3rem; color: #666; }
        .cart-items { margin-bottom: 2rem; }
        .cart-item { display: flex; gap: 1.5rem; padding: 1.5rem; border: 2px solid #E0E0E0; border-radius: 15px; margin-bottom: 1rem; transition: all 0.3s; }
        .cart-item:hover { border-color: #F59B9A; }
        .cart-item-image { width: 100px; height: 100px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 3rem; overflow: hidden; }
        .cart-item-image img { width: 100%; height: 100%; object-fit: cover; }
        .cart-item-details { flex: 1; }
        .cart-item-details h3 { color: #2c2c2c; margin-bottom: 0.5rem; }
        .cart-item-details p { color: #666; font-size: 0.9rem; margin: 0.3rem 0; }
        .cart-item-price { color: #8B4545; font-weight: 700; font-size: 1.3rem; }
        .cart-item-actions { display: flex; align-items: center; gap: 1rem; margin-top: 1rem; }
        .quantity-control { display: flex; align-items: center; gap: 0.5rem; }
        .quantity-btn { background: #F59B9A; color: white; border: none; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-weight: 700; transition: all 0.3s; }
        .quantity-btn:hover { background: #8B4545; }
        .quantity-display { font-weight: 600; min-width: 30px; text-align: center; }
        .remove-item { background: #FF6B6B; color: white; border: none; padding: 0.5rem 1rem; border-radius: 20px; cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .remove-item:hover { background: #FF5252; }
        .cart-summary { background: #FFF5F5; padding: 1.5rem; border-radius: 15px; margin-top: 2rem; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem; }
        .summary-row.total { font-size: 1.5rem; font-weight: 700; color: #8B4545; padding-top: 1rem; border-top: 2px solid #F59B9A; }
        .checkout-btn { background: linear-gradient(135deg, #8B4545 0%, #F59B9A 100%); color: white; border: none; padding: 1.2rem; border-radius: 30px; cursor: pointer; font-weight: 700; font-size: 1.1rem; width: 100%; margin-top: 1.5rem; transition: all 0.3s; }
        .checkout-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(139, 69, 69, 0.4); }
        
        .payment-methods { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .payment-option { padding: 1rem; border: 2px solid #E0E0E0; border-radius: 10px; text-align: center; cursor: pointer; transition: all 0.3s; }
        .payment-option:hover, .payment-option.selected { border-color: #F59B9A; background: #FFF5F5; }
        .checkout-form { margin-top: 2rem; }
        .form-section { margin-bottom: 2rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group input, .form-group textarea { width: 100%; padding: 1rem; border: 2px solid #E0E0E0; border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 1rem; transition: all 0.3s; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #F59B9A; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* Footer Styles */
        footer { background-color: #15202b; color: #ccc; padding: 40px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 16px; }
        .footer-container { display: flex; justify-content: space-between; max-width: 1100px; margin: 0 auto 30px auto; flex-wrap: wrap; }
        .footer-section { flex: 1 1 220px; margin-right: 30px; min-width: 200px; }
        .footer-section h3 { color: #f19191; font-weight: 700; margin-bottom: 15px; }
        .footer-section ul { list-style: none; padding: 0; margin: 0; }
        .footer-section ul li { margin-bottom: 8px; cursor: pointer; }
        .footer-section ul li a { text-decoration: none; color: #ccc; transition: color 0.3s; }
        .footer-section ul li a:hover { color: #f19191; }
        .footer-section p { margin-bottom: 10px; line-height: 1.5; }
        .footer-bottom { text-align: center; color: #ccc; font-size: 14px; border-top: 1px solid #33475b; padding-top: 15px; margin-top: 30px; }

        /* Media Queries */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero { flex-direction: column; text-align: center; }
            .hero h1 { font-size: 2.5rem; }
            .hero-stats { justify-content: center; }
            .gender-cards { grid-template-columns: 1fr; }
            .collection-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
            .modal-content { width: 95%; padding: 1rem; }
            .cart-item { flex-direction: column; }
            .gender-filter { flex-direction: column; }
            .hero-buttons { flex-direction: column; }
        }
        
        /* CSS untuk Order Success & Checkout */
        .order-success { text-align: center; padding: 3rem; }
        .order-success h2 { color: #4CAF50; font-size: 2.5rem; margin-bottom: 1rem; }
        .order-number { background: #FFF5F5; padding: 1rem; border-radius: 10px; font-weight: 700; color: #8B4545; font-size: 1.3rem; margin: 1rem 0; }
        .queue-number { background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); padding: 2rem; border-radius: 15px; margin: 2rem 0; color: white; }
        .queue-display { font-size: 4rem; font-weight: 800; margin: 1rem 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        .queue-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin: 2rem 0; }
        .queue-info-box { background: #FFF5F5; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #8B4545; }
        .order-summary-box { background: white; border: 2px solid #F59B9A; padding: 1.5rem; border-radius: 15px; margin: 2rem 0; text-align: left; }
        .order-item { padding: 0.8rem 0; border-bottom: 1px solid #E0E0E0; }
        .order-item:last-child { border-bottom: none; }
        .print-btn { background: white; color: #8B4545; border: 2px solid #8B4545; padding: 1rem 2rem; border-radius: 30px; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s; margin-top: 1rem; }
        .print-btn:hover { background: #8B4545; color: white; }
    </style>
</head>
<body onbeforeunload="saveCartState()">
    <!-- Bagian Header (Menggunakan Sintaks Blade untuk Link/Auth) -->
    <header>
        <nav class="navbar">
            <a href="{{ url('/') }}" class="logo">
                <span class="logo-icon">✂</span>
                <span>ZULAEHA TAILOR</span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('catalogue') }}" style="color: #F59B9A;">Catalogue</a></li>
            </ul>

            <div class="nav-actions">
                <button class="btn-cart" onclick="openCart()">
                    🛍️ <span class="cart-count" id="cartCount">0</span>
                </button>
                @auth
                    <!-- Tombol Logout dan Dashboard dipisahkan -->
                    <a href="{{ route('dashboard_redirect') }}" class="cta-button" style="background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%);">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout-outline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('user.register') }}" class="cta-button">Pesan Sekarang</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Konten Halaman (HTML) - Sama Persis seperti sebelumnya -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="badge">✨ Koleksi Terbaru 2025</div>
            <h1>Tampil Memukau<br>Dengan <span class="highlight">Busana Impian</span> Anda</h1>
            <p>Koleksi eksklusif baju formal dan non-formal untuk remaja hingga dewasa. Dibuat dengan presisi tinggi, bahan premium, dan desain yang mengikuti tren fashion terkini.</p>
            <div class="hero-stats">
                <div class="stat">
                    <h3>5000+</h3>
                    <p>Pelanggan Puas</p>
                </div>
                <div class="stat">
                    <h3>15+</h3>
                    <p>Tahun Pengalaman</p>
                </div>
                <div class="stat">
                    <h3>100%</h3>
                    <p>Kualitas Terjamin</p>
                </div>
            </div>
            <div class="hero-buttons">
                <button class="btn-primary" onclick="scrollToSection('collection')">Lihat Koleksi</button>
                <button class="btn-secondary" onclick="scrollToSection('contact')">Hubungi Kami</button>
            </div>
        </div>
    </section>

    <section id="gender-section" class="gender-section">
        <div class="gender-header">
            <h2>Pilih Kategori Anda</h2>
            <p>Koleksi lengkap untuk pria dan wanita dengan berbagai pilihan gaya</p>
        </div>
        <div class="gender-cards">
            <div class="gender-card" onclick="filterByGender('wanita')">
                <div class="gender-card-content">
                    <div class="gender-icon">👗</div>
                    <h3>Koleksi Wanita</h3>
                    <p>Dress, Kebaya, Tunik, Batik, dan lebih banyak lagi</p>
                    <button class="btn-explore">Jelajahi Koleksi</button>
                </div>
            </div>
            <div class="gender-card" onclick="filterByGender('pria')">
                <div class="gender-card-content">
                    <div class="gender-icon">🤵</div>
                    <h3>Koleksi Pria</h3>
                    <p>Kemeja, Jas, Blazer, Batik, dan lebih banyak lagi</p>
                    <button class="btn-explore">Jelajahi Koleksi</button>
                </div>
            </div>
        </div>
    </section>

    <section id="collection" class="collection">
        <div class="collection-header">
            <h2>Koleksi Premium Kami</h2>
            <p>Temukan busana yang sempurna untuk setiap momen spesial Anda</p>
        </div>

        <div class="gender-filter">
            <button class="gender-btn active" data-gender="semua" onclick="filterGender('semua')">Semua</button>
            <button class="gender-btn" data-gender="wanita" onclick="filterGender('wanita')">Wanita</button>
            <button class="gender-btn" data-gender="pria" onclick="filterGender('pria')">Pria</button>
        </div>

        <div class="category-tabs">
            <button class="tab active" data-category="semua" onclick="filterCategory('semua')">Semua</button>
            <button class="tab" data-category="formal" onclick="filterCategory('formal')">Formal</button>
            <button class="tab" data-category="casual" onclick="filterCategory('casual')">Casual</button>
            <button class="tab" data-category="batik" onclick="filterCategory('batik')">Batik</button>
            <button class="tab" data-category="premium" onclick="filterCategory('premium')">Premium</button>
        </div>

        <div class="collection-grid" id="productGrid"></div>
    </section>

    <section id="contact" class="gender-section">
        <div class="gender-header">
            <h2>Hubungi Kami</h2>
            <p>Butuh bantuan atau ingin konsultasi? Kami siap membantu Anda</p>
        </div>
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
            <p style="font-size: 1.2rem; margin-bottom: 2rem;">
                📍 Alamat: Jl. Prof. Dr. Soepomo. Lrg. Rizka No. 561, Palembang<br>
                📞 Telepon: +62 813-7367-7824<br>
                📧 Email: zulstailor@gmail.com<br>
                🕐 Jam Buka: Weekdays: 08.00 - 20.00, Weekend: 12.00 - 18.00</p>
            </p>
            <button class="btn-primary" onclick="window.open('https://wa.me/6281373677824', '_blank')">
                💬 Chat WhatsApp
            </button>
        </div>
    </section>

    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Keranjang Belanja</h2>
                <button class="close-modal" onclick="closeCart()">×</button>
            </div>
            <div id="cartContent"></div>
        </div>
    </div>

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


    <script>
        // Data Produk
        const products = [
            { id: 1, name: 'Dress Formal Elegant', price: 450000, oldPrice: 550000, category: 'formal', gender: 'wanita', rating: 4.8, reviews: 45, desc: 'Dress formal dengan detail elegan', badge: 'hot', icon: '{{ asset("assets/image/foto1.jpg") }}', bg: 'dress-bg', colors: ['black', 'navy', 'white'] },
            { id: 2, name: 'Kebaya Modern Premium', price: 750000, oldPrice: 900000, category: 'formal', gender: 'wanita', rating: 4.9, reviews: 62, desc: 'Kebaya modern dengan bordir mewah', badge: 'new', icon: '{{ asset("assets/image/foto2.jpg") }}', bg: 'kebaya-bg', colors: ['white', 'navy', 'black'] },
            { id: 3, name: 'Tunik Formal Cantik', price: 380000, oldPrice: null, category: 'formal', gender: 'wanita', rating: 4.7, reviews: 38, desc: 'Tunik formal untuk acara resmi', badge: null, icon: '👚', bg: 'tunic-bg', colors: ['black', 'white', 'navy', 'army'] },
            { id: 4, name: 'Dress Casual Chic', price: 320000, oldPrice: null, category: 'casual', gender: 'wanita', rating: 4.6, reviews: 52, desc: 'Dress casual untuk sehari-hari', badge: null, icon: '👗', bg: 'casual-bg', colors: ['white', 'black', 'navy'] },
            { id: 9, name: 'Jas Formal Executive', price: 850000, oldPrice: 1000000, category: 'formal', gender: 'pria', rating: 4.9, reviews: 67, desc: 'Jas formal untuk acara bisnis', badge: 'hot', icon: '🤵', bg: 'suit-bg', colors: ['black', 'navy', 'army'] },
            { id: 10, name: 'Kemeja Formal Premium', price: 380000, oldPrice: null, category: 'formal', gender: 'pria', rating: 4.7, reviews: 92, desc: 'Kemeja formal kualitas premium', badge: null, icon: '👔', bg: 'formal-bg', colors: ['white', 'black', 'navy'] },
            { id: 11, name: 'Blazer Formal Modern', price: 650000, oldPrice: 750000, category: 'formal', gender: 'pria', rating: 4.8, reviews: 54, desc: 'Blazer formal dengan cutting modern', badge: 'new', icon: '🧥', bg: 'blazer-bg', colors: ['navy', 'black', 'army'] },
            { id: 14, name: 'Kemeja Batik Premium', price: 420000, oldPrice: null, category: 'batik', gender: 'pria', rating: 4.8, reviews: 85, desc: 'Kemeja batik motif eksklusif', badge: 'new', icon: 'https://placehold.co/100x100/81C784/ffffff?text=BATIK', bg: 'batik-bg', colors: ['navy', 'black', 'white'] },
            { id: 16, name: 'Jas Premium Tailored', price: 1500000, oldPrice: null, category: 'premium', gender: 'pria', rating: 5.0, reviews: 31, desc: 'Jas custom tailored eksklusif', badge: 'hot', icon: 'assets/image/jas.jpg', bg: 'premium-bg', colors: ['black', 'navy', 'white'] }
        ];

        const colorNames = {
            'black': 'Hitam',
            'white': 'Putih',
            'navy': 'Biru Navy',
            'army': 'Hijau Army'
        };

        let cart = [];
        let currentGender = 'semua';
        let currentCategory = 'semua';
        
        // --- VARIABEL LARAVEL YANG DIPERLUKAN UNTUK AJAX/DB ---
        const csrfToken = '{{ csrf_token() }}';
        
        // PERBAIKAN 2: Gunakan route checkout.process
        const placeOrderUrl = '{{ route('checkout.process') }}';
        
        const isUserAuthenticated = {{ Auth::check() && Auth::user()->role === 'user' ? 'true' : 'false' }};
        const userName = '{{ Auth::user()->name ?? '' }}';
        const userEmail = '{{ Auth::user()->email ?? '' }}';
        
        // ===============================================
        // FUNGSI INTI
        // ===============================================
        
        document.addEventListener('DOMContentLoaded', function() {
            // Coba load dari localStorage
            const savedCart = localStorage.getItem('zulaehaCart');
            if (savedCart) {
                try {
                    cart = JSON.parse(savedCart);
                } catch (e) {
                    console.error("Failed to parse cart:", e);
                    cart = [];
                }
            }
            renderProducts();
            updateCartCount();
        });
        
        function saveCartState() {
            localStorage.setItem('zulaehaCart', JSON.stringify(cart));
        }

        // ===============================================
        // LOGIKA FRONTEND LAINNYA
        // ===============================================

        function renderProductImage(icon) {
            if (icon.match(/\.(jpeg|jpg|gif|png)|(https?:\/\/)/) != null) {
                return `<img src="${icon}" alt="product" style="width: 100%; height: 100%; object-fit: cover;">`;
            } else {
                return `<span style="font-size: 4rem;">${icon}</span>`;
            }
        }

        // Render Products
        function renderProducts() {
            const grid = document.getElementById('productGrid');
            const filtered = products.filter(p => {
                const genderMatch = currentGender === 'semua' || p.gender === currentGender;
                const categoryMatch = currentCategory === 'semua' || p.category === currentCategory;
                return genderMatch && categoryMatch;
            });

            grid.innerHTML = filtered.map(product => `
                <div class="product-card" data-gender="${product.gender}" data-category="${product.category}">
                    <div class="product-image ${product.bg}">
                        ${product.badge ? `<div class="product-badge ${product.badge}">${product.badge === 'hot' ? '🔥 HOT' : '✨ NEW'}</div>` : ''}
                        ${renderProductImage(product.icon)}
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5-Math.floor(product.rating))}
                            <span>(${product.reviews} ulasan)</span>
                        </div>
                        <h3>${product.name}</h3>
                        <p class="product-desc">${product.desc}</p>
                        
                        <!-- OPSI WARNA -->
                        <div class="color-select">
                            <label>Pilih Warna:</label>
                            <div class="color-options">
                                ${product.colors.map(color => `
                                    <div class="color-option color-${color}" 
                                         onclick="selectColor(this)" 
                                         title="${colorNames[color]}">
                                    </div>
                                `).join('')}
                                <div class="color-option color-custom" onclick="selectCustomColor(this)" title="Custom Warna">Custom</div>
                            </div>
                            <input type="text" class="custom-input custom-color-input" placeholder="Masukkan warna custom..." onchange="updateCustomColor(this)">
                        </div>

                        <!-- OPSI UKURAN -->
                        <div class="size-select">
                            <label>Pilih Ukuran:</label>
                            <div class="size-options">
                                <div class="size-option" onclick="selectSize(this)">S</div>
                                <div class="size-option" onclick="selectSize(this)">M</div>
                                <div class="size-option" onclick="selectSize(this)">L</div>
                                <div class="size-option" onclick="selectSize(this)">XL</div>
                                <div class="size-option" onclick="selectCustomSize(this)">Custom</div>
                            </div>
                            <input type="text" class="custom-input custom-size-input" placeholder="Masukkan ukuran custom..." onchange="updateCustomSize(this)">
                        </div>

                        <div class="product-footer">
                            <div>
                                <span class="price">Rp ${product.price.toLocaleString('id-ID')}</span>
                                ${product.oldPrice ? `<span class="old-price">Rp ${product.oldPrice.toLocaleString('id-ID')}</span>` : ''}
                            </div>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart(${product.id})">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Filter Functions
        function filterGender(gender) {
            currentGender = gender;
            document.querySelectorAll('.gender-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.gender === gender);
            });
            renderProducts();
        }

        function filterByGender(gender) {
            currentGender = gender;
            document.querySelectorAll('.gender-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.gender === gender);
            });
            scrollToSection('collection');
            renderProducts();
        }

        function filterCategory(category) {
            currentCategory = category;
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.toggle('active', tab.dataset.category === category);
            });
            renderProducts();
        }

        // Size Selection
        function selectSize(element) {
            const container = element.closest('.size-select');
            container.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            element.classList.add('selected');
            container.querySelector('.custom-size-input').classList.remove('active');
        }

        function selectCustomSize(element) {
            const container = element.closest('.size-select');
            container.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            element.classList.add('selected');
            container.querySelector('.custom-size-input').classList.add('active');
            container.querySelector('.custom-size-input').focus();
        }

        function updateCustomSize(input) { /* Placeholder */ }

        // Color Selection
        function selectColor(element) {
            const container = element.closest('.color-select');
            container.querySelectorAll('.color-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            element.classList.add('selected');
            container.querySelector('.custom-color-input').classList.remove('active');
        }

        function selectCustomColor(element) {
            const container = element.closest('.color-select');
            container.querySelectorAll('.color-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            element.classList.add('selected');
            container.querySelector('.custom-color-input').classList.add('active');
            container.querySelector('.custom-color-input').focus();
        }

        function updateCustomColor(input) { /* Placeholder */ }

        // Cart Functions
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            const productCard = event.target.closest('.product-card');
            const sizeElement = productCard.querySelector('.size-option.selected');
            const colorElement = productCard.querySelector('.color-option.selected');
            
            if (!colorElement) {
                alert('Silakan pilih warna terlebih dahulu!');
                return;
            }
            
            if (!sizeElement) {
                alert('Silakan pilih ukuran terlebih dahulu!');
                return;
            }

            // Handle Size
            let size = sizeElement.textContent;
            if (size === 'Custom') {
                const customSizeInput = productCard.querySelector('.custom-size-input');
                if (!customSizeInput.value.trim()) {
                    alert('Silakan masukkan detail ukuran custom Anda!');
                    customSizeInput.focus();
                    return;
                }
                size = `Custom: ${customSizeInput.value.trim()}`;
            }

            // Handle Color
            let color = '';
            let colorDisplayName = '';
            
            if (colorElement.classList.contains('color-custom')) {
                const customColorInput = productCard.querySelector('.custom-color-input');
                if (!customColorInput.value.trim()) {
                    alert('Silakan masukkan detail warna custom Anda!');
                    customColorInput.focus();
                    return;
                }
                color = 'custom';
                colorDisplayName = `Custom: ${customColorInput.value.trim()}`;
            } else {
                const colorClass = Array.from(colorElement.classList).find(c => c.startsWith('color-'));
                color = colorClass.replace('color-', '');
                colorDisplayName = colorNames[color];
            }

            const cartItem = cart.find(item => item.id === productId && item.size === size && item.color === color);

            if (cartItem) {
                cartItem.quantity += 1;
            } else {
                cart.push({
                    ...product,
                    size: size,
                    color: color,
                    colorDisplay: colorDisplayName,
                    quantity: 1
                });
            }

            // Simpan perubahan cart ke localStorage
            saveCartState(); 
            updateCartCount();
            alert(`✅ ${product.name} (${colorDisplayName}, ${size}) berhasil ditambahkan ke keranjang!`);
        }

        function updateCartCount() {
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cartCount').textContent = count;
        }

        function openCart() {
            document.getElementById('cartModal').classList.add('active');
            renderCart();
        }

        function closeCart() {
            document.getElementById('cartModal').classList.remove('active');
        }

        function renderCart() {
            const content = document.getElementById('cartContent');
            
            if (cart.length === 0) {
                content.innerHTML = '<div class="cart-empty"><p>Keranjang belanja Anda kosong</p></div>';
                return;
            }

            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            content.innerHTML = `
                <div class="cart-items">
                    ${cart.map((item, index) => `
                        <div class="cart-item">
                            <div class="cart-item-image ${item.bg}">
                                ${renderProductImage(item.icon)}
                            </div>
                            <div class="cart-item-details">
                                <h3>${item.name}</h3>
                                <p>Warna: ${item.colorDisplay}</p>
                                <p>Ukuran: ${item.size}</p>
                                <p class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</p>
                                <div class="cart-item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</button>
                                        <span class="quantity-display">${item.quantity}</span>
                                        <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                                    </div>
                                    <button class="remove-item" onclick="removeFromCart(${index})">Hapus</button>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="summary-row">
                        <span>Pajak (10%):</span>
                        <span>Rp ${tax.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>Rp ${total.toLocaleString('id-ID')}</span>
                    </div>
                    <button class="checkout-btn" onclick="showCheckoutForm()">Lanjut ke Pembayaran</button>
                </div>
            `;
        }

        function updateQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            saveCartState(); 
            updateCartCount();
            renderCart();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            saveCartState(); 
            updateCartCount();
            renderCart();
        }

        function showCheckoutForm() {
            if (!isUserAuthenticated) {
                alert('Silakan login sebagai pelanggan untuk melanjutkan pembayaran.');
                // Redirect ke halaman login user (route('user.login'))
                window.location.href = '{{ route('user.login') }}';
                return;
            }
            
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            const content = document.getElementById('cartContent');
            
            content.innerHTML = `
                <div class="checkout-form">
                    <form onsubmit="processOrder(event)">
                        <!-- PERBAIKAN 3: Kirim data manual via fetch JSON, hidden input ini hanya backup -->
                        <input type="hidden" name="payment_method" id="paymentMethodInput" value="Transfer Bank">
                        
                        <div style="text-align: right; font-size: 1.5rem; color: #8B4545; font-weight: 700; margin-bottom: 2rem;">Total: Rp ${total.toLocaleString('id-ID')}</div>

                        <div class="form-section">
                            <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #2c2c2c;">Informasi Pelanggan</h3>
                            <div class="form-group"><label style="display: block; font-size: 0.9rem; color: #666;">Nama Lengkap *</label><input type="text" name="name" required placeholder="Masukkan nama lengkap" value="${userName}"></div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group"><label style="display: block; font-size: 0.9rem; color: #666;">Email *</label><input type="email" name="email" required placeholder="email@example.com" value="${userEmail}"></div>
                                <div class="form-group"><label style="display: block; font-size: 0.9rem; color: #666;">Nomor Telepon (WA) *</label><input type="tel" name="phone" required placeholder="08123456789"></div>
                            </div>
                            <div class="form-group"><label style="display: block; font-size: 0.9rem; color: #666;">Alamat Lengkap *</label><textarea name="address" required rows="3" placeholder="Masukkan alamat lengkap"></textarea></div>
                            <div class="form-group"><label style="display: block; font-size: 0.9rem; color: #666;">Catatan (Opsional)</label><textarea name="note" rows="2" placeholder="Tambahkan catatan untuk penjahit..."></textarea></div>
                        </div>

                        <div class="form-section" style="margin-top: 2rem;">
                            <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #2c2c2c;">Metode Pembayaran</h3>
                            <div class="payment-methods">
                                <div class="payment-option selected" onclick="selectPayment(this)" data-method="Transfer Bank">
                                    <strong>Transfer Bank</strong>
                                    <p style="font-size: 0.8rem; color: #666;">BCA, Mandiri, BNI</p>
                                </div>
                                <div class="payment-option" onclick="selectPayment(this)" data-method="E-Wallet">
                                    <strong>E-Wallet</strong>
                                    <p style="font-size: 0.8rem; color: #666;">OVO, GoPay, Dana</p>
                                </div>
                                <div class="payment-option" onclick="selectPayment(this)" data-method="COD (Bayar di Tempat)">
                                    <strong>COD</strong>
                                    <p style="font-size: 0.8rem; color: #666;">Bayar di Tempat</p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="checkout-btn" id="confirmOrderBtn">Konfirmasi Pesanan</button>
                    </form>
                </div>
            `;
        }

        function selectPayment(element) {
            document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('paymentMethodInput').value = element.getAttribute('data-method');
        }

        // [4] FUNGSI AJAX UNTUK MEMPROSES ORDER KE DATABASE
        async function processOrder(event) {
            event.preventDefault();
            
            const confirmBtn = document.getElementById('confirmOrderBtn');
            confirmBtn.innerHTML = 'Memproses...';
            confirmBtn.disabled = true;

            const formData = new FormData(event.target);
            
            // Hitung total lagi untuk validasi
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            // PERBAIKAN 4: Kirim sebagai JSON Object, bukan FormData
            // Agar array cart terbaca dengan benar di Laravel
            const payload = {
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                address: formData.get('address'),
                note: formData.get('note'),
                payment_method: document.getElementById('paymentMethodInput').value, // FIX: AMBIL DARI HIDDEN INPUT
                cart: cart, // Kirim array cart langsung
                total_price: total
            };

            try {
                const response = await fetch(placeOrderUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Penting: Kirim sebagai JSON
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    body: JSON.stringify(payload)
                });
                
                const result = await response.json();
                
                if (response.ok && result.success) {
                    showOrderSuccess(result, payload.name, payload.email, payload.phone, payload.note);
                } else {
                    let errorMessage = 'Gagal memproses pesanan.';
                    if (result.message) {
                        errorMessage = result.message;
                    } else if (result.error) {
                        errorMessage = result.error;
                    }
                    
                    alert('Gagal: ' + errorMessage);
                    confirmBtn.innerHTML = 'Konfirmasi Pesanan';
                    confirmBtn.disabled = false;
                }
            } catch (error) {
                console.error('AJAX Error:', error);
                alert('Terjadi kesalahan koneksi saat memproses pesanan. Pastikan Server Laravel berjalan.');
                confirmBtn.innerHTML = 'Konfirmasi Pesanan';
                confirmBtn.disabled = false;
            }
        }
        
        function showOrderSuccess(orderData, customerName, customerEmail, customerPhone, customerNote) {
            // Simpan data order saat ini sebelum cart di-reset (untuk dicetak)
            window.currentOrder = {
                orderNumber: orderData.order_number,
                queueNumber: orderData.queue_number,
                customerName,
                customerPhone,
                customerEmail,
                customerNote, 
                orderDate: new Date(),
                estimatedDate: orderData.estimated_date || '-', // Handle jika backend tidak kirim estimasi
                cart: [...cart],
                total: orderData.total_price || 0,
                subtotal: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0),
                tax: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) * 0.1,
            };
            
            // Clear cart data globally
            cart = [];
            saveCartState(); 
            updateCartCount();

            const content = document.getElementById('cartContent');
            
            content.innerHTML = `
                <div class="order-success">
                    <h2>✅ Pesanan Berhasil Dibuat!</h2>
                    <p style="font-size: 1.1rem; color: #666; margin: 1rem 0;">Terima kasih atas pesanan Anda</p>
                    
                    <div class="queue-number">
                        <h3>NOMOR ANTRIAN ANDA</h3>
                        <div class="queue-display">#${orderData.queue_number}</div>
                        <p style="opacity: 0.9;">Simpan nomor ini untuk pengambilan/pelacakan pesanan</p>
                    </div>
                    
                    <div class="order-summary-box">
                        <h3>📋 Ringkasan & Detail</h3>
                        <div style="margin-top: 1rem;">
                            <p><strong>Kode Pesanan:</strong> ${orderData.order_number}</p>
                            <p><strong>Total Bayar:</strong> Rp ${parseInt(window.currentOrder.total).toLocaleString('id-ID')}</p>
                            <p><strong>Metode Bayar:</strong> ${document.getElementById('paymentMethodInput').value}</p>
                        </div>
                        ${customerNote ? `
                        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #E0E0E0;">
                            <strong>📝 Catatan:</strong> <br>
                            <span style="color: #666;">${customerNote}</span>
                        </div>` : ''}
                    </div>
                    
                    <div style="background: #FFF9E6; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #FFB300; margin: 2rem 0; text-align: left;">
                        <h4 style="color: #FFB300; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span>⚠️</span> Hubungi Kami
                        </h4>
                        <p style="color: #666;">Kami akan segera menghubungi Anda di <strong>${customerPhone}</strong> untuk konfirmasi detail pesanan.</p>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem;">
                        <button class="print-btn" onclick="printOrder()">🖨️ Cetak Bukti</button>
                        <button class="checkout-btn" style="width: auto; padding: 1rem 2rem; background: #4CAF50;" onclick="finishOrder()">Selesai & Lanjut</button>
                    </div>
                </div>
            `;
        }

        function printOrder() {
            // Menggunakan data yang disimpan di window.currentOrder
            const order = window.currentOrder;
            if (!order) {
                alert("Data pesanan tidak ditemukan untuk dicetak.");
                return;
            }
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Bukti Pesanan - Zulaeha Tailor</title>
                    <style>
                        body {
                            font-family: 'Courier New', monospace;
                            max-width: 80mm;
                            margin: 0 auto;
                            padding: 10px;
                        }
                        .header {
                            text-align: center;
                            border-bottom: 2px dashed #000;
                            padding-bottom: 10px;
                            margin-bottom: 10px;
                        }
                        .queue {
                            text-align: center;
                            font-size: 24px;
                            font-weight: bold;
                            margin: 20px 0;
                            padding: 15px;
                            border: 3px solid #000;
                        }
                        .info { margin: 5px 0; }
                        .item { 
                            margin: 10px 0;
                            padding: 5px 0;
                            border-bottom: 1px dashed #ccc;
                        }
                        .total {
                            margin-top: 10px;
                            padding-top: 10px;
                            border-top: 2px solid #000;
                            font-weight: bold;
                        }
                        .footer {
                            text-align: center;
                            margin-top: 20px;
                            padding-top: 10px;
                            border-top: 2px dashed #000;
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h2>ZULAEHA TAILOR</h2>
                        <p>Jl. Prof. Dr. Soepomo. Lrg. Rizka No. 561, Palembang</p>
                    </div>
                    
                    <div class="queue">
                        ANTRIAN #${order.queueNumber}
                    </div>
                    
                    <div class="info">
                        <strong>No. Pesanan:</strong> ${order.orderNumber}<br>
                        <strong>Tanggal:</strong> ${order.orderDate.toLocaleDateString('id-ID')}<br>
                        <strong>Nama:</strong> ${order.customerName}<br>
                        <strong>Telepon:</strong> ${order.customerPhone}<br>
                        ${order.customerNote ? `<strong>Catatan:</strong> ${order.customerNote}` : ''}
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <strong>RINCIAN PESANAN:</strong>
                        ${order.cart.map(item => `
                            <div class="item">
                                <div>${item.name} (${item.colorDisplay}, ${item.size})</div>
                                <div style="display: flex; justify-content: space-between; font-size: 12px;">
                                    <span>${item.quantity}x @ Rp ${item.price.toLocaleString('id-ID')}</span>
                                    <span>Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    
                    <div class="total">
                        <div>Subtotal: Rp ${order.subtotal.toLocaleString('id-ID')}</div>
                        <div>Pajak (10%): Rp ${order.tax.toLocaleString('id-ID')}</div>
                        <div style="font-size: 16px; margin-top: 5px;">
                            TOTAL BAYAR: Rp ${parseInt(order.total).toLocaleString('id-ID')}
                        </div>
                    </div>
                    
                    <div class="footer">
                        <p>Terima kasih atas kepercayaan Anda!</p>
                        <p style="font-size: 12px;">Simpan bukti ini untuk konfirmasi pesanan</p>
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        function finishOrder() {
            closeCart();
            // Redirect ke halaman dashboard user setelah selesai
            window.location.href = 'catalogue';
        }

        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            const offset = 80;
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }

        // Close modal when clicking outside
        document.getElementById('cartModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCart();
            }
        });
    </script>
</body>
</html>