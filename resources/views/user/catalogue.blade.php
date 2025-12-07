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

        /* --- STYLE KERANJANG & CHECKOUT BARU --- */
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

/* Stepper (Indikator Langkah) */
.stepper { display: flex; justify-content: space-between; margin-bottom: 2rem; position: relative; }
.stepper::before { content: ''; position: absolute; top: 15px; left: 0; width: 100%; height: 2px; background: #eee; z-index: 0; }
.step { position: relative; z-index: 1; text-align: center; width: 33.33%; }
.step-circle { width: 32px; height: 32px; background: #eee; border-radius: 50%; margin: 0 auto 8px; display: flex; align-items: center; justify-content: center; color: #999; font-weight: 600; font-size: 0.9rem; transition: 0.3s; border: 2px solid white; }
.step.active .step-circle { background: #F59B9A; color: white; box-shadow: 0 0 0 3px rgba(245, 155, 154, 0.3); }
.step.completed .step-circle { background: #8B4545; color: white; }
.step-label { font-size: 0.8rem; color: #999; font-weight: 500; }
.step.active .step-label, .step.completed .step-label { color: #8B4545; font-weight: 700; }

/* Item Keranjang Modern */
.cart-item-modern { 
    display: flex; gap: 1rem; padding: 1rem; border: 1px solid #eee; border-radius: 16px; 
    margin-bottom: 1rem; transition: all 0.3s; background: white; align-items: center;
}
.cart-item-modern:hover { border-color: #F59B9A; box-shadow: 0 5px 15px rgba(0,0,0,0.03); transform: translateY(-2px); }
.cart-img-box { width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #f9f9f9; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.cart-img-box img { width: 100%; height: 100%; object-fit: cover; }
.cart-info { flex: 1; }
.cart-info h4 { font-size: 1rem; margin-bottom: 4px; color: #333; }
.cart-meta { font-size: 0.85rem; color: #888; display: flex; gap: 10px; margin-bottom: 5px; }
.cart-price { color: #8B4545; font-weight: 700; font-size: 1.1rem; }
.cart-remove-btn { color: #ff6b6b; cursor: pointer; background: #fff0f0; padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; border: none; font-weight: 600; }

/* Total Bar */
.cart-total-bar { background: #FFF5F5; border-radius: 16px; padding: 1.5rem; margin-top: 2rem; border: 1px dashed #F59B9A; }
.total-row { display: flex; justify-content: space-between; margin-bottom: 8px; color: #555; }
.total-row.final { font-size: 1.4rem; font-weight: 800; color: #8B4545; margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.05); }

/* Form & Payment */
.modern-input { width: 100%; padding: 12px 15px; border: 2px solid #eee; border-radius: 12px; font-family: 'Poppins', sans-serif; transition: 0.3s; margin-bottom: 15px; }
.modern-input:focus { border-color: #F59B9A; outline: none; }
.payment-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1rem; }
.payment-option-card { border: 2px solid #eee; border-radius: 16px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: 0.3s; background: white; }
.payment-option-card.active, .payment-option-card:hover { border-color: #F59B9A; background: #FFF5F5; }
.btn-block { width: 100%; display: block; text-align: center; padding: 1rem; background: #8B4545; color: white; border: none; border-radius: 12px; font-weight: bold; cursor: pointer; margin-top: 1rem; }

/* Tiket Sukses */
.queue-ticket { background: white; border: 2px dashed #8B4545; border-radius: 20px; padding: 2rem; margin: 2rem auto; max-width: 350px; text-align: center; }
.queue-value { font-size: 3.5rem; font-weight: 800; color: #8B4545; }

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

        /* --- CSS TAMBAHAN UNTUK PAYMENT GRID & DETAIL --- */
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
        .btn-wa-confirm { background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); color: white; width: 100%; border: none; padding: 1rem; border-radius: 30px; font-weight: 700; font-size: 1.1rem; cursor: pointer; transition: 0.3s; display: flex; justify-content: center; align-items: center; gap: 10px; }
        .btn-wa-confirm:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4); }
        .btn-next { background: #8B4545; color: white; width: 100%; padding: 1rem; border: none; border-radius: 30px; margin-top: 1rem; font-weight: 700; cursor: pointer; }

        

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
            <h2 id="modalTitle">Keranjang Belanja</h2>
            <button class="close-modal" onclick="closeCart()">×</button>
        </div>
        <div class="modal-body" id="cartBody">
            </div>
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
    // ============================================================
    // 1. DATA & VARIABEL GLOBAL
    // ============================================================
    const products = @json($products);
    const ADMIN_WA_NUMBER = '6281373677824'; 
    const csrfToken = '{{ csrf_token() }}';
    const placeOrderUrl = '{{ route("checkout.process") }}';

    // Data User Login
    const isUserAuthenticated = {{ Auth::check() && Auth::user()->role === 'user' ? 'true' : 'false' }};
    const userData = {
        name: '{{ Auth::user()->name ?? "" }}',
        email: '{{ Auth::user()->email ?? "" }}',
        phone: '{{ Auth::user()->phone ?? "" }}'
    };

    const colorNames = {
        'black': 'Hitam', 'white': 'Putih', 'navy': 'Biru Navy',
        'army': 'Hijau Army', 'maroon': 'Merah Marun', 'grey': 'Abu-abu'
    };

    let cart = [];
    let currentGender = 'semua';
    let currentCategory = 'semua';
    
    // Penyimpanan data sementara checkout
    window.tempOrderData = {}; 

    // ============================================================
    // 2. HELPER GAMBAR (INI YANG DIPERBAIKI)
    // ============================================================
    function getImageUrl(imgString) {
        if (!imgString) return 'https://via.placeholder.com/300?text=No+Image';
        
        // Jika link lengkap (http...), pakai langsung
        if (imgString.startsWith('http')) return imgString;
        
        // JIKA FOLDER DI public/assets/image:
        return `/assets/image/${imgString}`;
    }

    // Fungsi render gambar di card katalog
    function renderProductImage(icon) {
        if (!icon) return '<span style="font-size: 3rem;">📦</span>';
        const iconStr = String(icon);
        if (iconStr.match(/\.(jpeg|jpg|gif|png)|(https?:\/\/)/) != null || !iconStr.includes(' ')) {
            return `<img src="${getImageUrl(iconStr)}" alt="product" style="width: 100%; height: 100%; object-fit: cover;">`;
        }
        return `<span style="font-size: 4rem;">${iconStr}</span>`;
    }

    function saveCartState() { localStorage.setItem('zulaehaCart', JSON.stringify(cart)); }
    function updateCartCount() { document.getElementById('cartCount').innerText = cart.reduce((a,b)=>a+b.quantity, 0); }

    // ============================================================
    // 3. LOGIKA PRODUK
    // ============================================================
    document.addEventListener('DOMContentLoaded', function() {
        const savedCart = localStorage.getItem('zulaehaCart');
        if (savedCart) { try { cart = JSON.parse(savedCart); } catch (e) { cart = []; } }
        renderProducts();
        updateCartCount();
    });

    function renderProducts() {
        const grid = document.getElementById('productGrid');
        const filtered = products.filter(p => {
            const genderMatch = currentGender === 'semua' || p.gender === currentGender;
            const categoryMatch = currentCategory === 'semua' || p.category === currentCategory;
            return genderMatch && categoryMatch;
        });

        grid.innerHTML = filtered.map(product => `
            <div class="product-card">
                <div class="product-image ${product.bg || 'formal-bg'}">
                    ${product.badge ? `<div class="product-badge ${product.badge}">${product.badge === 'hot' ? '🔥 HOT' : '✨ NEW'}</div>` : ''}
                    ${renderProductImage(product.image || product.icon)}
                </div>
                <div class="product-info">
                    <div class="product-rating">★★★★★ <span>(${product.reviews || 0} ulasan)</span></div>
                    <h3>${product.name}</h3>
                    <p class="product-desc">${product.desc || ''}</p>
                    
                    <div class="color-select">
                        <label>Pilih Warna:</label>
                        <div class="color-options">
                            ${(product.colors || ['black']).map(color => `
                                <div class="color-option color-${color}" onclick="selectColor(this)" title="${colorNames[color]||color}"></div>
                            `).join('')}
                            <div class="color-option color-custom" onclick="selectCustomColor(this)">Custom</div>
                        </div>
                        <input type="text" class="custom-input custom-color-input" placeholder="Warna custom...">
                    </div>

                    <div class="size-select">
                        <label>Pilih Ukuran:</label>
                        <div class="size-options">
                            ${['S','M','L','XL'].map(s => `<div class="size-option" onclick="selectSize(this)">${s}</div>`).join('')}
                            <div class="size-option" onclick="selectCustomSize(this)">Custom</div>
                        </div>
                        <input type="text" class="custom-input custom-size-input" placeholder="Ukuran custom...">
                    </div>

                    <div class="product-footer">
                        <span class="price">Rp ${product.price.toLocaleString('id-ID')}</span>
                    </div>
                    <button class="btn-add-cart" onclick="addToCart(${product.id})">Tambah ke Keranjang</button>
                </div>
            </div>
        `).join('');
    }

    // UI Helper Functions
    function selectSize(el) { deselectAll(el, '.size-option'); el.classList.add('selected'); el.closest('.size-select').querySelector('input').classList.remove('active'); }
    function selectCustomSize(el) { deselectAll(el, '.size-option'); el.classList.add('selected'); let inp = el.closest('.size-select').querySelector('input'); inp.classList.add('active'); inp.focus(); }
    function selectColor(el) { deselectAll(el, '.color-option'); el.classList.add('selected'); el.closest('.color-select').querySelector('input').classList.remove('active'); }
    function selectCustomColor(el) { deselectAll(el, '.color-option'); el.classList.add('selected'); let inp = el.closest('.color-select').querySelector('input'); inp.classList.add('active'); inp.focus(); }
    function deselectAll(el, selector) { el.closest('div').querySelectorAll(selector).forEach(i => i.classList.remove('selected')); }
    
    function filterGender(g) { 
        currentGender = g; 
        document.querySelectorAll('.gender-btn').forEach(b => b.classList.toggle('active', b.innerText.toLowerCase().includes(g) || (g==='semua' && b.innerText==='Semua')));
        renderProducts(); 
    }
    function filterCategory(c) { 
        currentCategory = c; 
        document.querySelectorAll('.tab').forEach(b => b.classList.toggle('active', b.innerText.toLowerCase().includes(c) || (c==='semua' && b.innerText==='Semua')));
        renderProducts(); 
    }
    function scrollToSection(id) { document.getElementById(id).scrollIntoView({behavior:'smooth'}); }

    // ADD TO CART
    function addToCart(pid) {
        const product = products.find(p => p.id === pid);
        const card = event.target.closest('.product-card');
        
        const sizeEl = card.querySelector('.size-option.selected');
        const colorEl = card.querySelector('.color-option.selected');

        if(!sizeEl || !colorEl) { alert("Mohon pilih Warna dan Ukuran terlebih dahulu!"); return; }

        let size = sizeEl.innerText === 'Custom' ? `Custom: ${card.querySelector('.custom-size-input').value}` : sizeEl.innerText;
        
        let color = '';
        let colorDisplay = '';
        
        if (colorEl.classList.contains('color-custom')) {
            color = 'custom';
            colorDisplay = `Custom: ${card.querySelector('.custom-color-input').value}`;
        } else {
            const classList = Array.from(colorEl.classList);
            const colorClass = classList.find(c => c.startsWith('color-') && c !== 'color-option');
            color = colorClass ? colorClass.replace('color-', '') : 'unknown';
            colorDisplay = colorNames[color] || color;
        }
        
        if((size.includes('Custom') && size.length<9) || (colorDisplay.includes('Custom') && colorDisplay.length<9)) {
            alert("Mohon isi detail custom dengan lengkap!"); return;
        }

        const icon = product.icon ? product.icon : (product.image ? product.image : '📦');
        
        const exist = cart.find(i => i.id === pid && i.size === size && i.color === color);
        if(exist) exist.quantity++;
        else cart.push({ 
            id: pid, 
            name: product.name, 
            price: product.price, 
            image: icon, 
            bg: product.bg, 
            size: size, 
            color: color, 
            colorDisplay: colorDisplay, 
            quantity: 1 
        });

        saveCartState(); updateCartCount();
        
        const btn = event.target;
        const oriText = btn.innerText;
        btn.innerText = "✅ Masuk!";
        btn.style.background = "#4CAF50";
        setTimeout(() => { btn.innerText = oriText; btn.style.background = ""; }, 1000);
    }

    // ============================================================
    // 4. KERANJANG & CHECKOUT BARU (Updated)
    // ============================================================
    
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

    function openCart() { document.getElementById('cartModal').classList.add('active'); renderCartStep(); }
    function closeCart() { document.getElementById('cartModal').classList.remove('active'); }

    // --- STEP 1: KERANJANG ---
    function renderCartStep() {
        const body = document.getElementById('cartBody');
        document.getElementById('modalTitle').innerText = 'Keranjang Belanja';
        
        if(cart.length === 0) {
            body.innerHTML = `<div style="text-align:center; padding:3rem; color:#666;">Keranjang kosong.</div>`;
            return;
        }

        const total = cart.reduce((a,b) => a + (b.price * b.quantity), 0);
        const ppn = total * 0.1;
        const grandTotal = total + ppn;

        let html = renderStepper(1);
        html += `<div style="max-height: 350px; overflow-y: auto;">`;
        
        cart.forEach((item, idx) => {
            const displayColor = item.colorDisplay || item.color;
            html += `
                <div class="cart-item-modern">
                    <div class="cart-img-box">
                        <img src="${getImageUrl(item.image)}" alt="${item.name}"> 
                    </div>
                    <div class="cart-info">
                        <h4>${item.name}</h4>
                        <div class="cart-meta">
                            <span>Size: ${item.size}</span>
                            <span>Warna: ${displayColor}</span>
                        </div>
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

    // --- STEP 2: DATA DIRI ---
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
            <div class="form-group"><label>Nama Penerima</label><input type="text" class="modern-input" id="fName" value="${name}"></div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                <div class="form-group"><label>No. HP / WA</label><input type="text" class="modern-input" id="fPhone" value="${phone}"></div>
                <div class="form-group"><label>Email</label><input type="email" class="modern-input" id="fEmail" value="${email}"></div>
            </div>
            <div class="form-group"><label>Alamat Lengkap</label><input type="text" class="modern-input" id="fAddress" value="${address}" placeholder="Jalan, No. Rumah, Kecamatan..."></div>
            <div class="form-group"><label>Catatan (Opsional)</label><input type="text" class="modern-input" id="fNote" value="${window.tempOrderData?.note || ''}"></div>
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

        if(!name || !phone || !address) { alert('Nama, HP, dan Alamat wajib diisi!'); return; }

        window.tempOrderData = { name, phone, email, address, note };
        renderPaymentStep();
    }

    // --- STEP 3: PEMBAYARAN ---
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

    // 5. PROSES ORDER
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
</script>
</body>
</html>