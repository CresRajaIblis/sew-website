<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zulaeha Tailor - Baju Formal & Non-Formal Premium</title>
    
    <!-- PENTING: Token Keamanan Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* =========================================
           CSS ASLI (TIDAK BERUBAH)
           ========================================= */
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
        .product-tag { position: absolute; top: 10px; right: 10px; background: #8B4545; color: white; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .product-tag.hot { background: #FF6B6B; }
        .product-tag.sale { background: #FF9800; }
        
        .floating-elements { position: absolute; width: 100%; height: 100%; pointer-events: none; }
        .float-element { position: absolute; font-size: 2rem; animation: float 3s ease-in-out infinite; }
        .el-1 { top: 10%; left: 5%; animation-delay: 0s; }
        .el-2 { top: 30%; right: 10%; animation-delay: 1s; }
        .el-3 { bottom: 20%; left: 15%; animation-delay: 2s; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }

        /* Features */
        .features { padding: 3rem 5%; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; max-width: 1400px; margin: 0 auto; }
        .feature-card { background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(245, 155, 154, 0.2); }
        .feature-icon { font-size: 3rem; margin-bottom: 1rem; }
        .feature-card h3 { color: #8B4545; margin-bottom: 0.5rem; }
        .feature-card p { color: #666; font-size: 0.9rem; }

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
        .about-feature-item p { color: #666; font-size: 0.9rem; margin: 0; }

        /* Collection */
        .collection { padding: 5rem 5%; background: linear-gradient(180deg, #8B4545 0%, #723636 100%); }
        .collection-header { text-align: center; color: white; margin-bottom: 3rem; }
        .collection-header h2 { font-size: 3rem; margin-bottom: 1rem; font-weight: 800; }
        .collection-header p { font-size: 1.1rem; opacity: 0.9; }
        .category-tabs { display: flex; justify-content: center; gap: 1rem; margin: 3rem 0; flex-wrap: wrap; }
        .tab { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.3); padding: 0.8rem 1.8rem; border-radius: 30px; cursor: pointer; font-weight: 600; transition: all 0.3s; backdrop-filter: blur(10px); }
        .tab.active, .tab:hover { background: #F59B9A; border-color: #F59B9A; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 155, 154, 0.3); }
        .collection-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin: 4rem 0; max-width: 1400px; margin: 0 auto; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; transition: all 0.3s; cursor: pointer; position: relative; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
        .product-image { height: 350px; position: relative; overflow: hidden; background-color: #eee; }
        .formal-bg { background: linear-gradient(135deg, #E3F2FD 0%, #90CAF9 100%); }
        .premium-bg { background: linear-gradient(135deg, #FFF3E0 0%, #FFB74D 100%); }
        .casual-bg { background: linear-gradient(135deg, #F3E5F5 0%, #CE93D8 100%); }
        .dress-bg { background: linear-gradient(135deg, #FCE4EC 0%, #F48FB1 100%); }
        .batik-bg { background: linear-gradient(135deg, #E8F5E9 0%, #81C784 100%); }
        .suit-bg { background: linear-gradient(135deg, #EFEBE9 0%, #A1887F 100%); }
        .product-badge { position: absolute; top: 15px; left: 15px; background: #8B4545; color: white; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.8rem; font-weight: 600; z-index: 2; }
        .product-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; opacity: 0; transition: all 0.3s; }
        .product-card:hover .product-overlay { opacity: 1; }
        .btn-quick-view, .btn-add-cart { background: white; color: #8B4545; border: none; padding: 0.8rem 1.5rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .btn-add-cart { background: #F59B9A; color: white; }
        .btn-quick-view:hover, .btn-add-cart:hover { transform: scale(1.05); }
        .product-info { padding: 1.5rem; }
        .product-rating { color: #FFB300; font-size: 0.9rem; margin-bottom: 0.5rem; }
        .product-info h3 { color: #2c2c2c; font-size: 1.2rem; margin-bottom: 0.5rem; }
        .product-desc { color: #666; font-size: 0.9rem; margin-bottom: 1rem; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; }
        .price { color: #8B4545; font-weight: 700; font-size: 1.5rem; }
        .old-price { color: #999; text-decoration: line-through; font-size: 1rem; font-weight: 400; margin-left: 0.5rem; }
        .btn-wishlist { background: transparent; border: 2px solid #F59B9A; color: #F59B9A; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1.2rem; transition: all 0.3s; }
        .btn-wishlist:hover { background: #F59B9A; color: white; }
        .view-all-btn { display: inline-block; text-decoration: none; text-align: center; margin: 3rem auto 0; background: white; color: #8B4545; border: none; padding: 1.2rem 3rem; border-radius: 30px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s; }
        .view-all-btn:hover { transform: scale(1.05); box-shadow: 0 5px 20px rgba(255,255,255,0.3); }

        /* Promo */
        .special-promo { padding: 5rem 5%; display: flex; align-items: center; gap: 5rem; background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 100%); }
        .promo-content { flex: 1; }
        .promo-label { display: inline-block; background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); color: white; padding: 0.6rem 1.5rem; border-radius: 25px; font-weight: 600; margin-bottom: 1.5rem; }
        .promo-content h2 { font-size: 3rem; margin-bottom: 1.5rem; line-height: 1.3; font-weight: 800; }
        .promo-content p { color: #666; line-height: 1.9; margin-bottom: 2rem; font-size: 1.05rem; }
        .promo-features { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin: 2rem 0; }
        .promo-feature { color: #2c2c2c; font-weight: 500; }
        .promo-price { display: flex; align-items: center; gap: 1rem; margin: 2rem 0; }
        .big-price { font-size: 3rem; color: #8B4545; font-weight: 800; }
        .original-price { color: #999; text-decoration: line-through; font-size: 1.3rem; }
        .discount-badge { background: #FF6B6B; color: white; padding: 0.5rem 1rem; border-radius: 20px; font-weight: 700; }
        .btn-primary-large { background: linear-gradient(135deg, #8B4545 0%, #F59B9A 100%); text-decoration: none; display: inline-block; color: white; border: none; padding: 1.5rem 3rem; border-radius: 35px; cursor: pointer; font-weight: 700; font-size: 1.1rem; transition: all 0.3s; box-shadow: 0 8px 25px rgba(139, 69, 69, 0.3); width: 100%; max-width: 500px; }
        .btn-primary-large:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(139, 69, 69, 0.4); }
        .urgency-text { margin-top: 1.5rem; color: #666; font-size: 0.95rem; }
        .urgency-text strong { color: #FF6B6B; font-size: 1.2rem; }
        .promo-image { flex: 1; position: relative; }
        .suit-showcase { display: flex; flex-wrap: wrap; gap: 1.5rem; }
        .suit-item { background: transparent; padding: 0; border-radius: 20px; flex: 1; min-width: 200px; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden; transition: all 0.3s; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .suit-item:hover { transform: scale(1.05); }
        .floating-discount { position: absolute; top: -20px; right: -20px; }
        .discount-circle { width: 120px; height: 120px; background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4); animation: pulse 2s ease-in-out infinite; }
        .discount-text { color: white; font-weight: 800; font-size: 1.8rem; text-align: center; line-height: 1.2; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }

        /* Testimonial */
        .testimonial { padding: 5rem 5%; background: white; }
        .testimonial-header { text-align: center; margin-bottom: 4rem; }
        .testimonial-header h2 { font-size: 3rem; color: #2c2c2c; margin-bottom: 1rem; font-weight: 800; }
        .testimonial-header p { color: #666; font-size: 1.1rem; }
        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; max-width: 1400px; margin: 0 auto; }
        .testimonial-card { background: linear-gradient(135deg, #FFF5F5 0%, #FFE8E8 100%); padding: 2.5rem; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s; }
        .testimonial-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(245, 155, 154, 0.2); }
        .testimonial-rating { color: #FFB300; font-size: 1.2rem; margin-bottom: 1rem; }
        .testimonial-card p { color: #2c2c2c; line-height: 1.8; margin-bottom: 1.5rem; font-style: italic; }
        .testimonial-author { display: flex; align-items: center; gap: 1rem; }
        .author-avatar { width: 50px; height: 50px; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.2rem; }
        .author-info h4 { color: #2c2c2c; margin-bottom: 0.2rem; }
        .author-info span { color: #666; font-size: 0.85rem; }

        /* Member */
        .member { padding: 5rem 5%; background: linear-gradient(135deg, #8B4545 0%, #723636 100%); color: white; }
        .member-content { max-width: 900px; margin: 0 auto; text-align: center; }
        .member h2 { font-size: 3rem; margin-bottom: 1.5rem; font-weight: 800; }
        .highlight-white { color: #FFE8E8; }
        .member > p { font-size: 1.1rem; margin-bottom: 2.5rem; opacity: 0.95; }
        .member-benefits { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin: 2.5rem 0; text-align: left; }
        .benefit { background: rgba(255,255,255,0.1); padding: 1rem 1.5rem; border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); }
        .member-form { display: grid; gap: 1rem; margin: 3rem 0 1.5rem; }
        .member-form input { padding: 1.2rem 1.8rem; border: none; border-radius: 30px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
        .btn-join { background: linear-gradient(135deg, #F59B9A 0%, #FFB74D 100%); text-decoration: none; display: inline-block; color: white; border: none; padding: 1.5rem; border-radius: 30px; cursor: pointer; font-weight: 700; font-size: 1.1rem; transition: all 0.3s; box-shadow: 0 6px 20px rgba(245, 155, 154, 0.4); }
        .btn-join:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(245, 155, 154, 0.5); }
        .member-note { font-size: 0.9rem; opacity: 0.8; }

        /* Contact */
        .contact { padding: 5rem 5%; display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; max-width: 1400px; margin: 0 auto; }
        .contact-info h2 { font-size: 2.5rem; color: #2c2c2c; margin-bottom: 1rem; font-weight: 800; }
        .contact-info > p { color: #666; margin-bottom: 2.5rem; }
        .contact-details { display: flex; flex-direction: column; gap: 2rem; }
        .contact-item { display: flex; align-items: flex-start; gap: 1.5rem; }
        .contact-icon { font-size: 2rem; background: linear-gradient(135deg, #F59B9A 0%, #8B4545 100%); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contact-item h4 { color: #2c2c2c; margin-bottom: 0.5rem; }
        .contact-item p { color: #666; line-height: 1.8; }
        .contact-form-section h3 { font-size: 2rem; color: #2c2c2c; margin-bottom: 1.5rem; }
        .contact-form { display: flex; flex-direction: column; gap: 1.2rem; }
        .contact-form input, .contact-form textarea { padding: 1.2rem 1.5rem; border: 2px solid #E0E0E0; border-radius: 15px; font-size: 1rem; font-family: 'Poppins', sans-serif; transition: all 0.3s; }
        .contact-form input:focus, .contact-form textarea:focus { outline: none; border-color: #F59B9A; box-shadow: 0 0 0 3px rgba(245, 155, 154, 0.1); }
        .contact-form textarea { resize: vertical; }

        /* Cart Modal */
        .modal { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; }
        .modal.active { display: flex; } /* Tambahkan ini agar modal bisa aktif */
        .modal-content { background-color: white; padding: 2rem; border-radius: 15px; width: 90%; max-width: 500px; position: relative; max-height: 80vh; overflow-y: auto; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666; }

        /* Footer */
        footer { background-color: #15202b; color: #ccc; padding: 40px 20px; font-family: 'Poppins', sans-serif; font-size: 16px; }
        .footer-container { display: flex; justify-content: space-between; max-width: 1100px; margin: 0 auto 30px auto; flex-wrap: wrap; }
        .footer-section { flex: 1 1 220px; margin-right: 30px; min-width: 200px; }
        .footer-section h3 { color: #f19191; font-weight: 700; margin-bottom: 15px; }
        .footer-section ul { list-style: none; padding: 0; margin: 0; }
        .footer-section ul li { margin-bottom: 8px; cursor: pointer; }
        .footer-section ul li a { color: #ccc; text-decoration: none; }
        .footer-section ul li a:hover { color: white; }
        .footer-section p { margin-bottom: 10px; line-height: 1.5; }
        .footer-bottom { text-align: center; color: #ccc; font-size: 14px; border-top: 1px solid #33475b; padding-top: 15px; margin-top: 30px; }
        
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero { flex-direction: column; text-align: center; }
            .hero h1 { font-size: 2.5rem; }
        }
    </style>
</head>
<body onbeforeunload="saveCartState()">
    <!-- Header -->
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
            
            <!-- NAV ACTIONS DARI CATALOGUE -->
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
                    <a href="{{ route('user.login') }}" class="cta-button">Masuk / Daftar</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
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
                <a href="#collection-section" class="btn-primary">Lihat Koleksi</a>
                <a href="#contact-section" class="btn-secondary">📞 Hubungi Kami</a>
            </div>
        </div>
       <div class="hero-image">
            <div class="image-card card-1">
               <div class="product-preview" style="position: relative;">
                <img src="{{ asset('assets/image/foto1.jpg') }}" alt="Kemeja Premium" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; z-index: 1;">
                <div class="product-tag" style="position: absolute; top: 10px; right: 10px; z-index: 2;">New</div>
                <h4 style="position: absolute; bottom: 50px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Kemeja Premium</h4>
                <p class="product-price" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 450.000</p>
                </div>
            </div>
            <div class="image-card card-2">
                <div class="product-preview" style="position: relative;">
                    <div class="product-tag hot" style="position: absolute; top: 10px; right: 10px; z-index: 2;">Hot</div>
                <img src="{{ asset('assets/image/foto2.jpg') }}" alt="Blazer Elegant" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; z-index: 1;">
                <h4 style="position: absolute; bottom: 50px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; margin-bottom: 10px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Blazer Elegant</h4>
                <p class="product-price" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 850.000</p>
            </div>
            </div>
            <div class="image-card card-3">
                <div class="product-preview" style="position: relative;">
                <div class="product-tag" style="position: absolute; top: 10px; right: 10px; z-index: 2;">Sale</div>
                <img src="{{ asset('assets/image/foto3.jpg') }}" alt="Dress Casual" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; z-index: 1;">
                <h4 style="position: absolute; bottom: 50px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; margin-bottom: 10px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Dress Casual</h4>
                <p class="product-price" style="position: absolute; bottom: 15px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 380.000</p>
            </div>
            </div>
        </div>
        <div class="floating-elements">
            <div class="float-element el-1">⭐</div>
            <div class="float-element el-2">✨</div>
            <div class="float-element el-3">🌟</div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="feature-card">
            <div class="feature-icon">✂️</div>
            <h3>Custom Tailoring</h3>
            <p>Jahit sesuai ukuran dan keinginan Anda</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎨</div>
            <h3>Desain Modern</h3>
            <p>Mengikuti tren fashion terkini</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏆</div>
            <h3>Bahan Premium</h3>
            <p>Kualitas terbaik untuk kenyamanan maksimal</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🚚</div>
            <h3>Pengiriman Cepat</h3>
            <p>Gratis ongkir untuk pembelian tertentu</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-image">
            <div class="about-img-wrapper">
                <div class="about-badge">15+ Tahun Berpengalaman</div>
                <div class="image-showcase">
                    <img src="{{ asset('assets/image/ukuran.png') }}" alt="Formal Wear Collection" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                </div>
            </div>
        </div>
        <div class="about-content">
            <span class="section-label">💼 Tentang Kami</span>
            <h2>Menciptakan <span class="highlight">Kepercayaan Diri</span><br>Melalui Busana Berkualitas</h2>
            <p>Zulaeha Tailor telah melayani ribuan pelanggan dengan dedikasi penuh selama lebih dari 15 tahun. Kami memahami bahwa setiap momen spesial membutuhkan busana yang sempurna.</p>
            <div class="about-features">
                <div class="about-feature-item">
                    <span class="check-icon">✓</span>
                    <div>
                        <h4>Kualitas Terjamin</h4>
                        <p>Setiap produk melalui quality control ketat</p>
                    </div>
                </div>
                <div class="about-feature-item">
                    <span class="check-icon">✓</span>
                    <div>
                        <h4>Desain Eksklusif</h4>
                        <p>Koleksi unik dan tidak pasaran</p>
                    </div>
                </div>
                <div class="about-feature-item">
                    <span class="check-icon">✓</span>
                    <div>
                        <h4>Harga Kompetitif</h4>
                        <p>Kualitas premium dengan harga terjangkau</p>
                    </div>
                </div>
            </div>
            <div class="hero-buttons">
            <a href="#contact-section" class="btn-primary">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- Collection Section -->
    <section class="collection" id="collection-section">
        <div class="collection-header">
            <h2>Koleksi Terbaru Kami</h2>
            <p>Temukan busana yang sempurna untuk setiap momen Anda</p>
        </div>
        
        <div class="category-tabs">
            <button class="tab active" data-category="all">Semua Produk</button>
            <button class="tab" data-category="formal">👔 Formal</button>
            <button class="tab" data-category="casual">👕 Casual</button>
            <button class="tab" data-category="premium">⭐ Premium</button>
            <button class="tab" data-category="new">🆕 Terbaru</button>
        </div>

        <div class="collection-grid" id="productContainer"></div>

        <center>
            <a href="{{ route('catalogue') }}" class="view-all-btn">Lihat Semua Koleksi →</a>
        </center>
    </section>

    <!-- Special Promo Section -->
    <section class="special-promo">
        <div class="promo-content">
            <span class="promo-label">🔥 Penawaran Spesial Hari Ini</span>
            <h2>Koleksi Eksklusif<br><span class="highlight">Premium Suit</span><br>Edisi Terbatas</h2>
            <p>Dapatkan suit premium kami dengan desain eksklusif dan bahan berkualitas tinggi. Cocok untuk wedding, meeting penting, atau acara formal lainnya. Limited stock - hanya tersedia 50 set!</p>
            <div class="promo-features">
                <div class="promo-feature">✓ Bahan Wool Premium Import</div>
                <div class="promo-feature">✓ Custom Fit Guarantee</div>
                <div class="promo-feature">✓ Free Alterations (3x)</div>
                <div class="promo-feature">✓ Complimentary Tie & Pocket Square</div>
            </div>
            <div class="promo-price">
                <span class="big-price">Rp 1.850.000</span>
                <span class="original-price">Rp 2.500.000</span>
                <span class="discount-badge">Hemat 26%</span>
            </div>
            <a href="{{ route('user.register') }}" class="btn-primary-large">Pesan Sekarang - Stock Terbatas!</a>
            <div class="urgency-text">⏰ Penawaran berakhir dalam: <strong>23:45:12</strong></div>
        </div>
        <div class="promo-image">
            <div class="suit-showcase">
                <div class="suit-item item-1">
                    <img src="{{ asset('assets/image/promo1.jpg') }}" alt="Premium Jacket" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                </div>
                <div class="suit-item item-2">
                    <img src="{{ asset('assets/image/promo2.jpg') }}" alt="Premium Jacket" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                </div>
                <div class="suit-item item-3">
                    <img src="{{ asset('assets/image/promo3.jpg') }}" alt="Vest & Accessories" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                </div>
            </div>
            <div class="floating-discount">
                <div class="discount-circle">
                    <span class="discount-text">26%<br>OFF</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial">
        <div class="testimonial-header">
            <h2>Apa Kata Pelanggan Kami</h2>
            <p>Kepuasan pelanggan adalah prioritas utama kami</p>
        </div>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                <p>"Kualitas jahitan sangat rapi dan bahannya premium! Saya sudah pesan 5 kemeja di sini dan semua hasilnya memuaskan. Highly recommended!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">AR</div>
                    <div class="author-info">
                        <h4>Ahmad Rizki</h4>
                        <span>Manager Marketing</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                <p>"Blazer yang saya beli untuk wedding teman sangat sempurna! Potongannya pas di badan dan bahannya nyaman. Terima kasih Zulaeha Tailor!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">DS</div>
                    <div class="author-info">
                        <h4>Dinda Sari</h4>
                        <span>Entrepreneur</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-rating">⭐⭐⭐⭐⭐</div>
                <p>"Pelayanannya ramah, proses cepat, dan hasil jahitan sangat memuaskan. Harga juga masih reasonable untuk kualitas yang didapat. Pasti langganan di sini!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">BP</div>
                    <div class="author-info">
                        <h4>Budi Prasetyo</h4>
                        <span>Software Engineer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Member Section -->
    <section class="member">
        <div class="member-content">
            <h2>Bergabung dengan Member Eksklusif<br>Dapatkan Diskon hingga <span class="highlight-white">35%</span></h2>
            <p>Nikmati berbagai keuntungan eksklusif sebagai member Zulaeha Tailor</p>
            <div class="member-benefits">
                <div class="benefit">✓ Diskon hingga 35% untuk semua produk</div>
                <div class="benefit">✓ Early access untuk koleksi terbaru</div>
                <div class="benefit">✓ Free alterations selamanya</div>
                <div class="benefit">✓ Birthday special gift</div>
                <div class="benefit">✓ Priority customer service</div>
            </div>
            <div class="member-form">
                <input type="text" placeholder="Nama Lengkap">
                <input type="email" placeholder="Email Address">
                <input type="tel" placeholder="Nomor WhatsApp">
                <a href="{{ route('user.register') }}" class="btn-join">Daftar Sekarang - GRATIS!</a>
            </div>
            <p class="member-note">*Keanggotaan gratis selamanya. Tidak ada biaya tersembunyi.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact-section">
        <div class="contact-info">
            <h2>Hubungi Kami</h2>
            <p>Kami siap membantu Anda menemukan busana impian</p>
            <div class="contact-details">
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <div>
                        <h4>Alamat Toko</h4>
                        <p>Jl. Prof. Dr. Soepomo. Lrg. Rizka No. 561<br>Palembang, Sumatera Selatan</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <div>
                        <h4>Telepon</h4>
                        <p>+62 813-7367-7824</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📧</span>
                    <div>
                        <h4>Email</h4>
                        <p>zulstailor@gmail.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">⏰</span>
                    <div>
                        <h4>Jam Operasional</h4>
                        <p>Senin - Jumat: 08.00 - 20.00<br>Sabtu - Minggu: 12.00 - 18.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form-section">
            <h3>Kirim Pesan</h3>
            <form class="contact-form">
                <input type="text" placeholder="Nama Anda" required>
                <input type="email" placeholder="Email" required>
                <input type="tel" placeholder="Nomor WhatsApp" required>
                <textarea placeholder="Pesan Anda..." rows="5" required></textarea>
                <button type="submit" class="btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Cart Modal -->
    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Keranjang Belanja</h2>
                <button class="close-modal" onclick="closeCart()">×</button>
            </div>
            <div id="cartContent">
                <!-- Isi cart akan dirender di sini oleh JavaScript -->
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Tentang Zulaeha Taylor</h3>
            <p>Menyediakan busana berkualitas permium dengan desain modern dan elegan sejak 2010.</p>
        </div>
        <div class="footer-section">
            <h3>Link Cepat</h3>
            <ul>
                <li><a href="#home">Home</a></li> 
                
                <li><a href="#collection-section">Kategori</a></li> 
                
                <li><a href="#collection-section">Koleksi</a></li> 
                
                <li><a href="#contact-section">Kontak</a></li> 
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

    <!-- LOGIKA JAVASCRIPT UTAMA (DIPERBARUI DENGAN LOGIKA CART DARI CATALOGUE) -->
    <script>
        // 1. DATA DARI CONTROLLER (DINAMIS)
        // Catatan: Karena ini halaman Home, saya hanya menggunakan produk dummy. 
        // Anda harus memastikan variabel $products tersedia di controller yang me-load view ini.
        const products = [
            { id: 1, name: 'Dress Formal Elegant', price: 450000, oldPrice: 550000, category: 'formal', gender: 'wanita', rating: 4.8, reviews: 45, desc: 'Dress formal dengan detail elegan', badge: 'hot', image: '{{ asset("assets/image/foto1.jpg") }}', bg: 'dress-bg' },
            { id: 2, name: 'Kebaya Modern Premium', price: 750000, oldPrice: 900000, category: 'formal', gender: 'wanita', rating: 4.9, reviews: 62, desc: 'Kebaya modern dengan bordir mewah', badge: 'new', image: '{{ asset("assets/image/foto2.jpg") }}', bg: 'kebaya-bg' },
            { id: 3, name: 'Tunik Formal Cantik', price: 380000, oldPrice: null, category: 'formal', gender: 'wanita', rating: 4.7, reviews: 38, desc: 'Tunik formal untuk acara resmi', badge: null, image: '{{ asset("assets/image/foto3.jpg") }}', bg: 'tunic-bg' },
            { id: 4, name: 'Jas Formal Executive', price: 850000, oldPrice: 1000000, category: 'formal', gender: 'pria', rating: 4.9, reviews: 67, desc: 'Jas formal untuk acara bisnis', badge: 'hot', image: '{{ asset("assets/image/promo1.jpg") }}', bg: 'suit-bg' },
            { id: 5, name: 'Kemeja Formal Premium', price: 380000, oldPrice: null, category: 'formal', gender: 'pria', rating: 4.7, reviews: 92, desc: 'Kemeja formal kualitas premium', badge: null, image: '{{ asset("assets/image/promo2.jpg") }}', bg: 'formal-bg' },
            { id: 6, name: 'Kemeja Batik Premium', price: 420000, oldPrice: null, category: 'batik', gender: 'pria', rating: 4.8, reviews: 85, desc: 'Kemeja batik motif eksklusif', badge: 'new', image: '{{ asset("assets/image/promo3.jpg") }}', bg: 'batik-bg' },
        ];
        
        // Logika Cart dari catalogue.blade.php
        let cart = JSON.parse(localStorage.getItem('zulaehaCart')) || [];

        function saveCartState() {
            localStorage.setItem('zulaehaCart', JSON.stringify(cart));
        }

        // Fungsi yang dipanggil saat tombol cart diklik
        function openCart() {
            renderCartModal(); 
            document.getElementById('cartModal').classList.add('active');
        }
        
        function closeCart() {
            document.getElementById('cartModal').classList.remove('active');
        }

        function updateHomeCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 0), 0);
            const countElement = document.getElementById('cartCount');
            if(countElement) {
                countElement.innerText = totalItems;
            }
        }
        
        // FUNGSI INI HANYA UNTUK DEMO DI HOME. User akan diarahkan ke Catalogue untuk memilih detail size/color.
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (!product) return;
            
            // Di halaman Home, kita tambahkan dengan default (M, Hitam)
            const defaultSize = 'M';
            const defaultColor = 'Hitam';
            
            const existingItem = cart.find(item => 
                item.id === productId && item.size === defaultSize && item.color === defaultColor
            );

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    color: defaultColor, 
                    size: defaultSize, 
                    quantity: 1
                });
            }

            saveCartState(); 
            updateHomeCartCount();
            
            // Mengganti alert()
            console.log(`✅ ${product.name} berhasil ditambahkan ke keranjang!`);
            // Opsional: Buka keranjang setelah menambahkan
            // openCart(); 
        }

        // 4. FUNGSI RENDER ISI MODAL KERANJANG (DARI CATALOGUE)
        function renderCartModal() {
            const cartContent = document.getElementById('cartContent');
            if(cart.length === 0) {
                 cartContent.innerHTML = '<div class="cart-empty"><p>Keranjang Anda masih kosong. Ayo jelajahi koleksi kami!</p></div>';
                 return;
            }
            
            let html = '<div class="cart-items">';
            let subtotal = 0;
            
            cart.forEach(item => {
                subtotal += item.price * item.quantity;
                
                // Pastikan item memiliki properti yang dibutuhkan, gunakan fallback jika tidak ada
                const itemName = item.name || 'Produk Tanpa Nama';
                const itemPrice = item.price || 0;
                const itemQuantity = item.quantity || 1;
                const itemImage = item.image || 'https://placehold.co/50x50/cccccc/333333?text=?';

                html += `
                    <div class="cart-item" style="display: flex; gap: 15px; padding: 15px 0; border-bottom: 1px dashed #eee;">
                        <img src="${itemImage}" alt="${itemName}" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; font-size: 1.1rem; color: #2c2c2c;">${itemName}</h4>
                            <p style="margin: 3px 0; font-size: 0.85rem; color: #666;">Ukuran: ${item.size || 'N/A'}, Warna: ${item.color || 'N/A'}</p>
                            <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: #8B4545;">${itemQuantity} x Rp ${itemPrice.toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                `;
            });

            html += '</div>';

            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            html += `
                <div class="cart-summary" style="margin-top: 20px; padding-top: 15px; border-top: 2px solid #E0E0E0;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Subtotal:</span>
                        <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Pajak (10%):</span>
                        <span>Rp ${tax.toLocaleString('id-ID')}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.2rem; color: #8B4545; padding-top: 10px; border-top: 1px dashed #8B4545;">
                        <span>Total:</span>
                        <span>Rp ${total.toLocaleString('id-ID')}</span>
                    </div>
                </div>
                <center>
                    <a href="{{ route('catalogue') }}" class="btn-primary" style="width: 100%; margin-top: 20px;">Lanjut ke Pembayaran & Detail</a>
                </center>
            `;
            
            cartContent.innerHTML = html;
        }


        // 5. INISIALISASI
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts('all');
            updateHomeCartCount(); // Panggil saat DOM Load

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    const category = tab.getAttribute('data-category');
                    renderProducts(category);
                });
            });
        });

        
        // Close modal when clicking outside
        document.getElementById('cartModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeCart();
            }
        });

        // Close modal when clicking X
        document.querySelector('.close-modal').addEventListener('click', closeCart);


        // 3. FUNGSI RENDER PRODUK DI HALAMAN
        function renderProducts(filterCategory = 'all') {
            const container = document.getElementById('productContainer');
            container.innerHTML = ''; 

            const filteredProducts = products.filter(product => {
                if (filterCategory === 'all') return true;
                if (filterCategory === 'new') return product.badge === 'new';
                return product.category === filterCategory;
            });

            if (filteredProducts.length === 0) {
                container.innerHTML = '<p style="text-align:center; width:100%; padding:20px; color:white;">Produk tidak ditemukan untuk kategori ini.</p>';
                return;
            }

            filteredProducts.slice(0, 3).forEach(product => { // Batasi 3 produk di halaman Home
                let badgeHTML = '';
                if (product.badge) {
                    let badgeText = product.badge; 
                    if(product.badge === 'sale') badgeText = 'Sale 30%';
                    if(product.badge === 'hot') badgeText = 'Hot Item';
                    
                    badgeHTML = `<div class="product-badge ${product.badge}">${badgeText}</div>`;
                }

                const oldPriceHTML = product.oldPrice 
                    ? `<span class="old-price">Rp ${product.oldPrice.toLocaleString('id-ID')}</span>` 
                    : '';

                const productHTML = `
                    <div class="product-card">
                        <div class="product-image ${product.bg}">
                            <img src="${product.image}" alt="${product.name}" style="width: 100%; height: 100%; object-fit: cover;">
                            ${badgeHTML}
                            <div class="product-overlay">
                                <a href="{{ route('catalogue') }}" class="btn-quick-view">Lihat Detail</a>
                                <button class="btn-add-cart" onclick="addToCart(${product.id})">Tambah ke Keranjang</button>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-rating">⭐⭐⭐⭐⭐ <span>(${product.reviews || 'N/A'})</span></div>
                            <h3>${product.name}</h3>
                            <p class="product-desc">${product.desc}</p>
                            <div class="product-footer">
                                <p class="price">Rp ${product.price.toLocaleString('id-ID')} ${oldPriceHTML}</p>
                                <button class="btn-wishlist">♡</button>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += productHTML;
            });
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
    </script>
</body>
</html>