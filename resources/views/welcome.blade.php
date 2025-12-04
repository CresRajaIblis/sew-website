<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zulaeha Tailor - Baju Formal & Non-Formal Premium</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* =========================================
           CSS ASLI HOME
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
        
        /* Tambahan style Image Product agar sama dengan catalogue */
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
        
        .product-badge { position: absolute; top: 15px; left: 15px; background: #8B4545; color: white; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.8rem; font-weight: 600; }
        .product-badge.hot { background: #FF6B6B; }
        .product-badge.new { background: #4CAF50; }

        .product-overlay { position: auto; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem; opacity: 0; transition: all 0.3s; }
        .product-card:hover .product-overlay { opacity: 0; }
        .btn-quick-view, .btn-add-cart { background: white; color: #8B4545; border: none; padding: 0.8rem 1.5rem; border-radius: 25px; cursor: pointer; font-weight: 600; transition: all 0.9s; }
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
            .form-row { grid-template-columns: 1fr; }
            .modal-content { width: 95%; padding: 1rem; }
            .cart-item { flex-direction: column; }
        }

        /* =========================================
           CSS TAMBAHAN DARI CATALOGUE (INTEGRASI)
           ========================================= */
        /* Cart Modal yang Diperbarui */
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

        /* Order Success & Print */
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

        /* =========================================
           CSS TAMBAHAN UNTUK CHECKOUT FLOW (BARU)
           ========================================= */
        .payment-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 1rem; margin-top: 10px; }
        .payment-card { border: 2px solid #eee; border-radius: 12px; padding: 1.5rem 0.5rem; text-align: center; cursor: pointer; transition: all 0.3s; background: #fff; }
        .payment-card:hover { border-color: #F59B9A; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .payment-card .pay-icon { font-size: 2rem; display: block; margin-bottom: 0.5rem; }
        .payment-card .pay-name { font-size: 0.9rem; font-weight: 600; color: #555; }
        
        .payment-detail-card { background: #f9f9f9; border-top: 4px solid #8B4545; border-radius: 0 0 10px 10px; padding: 1.5rem; text-align: center; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .bank-logo { font-size: 3rem; margin-bottom: 10px; display: block; }
        .bank-number { font-size: 1.8rem; font-weight: 800; color: #2c2c2c; letter-spacing: 2px; margin: 10px 0; font-family: monospace; }
        .bank-name { color: #666; margin: 5px 0; }
        .copy-btn { background: #eee; border: none; padding: 5px 15px; border-radius: 15px; font-size: 0.8rem; cursor: pointer; color: #555; transition: 0.3s; }
        .copy-btn:hover { background: #ddd; }
        
        .total-pay-box { display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #FFF5F5; border-radius: 10px; margin-bottom: 1.5rem; border: 1px dashed #F59B9A; }
        
        .btn-next { background: #8B4545; color: white; width: 100%; padding: 1rem; border: none; border-radius: 30px; margin-top: 1rem; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-next:hover { background: #723636; }
        
        .btn-back-link { cursor: pointer; color: #666; margin-bottom: 15px; display: inline-block; font-weight: 500; }
        .btn-back-link:hover { color: #8B4545; text-decoration: underline; }

        /* Style Tombol WhatsApp */
        .btn-wa-confirm { 
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); 
            color: white; 
            width: 100%; 
            border: none; 
            padding: 1rem; 
            border-radius: 30px; 
            font-weight: 700; 
            font-size: 1.1rem; 
            cursor: pointer; 
            transition: 0.3s; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            gap: 10px; 
            margin-top: 15px; 
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }
        .btn-wa-confirm:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5); 
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
                <h4 style="position: absolute; bottom: 60px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Kemeja Premium</h4>
                <p class="product-price" style="position: absolute; bottom: -10px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 450.000</p>
                </div>
            </div>
            <div class="image-card card-2">
                <div class="product-preview" style="position: relative;">
                    <div class="product-tag hot" style="position: absolute; top: 10px; right: 10px; z-index: 2;">Hot</div>
                <img src="{{ asset('assets/image/foto2.jpg') }}" alt="Blazer Elegant" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; z-index: 1;">
                <h4 style="position: absolute; bottom: 60px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; margin-bottom: 10px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Blazer Elegant</h4>
                <p class="product-price" style="position: absolute; bottom: -10px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 850.000</p>
            </div>
            </div>
            <div class="image-card card-3">
                <div class="product-preview" style="position: relative;">
                <div class="product-tag" style="position: absolute; top: 10px; right: 10px; z-index: 2;">Sale</div>
                <img src="{{ asset('assets/image/foto3.jpg') }}" alt="Dress Casual" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; z-index: 1;">
                <h4 style="position: absolute; bottom: 60px; left: 15px; z-index: 2; color: white; font-size: 1.1rem; margin-bottom: 10px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Dress Casual</h4>
                <p class="product-price" style="position: absolute; bottom: -10px; left: 15px; z-index: 2; color: #fff; font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Rp 380.000</p>
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
            </div>
        </div>
        <div class="contact-form-section">
    <h3>Kirim Pesan</h3>
    <form class="contact-form" onsubmit="return false;"> 
        <input type="text" id="contactName" placeholder="Nama Anda" required>
        <input type="email" id="contactEmail" placeholder="Email" required>
        <input type="tel" id="contactPhone" placeholder="Nomor WhatsApp" required>
        <textarea id="contactMessage" placeholder="Pesan Anda..." rows="5" required></textarea>
        <button type="button" class="btn-primary" onclick="sendContactWA()">Kirim Pesan</button>
    </form>
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
    </div>
    <p class="footer-bottom">© 2025 Zulaeha Tailor. All Rights Reserved.</p>
    </footer>

<script>
    // 1. INTEGRASI DATA & VARIABEL
    const products = @json($products);
    const ADMIN_WA_NUMBER = '6281373677824'; // Nomor WA Admin Zulaeha Tailor

    let cart = [];
    const csrfToken = '{{ csrf_token() }}';
    const placeOrderUrl = '{{ route('checkout.process') }}';
    
    // Auth Data
    const isUserAuthenticated = {{ Auth::check() && Auth::user()->role === 'user' ? 'true' : 'false' }};
    const userName = '{{ Auth::user()->name ?? '' }}';
    const userEmail = '{{ Auth::user()->email ?? '' }}';
    const userPhone = '{{ Auth::user()->phone ?? '' }}';

    window.tempOrderData = {};

    // 2. INITIALIZATION
    document.addEventListener('DOMContentLoaded', function() {
        const savedCart = localStorage.getItem('zulaehaCart');
        if (savedCart) { try { cart = JSON.parse(savedCart); } catch (e) { cart = []; } }
        
        renderProducts('all');
        updateCartCount();

        // Filter Tabs Logic
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                renderProducts(tab.getAttribute('data-category'));
            });
        });
    });
    
    function saveCartState() { localStorage.setItem('zulaehaCart', JSON.stringify(cart)); }

    function renderProductImage(icon) {
        if (icon && icon.match(/\.(jpeg|jpg|gif|png)|(https?:\/\/)/)) {
            return `<img src="${icon}" alt="product" style="width: 100%; height: 100%; object-fit: cover;">`;
        }
        return `<span style="font-size: 3rem;">${icon || '👕'}</span>`;
    }

    // 3. RENDER PRODUCTS (HOME)
    function renderProducts(filterCategory = 'all') {
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

        filtered.slice(0, 8).forEach(p => { 
            let badgeHTML = p.badge ? `<div class="product-badge ${p.badge}">${p.badge === 'hot' ? '🔥 HOT' : '✨ NEW'}</div>` : '';
            const displayImg = p.image ? `<img src="${p.image}" style="width:100%; height:100%; object-fit:cover; position:absolute; top:0; left:0;">` : renderProductImage(p.icon);

            container.innerHTML += `
                <div class="product-card">
                    <div class="product-image ${p.bg || 'formal-bg'}">
                        ${displayImg} ${badgeHTML}
                        <div class="product-overlay">
                            <a href="{{ route('catalogue') }}" class="btn-quick-view">Lihat Detail</a>
                            <button class="btn-add-cart" onclick="addToCart(${p.id})">Tambah ke Keranjang</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">⭐⭐⭐⭐⭐ <span>(${p.reviews || 0})</span></div>
                        <h3>${p.name}</h3>
                        <p class="product-desc">${p.desc || ''}</p>
                        <div class="product-footer"><p class="price">Rp ${p.price.toLocaleString('id-ID')}</p></div>
                    </div>
                </div>`;
        });
    }

    // 4. ADD TO CART
    function addToCart(pid) {
        const p = products.find(i => i.id === pid);
        if (!p) return;

        const exist = cart.find(i => i.id === pid && i.size === "All Size");
        if (exist) {
            exist.quantity++;
        } else {
            cart.push({
                id: p.id, name: p.name, price: p.price,
                icon: p.icon || p.image || '📦', bg: p.bg || 'formal-bg',
                size: "All Size", color: "Standard", colorDisplay: "Standard",
                quantity: 1
            });
        }
        saveCartState(); updateCartCount();
        alert(`✅ ${p.name} berhasil masuk keranjang!`);
    }

    function updateCartCount() {
        document.getElementById('cartCount').textContent = cart.reduce((a, b) => a + b.quantity, 0);
    }

    // ============================================================
    // 5. CHECKOUT FLOW DENGAN WHATSAPP
    // ============================================================

    function openCart() { document.getElementById('cartModal').classList.add('active'); renderCartView(); }
    function closeCart() { document.getElementById('cartModal').classList.remove('active'); }

    // VIEW 1: CART LIST
    function renderCartView() {
        const content = document.getElementById('cartContent');
        document.querySelector('.modal-header h2').innerText = "Keranjang Belanja";

        if (cart.length === 0) {
            content.innerHTML = `<div class="cart-empty"><p>🛒 Keranjang masih kosong</p></div>`;
            return;
        }

        const total = cart.reduce((a, b) => a + (b.price * b.quantity), 0);

        content.innerHTML = `
            <div style="max-height:400px; overflow-y:auto;">
                ${cart.map((item, i) => `
                    <div class="cart-item">
                        <div class="cart-item-image ${item.bg}">${renderProductImage(item.icon)}</div>
                        <div class="cart-item-details">
                            <h3>${item.name}</h3>
                            <p>${item.colorDisplay} | ${item.size}</p>
                            <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                        </div>
                        <div>
                            <button onclick="removeItem(${i})" style="color:red; border:none; background:none; cursor:pointer;">Hapus</button>
                            <div style="font-weight:bold; margin-top:5px; background:#eee; padding:2px 8px; border-radius:8px;">x${item.quantity}</div>
                        </div>
                    </div>
                `).join('')}
            </div>
            <div style="border-top:2px dashed #ddd; margin-top:15px; padding-top:15px; display:flex; justify-content:space-between; align-items:center;">
                <span style="font-weight:600;">Total:</span>
                <span style="font-weight:bold; font-size:1.3rem; color:#8B4545;">Rp ${total.toLocaleString('id-ID')}</span>
            </div>
            <button class="btn-next" onclick="renderCheckoutForm()">Lanjut Checkout ➤</button>
        `;
    }

    // VIEW 2: DATA & METHOD
    function renderCheckoutForm() {
        if (!isUserAuthenticated) {
            alert('Silakan login terlebih dahulu.');
            window.location.href = '{{ route("user.login") }}';
            return;
        }

        const content = document.getElementById('cartContent');
        document.querySelector('.modal-header h2').innerText = "Pengiriman & Pembayaran";

        const fName = window.tempOrderData.name || userName;
        const fPhone = window.tempOrderData.phone || userPhone;
        const fEmail = window.tempOrderData.email || userEmail;
        const fAddress = window.tempOrderData.address || '';
        const fNote = window.tempOrderData.note || '';

        content.innerHTML = `
            <div class="btn-back-link" onclick="renderCartView()">⬅ Kembali</div>
            <div class="checkout-form">
                <div class="form-group"><label>Nama Penerima</label><input type="text" id="cName" value="${fName}"></div>
                <div class="form-row">
                    <div class="form-group"><label>Email</label><input type="email" id="cEmail" value="${fEmail}"></div>
                    <div class="form-group"><label>No WhatsApp</label><input type="tel" id="cPhone" value="${fPhone}"></div>
                </div>
                <div class="form-group"><label>Alamat Lengkap</label><textarea id="cAddress" rows="2">${fAddress}</textarea></div>
                <div class="form-group"><label>Catatan</label><input type="text" id="cNote" value="${fNote}"></div>

                <label style="font-weight:600; margin-top:10px; display:block;">Metode Pembayaran</label>
                <div class="payment-grid">
                    <div class="payment-card" onclick="showPaymentDetail('transfer')">
                        <span class="pay-icon">🏦</span><span class="pay-name">Transfer Bank</span>
                    </div>
                    <div class="payment-card" onclick="showPaymentDetail('ewallet')">
                        <span class="pay-icon">📱</span><span class="pay-name">QRIS / E-Wallet</span>
                    </div>
                    <div class="payment-card" onclick="showPaymentDetail('cod')">
                        <span class="pay-icon">🚚</span><span class="pay-name">COD</span>
                    </div>
                </div>
            </div>
        `;
    }

    // VIEW 3: PAYMENT DETAIL & WA BUTTON (MODIFIKASI UTAMA)
    function showPaymentDetail(method) {
        const name = document.getElementById('cName').value;
        const email = document.getElementById('cEmail').value;
        const phone = document.getElementById('cPhone').value;
        const address = document.getElementById('cAddress').value;
        const note = document.getElementById('cNote').value;

        if(!name || !email || !phone || !address) { alert("Lengkapi data pengiriman dulu ya!"); return; }

        window.tempOrderData = { name, email, phone, address, note, method };

        // Hitung Total
        const subtotal = cart.reduce((n, i) => n + (i.price * i.quantity), 0);
        const total = subtotal + (subtotal * 0.1); // Pajak 10%
        const totalStr = total.toLocaleString('id-ID');

        const content = document.getElementById('cartContent');
        document.querySelector('.modal-header h2').innerText = "Konfirmasi Pesanan";

        let detailHtml = '';

        // --- LOGIKA TAMPILAN BERBEDA TIAP METODE ---
        if (method === 'transfer') {
            detailHtml = `
                <div class="payment-detail-card">
                    <span class="bank-logo">🏦</span>
                    <p class="bank-name">BANK CENTRAL ASIA (BCA)</p>
                    <div class="bank-number">123-456-7890</div>
                    <p class="bank-name">a.n Zulaeha Tailor</p>
                    <button class="copy-btn" onclick="navigator.clipboard.writeText('1234567890'); alert('Disalin!')">Salin No. Rek</button>
                </div>
                <p style="text-align:center; font-size:0.9rem; color:#666;">Silakan transfer sesuai nominal di bawah ini lalu konfirmasi ke Admin.</p>
            `;
        } else if (method === 'ewallet') {
            detailHtml = `
                <div class="payment-detail-card">
                    <span class="bank-logo">📱</span>
                    <p style="font-weight:bold; margin-bottom:10px;">SCAN QRIS / DANA / OVO</p>
                    <div style="background:#eee; width:150px; height:150px; margin:0 auto; display:flex; align-items:center; justify-content:center; border-radius:10px;">
                        <span style="font-size:2rem;">🔳 QR</span>
                    </div>
                    <p style="margin-top:10px; font-size:0.9rem;">a.n Zulaeha Tailor</p>
                </div>
                <p style="text-align:center; font-size:0.9rem; color:#666;">Scan kode di atas untuk pembayaran instan.</p>
            `;
        } else if (method === 'cod') {
            detailHtml = `
                <div class="payment-detail-card" style="border-top-color:#F59B9A;">
                    <span class="bank-logo">🚚</span>
                    <p style="font-weight:bold; font-size:1.1rem;">BAYAR DI TEMPAT (COD)</p>
                    <p style="font-size:0.9rem; color:#666; margin-top:10px;">
                        Pastikan alamat Anda lengkap dan nomor HP aktif. Kurir akan menghubungi sebelum pengiriman.
                    </p>
                    <div style="background:#fff3cd; color:#856404; padding:10px; border-radius:8px; margin-top:15px; font-size:0.85rem;">
                        ⚠️ Mohon siapkan uang pas saat kurir datang.
                    </div>
                </div>
            `;
        }

        content.innerHTML = `
            <div class="btn-back-link" onclick="renderCheckoutForm()">⬅ Ganti Metode</div>
            ${detailHtml}
            
            <div class="total-pay-box">
                <span>Total Tagihan:</span>
                <strong style="font-size:1.3rem; color:#8B4545;">Rp ${totalStr}</strong>
            </div>

            <button class="btn-wa-confirm" id="btnProsesWA" onclick="processToWA()">
                <span style="font-size:1.2rem;">💬</span> Konfirmasi Pesanan via WhatsApp
            </button>
        `;
    }

    // 6. PROSES SIMPAN KE DB -> LALU BUKA WA
    async function processToWA() {
        const btn = document.getElementById('btnProsesWA');
        btn.innerHTML = '⏳ Menyimpan Pesanan...';
        btn.disabled = true;

        const data = window.tempOrderData;
        const subtotal = cart.reduce((n, i) => n + (i.price * i.quantity), 0);
        const total = subtotal + (subtotal * 0.1);

        // Siapkan Nama Metode untuk Database
        let dbMethod = "Transfer Bank";
        if(data.method === 'ewallet') dbMethod = "E-Wallet";
        if(data.method === 'cod') dbMethod = "COD";

        // Payload Database
        const payload = {
            name: data.name, email: data.email, phone: data.phone,
            address: data.address, note: data.note,
            payment_method: dbMethod, cart: cart, total_price: total
        };

        try {
            // 1. SIMPAN KE DATABASE DULU (AJAX)
            const response = await fetch(placeOrderUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await response.json();

            if (response.ok && result.success) {
                // 2. JIKA SUKSES DISIMPAN, SIAPKAN PESAN WA
                
                // Format List Barang
                let itemsList = "";
                cart.forEach((item, i) => {
                    itemsList += `${i+1}. ${item.name} (${item.colorDisplay}, ${item.size}) x${item.quantity}\n`;
                });

                // 2. PERBAIKI TEMPLATE CHAT (Ganti %0A jadi \n)
                let msg = `*Halo Admin Zulaeha Tailor!*\n`;
                msg += `Saya ingin konfirmasi pesanan baru (Order ID: #${result.order_number}):\n\n`;
                msg += `👤 *Nama:* ${data.name}\n`;
                msg += `📞 *No HP:* ${data.phone}\n`;
                msg += `🏠 *Alamat:* ${data.address}\n`;
                msg += `----------------------------------\n`;
                msg += `🛍️ *Detail Pesanan:*\n${itemsList}`;
                msg += `----------------------------------\n`;
                msg += `💰 *Total Tagihan:* Rp ${total.toLocaleString('id-ID')}\n`;
                msg += `💳 *Metode:* ${dbMethod}\n`;
                if(data.note) msg += `📝 *Catatan:* ${data.note}\n`;
                msg += `\nMohon diproses ya, Terima Kasih!`;

                // 3. RESET KERANJANG & BUKA WA
                cart = []; saveCartState(); updateCartCount();
                
                // Buka WhatsApp di Tab Baru
                window.open(`https://wa.me/${ADMIN_WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
                
                // Tampilkan Modal Sukses di Web
                showOrderSuccess(result, data.name, total, dbMethod);

            } else {
                alert('Gagal menyimpan pesanan: ' + (result.message || 'Error'));
                btn.innerHTML = 'Coba Lagi';
                btn.disabled = false;
            }
        } catch (error) {
            console.error(error);
            alert('Koneksi Error. Pastikan internet lancar.');
            btn.innerHTML = 'Coba Lagi';
            btn.disabled = false;
        }
    }

    function showOrderSuccess(res, name, total, method) {
        const content = document.getElementById('cartContent');
        document.querySelector('.modal-header h2').innerText = "Pesanan Terkirim!";
        
        content.innerHTML = `
            <div class="order-success">
                <h2>✅ Pesanan Berhasil!</h2>
                <div class="queue-number">
                    <h3>ANTRIAN</h3>
                    <div class="queue-display">#${res.queue_number}</div>
                </div>
                <p>Data pesanan sudah masuk ke sistem kami dan WhatsApp Admin akan terbuka otomatis.</p>
                <div class="order-summary-box">
                    <p><strong>Kode:</strong> ${res.order_number}</p>
                    <p><strong>Total:</strong> Rp ${parseInt(total).toLocaleString('id-ID')}</p>
                    <p><strong>Metode:</strong> ${method}</p>
                </div>
                <button class="checkout-btn" style="width:auto; padding:10px 20px;" onclick="location.reload()">Selesai</button>
            </div>
        `;
    }
    
    function removeItem(i) { cart.splice(i, 1); saveCartState(); updateCartCount(); renderCartView(); }
    document.getElementById('cartModal').addEventListener('click', function(e) { if(e.target===this) closeCart(); });

    // ... kode script lainnya di atas

// ============================================================
// 7. FUNGSI KONTAK KE WA
// ============================================================
function sendContactWA() {
    const name = document.getElementById('contactName').value;
    const email = document.getElementById('contactEmail').value;
    const phone = document.getElementById('contactPhone').value;
    const message = document.getElementById('contactMessage').value;

    if (!name || !phone || !message) {
        alert("Mohon lengkapi Nama, Nomor WhatsApp, dan Pesan Anda.");
        return;
    }

    let msg = `*Pesan Baru dari Halaman Kontak Website*\n\n`;
    msg += `👤 *Nama:* ${name}\n`;
    msg += `📞 *No HP/WA:* ${phone}\n`;
    msg += `📧 *Email:* ${email || 'Tidak diisi'}\n`; // Jika email kosong
    msg += `----------------------------------\n`;
    msg += `💬 *Isi Pesan:*\n${message}\n\n`;
    msg += `Mohon segera dibalas ya, Terima Kasih!`;

    // Redirect ke WhatsApp dengan encoding yang benar
    window.open(`https://wa.me/${ADMIN_WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
}
// ... kode script lainnya di bawah

</script>
</body>
</html>