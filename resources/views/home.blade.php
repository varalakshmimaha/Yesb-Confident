<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Yesb Confident — E-Commerce & Advertising Services</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    /* ===== RESET & VARIABLES ===== */
    *{margin:0;padding:0;box-sizing:border-box}
    :root{
      --primary:#0A2342;
      --primary-light:#1a3a6b;
      --accent:#E8A020;
      --accent-hover:#d4901a;
      --accent2:#C0392B;
      --light:#F8F5F0;
      --white:#fff;
      --text:#1a1a2e;
      --muted:#777;
      --border:#e8e5e0;
      --shadow:0 8px 30px rgba(10,35,66,.08);
      --shadow-hover:0 16px 48px rgba(10,35,66,.14);
      --radius:16px;
      --transition:all .35s cubic-bezier(.4,0,.2,1);
    }
    html{scroll-behavior:smooth}
    body{font-family:'DM Sans',sans-serif;background:var(--white);color:var(--text);overflow-x:hidden;line-height:1.6}
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}
    button{cursor:pointer;font-family:inherit}

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp{from{opacity:0;transform:translateY(40px)}to{opacity:1;transform:translateY(0)}}
    @keyframes fadeInLeft{from{opacity:0;transform:translateX(-40px)}to{opacity:1;transform:translateX(0)}}
    @keyframes fadeInRight{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:translateX(0)}}
    @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
    @keyframes pulse{0%,100%{transform:scale(1)}50%{transform:scale(1.05)}}
    @keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
    @keyframes slideInDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)}}
    @keyframes scaleIn{from{opacity:0;transform:scale(.85)}to{opacity:1;transform:scale(1)}}
    @keyframes glow{0%,100%{box-shadow:0 0 20px rgba(232,160,32,.3)}50%{box-shadow:0 0 40px rgba(232,160,32,.6)}}

    .reveal{opacity:0;transform:translateY(40px);transition:opacity .8s ease,transform .8s ease}
    .reveal.active{opacity:1;transform:translateY(0)}

    /* ===== TOPBAR ===== */
    .topbar{background:var(--primary);color:rgba(255,255,255,.9);font-size:12px;padding:8px 40px;display:flex;justify-content:space-between;align-items:center}
    .topbar a{color:var(--accent);font-weight:600}
    .topbar i{margin-right:5px;color:var(--accent)}

    /* ===== NAVBAR ===== */
    .navbar{background:var(--white);padding:0 40px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:1000;height:72px;border-bottom:2px solid var(--accent);transition:var(--transition)}
    .navbar.scrolled{box-shadow:0 4px 20px rgba(0,0,0,.1);height:64px}
    .logo{display:flex;align-items:center;gap:12px}
    .logo-mark{width:46px;height:46px;border-radius:12px;overflow:hidden;flex-shrink:0;box-shadow:0 4px 14px rgba(10,35,66,.15)}
    .logo-mark svg{width:100%;height:100%}
    .logo-text{font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:var(--primary);line-height:1.15}
    .logo-text em{font-style:normal;color:var(--accent)}
    .logo-sub{font-size:9.5px;color:var(--muted);letter-spacing:2.5px;text-transform:uppercase;font-weight:500;margin-top:1px}

    .nav-menu{display:flex;gap:6px}
    .nav-menu a{font-size:13.5px;font-weight:500;letter-spacing:.3px;padding:8px 16px;border-radius:8px;transition:var(--transition);position:relative}
    .nav-menu a:hover,.nav-menu a.active{background:rgba(232,160,32,.1);color:var(--accent)}

    .nav-actions{display:flex;gap:12px;align-items:center}
    .nav-actions .search-box{display:flex;align-items:center;background:var(--light);border-radius:10px;padding:0 14px;height:40px;gap:8px;border:1px solid var(--border);transition:var(--transition)}
    .nav-actions .search-box:focus-within{border-color:var(--accent);box-shadow:0 0 0 3px rgba(232,160,32,.15)}
    .nav-actions .search-box input{border:none;background:none;outline:none;font-size:13px;width:180px;font-family:inherit}
    .nav-actions .search-box i{color:var(--muted);font-size:14px}
    .cart-btn{position:relative;width:42px;height:42px;border-radius:10px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;font-size:18px;color:var(--primary);transition:var(--transition)}
    .cart-btn:hover{background:var(--accent);color:var(--white);border-color:var(--accent)}
    .cart-btn .badge{position:absolute;top:-4px;right:-4px;background:var(--accent2);color:#fff;font-size:10px;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center}
    .btn-cta{background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);border:none;padding:10px 22px;border-radius:10px;font-size:13px;font-weight:700;letter-spacing:.3px;transition:var(--transition);box-shadow:0 4px 14px rgba(232,160,32,.3)}
    .btn-cta:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(232,160,32,.45)}

    /* ===== HERO SLIDER ===== */
    .hero-slider{position:relative;height:600px;overflow:hidden}
    .slide{position:absolute;inset:0;opacity:0;transition:opacity 1s ease,transform 1s ease;transform:scale(1.05)}
    .slide.active{opacity:1;transform:scale(1)}
    .slide-bg{position:absolute;inset:0;background-size:cover;background-position:center}
    .slide-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(10,35,66,.92) 0%,rgba(26,58,107,.75) 50%,rgba(10,35,66,.6) 100%)}
    .slide-content{position:relative;z-index:2;height:100%;max-width:1200px;margin:0 auto;padding:0 40px;display:flex;align-items:center}
    .slide-left{flex:1;padding-right:40px}
    .slide-right{flex:0 0 420px;display:flex;align-items:center;justify-content:center}

    .slide-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);color:var(--accent);font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:8px 18px;border-radius:30px;margin-bottom:20px;backdrop-filter:blur(10px)}
    .slide-badge i{font-size:14px}
    .slide h1{font-family:'Playfair Display',serif;font-size:52px;font-weight:900;color:#fff;line-height:1.15;margin-bottom:18px}
    .slide h1 span{color:var(--accent);position:relative}
    .slide h1 span::after{content:'';position:absolute;bottom:2px;left:0;right:0;height:3px;background:var(--accent);border-radius:2px;opacity:.5}
    .slide p{color:rgba(255,255,255,.75);font-size:17px;line-height:1.8;margin-bottom:32px;max-width:520px}
    .slide-btns{display:flex;gap:14px;flex-wrap:wrap}
    .btn-slide{padding:14px 32px;border-radius:12px;font-size:14.5px;font-weight:700;transition:var(--transition);border:none;letter-spacing:.3px}
    .btn-slide.primary{background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);box-shadow:0 4px 20px rgba(232,160,32,.4)}
    .btn-slide.primary:hover{transform:translateY(-3px);box-shadow:0 8px 30px rgba(232,160,32,.55)}
    .btn-slide.secondary{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.3);backdrop-filter:blur(10px)}
    .btn-slide.secondary:hover{background:rgba(255,255,255,.2);transform:translateY(-3px)}

    .slide-image{width:360px;height:360px;border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3);animation:float 4s ease-in-out infinite;position:relative}
    .slide-image img{width:100%;height:100%;object-fit:cover}
    .slide-image::after{content:'';position:absolute;inset:0;border:2px solid rgba(255,255,255,.1);border-radius:24px}

    /* Slider Controls */
    .slider-controls{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);z-index:10;display:flex;align-items:center;gap:8px;background:rgba(0,0,0,.3);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.12);padding:8px 16px;border-radius:40px}
    .slider-dot{width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,.35);border:none;cursor:pointer;transition:var(--transition)}
    .slider-dot:hover{background:rgba(255,255,255,.6)}
    .slider-dot.active{background:var(--accent);width:32px;border-radius:5px;box-shadow:0 0 10px rgba(232,160,32,.5)}
    .slider-arrow{position:absolute;top:50%;transform:translateY(-50%);z-index:10;width:52px;height:52px;border-radius:14px;background:rgba(0,0,0,.25);backdrop-filter:blur(12px);border:1.5px solid rgba(255,255,255,.15);color:#fff;font-size:18px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:var(--transition)}
    .slider-arrow:hover{background:var(--accent);border-color:var(--accent);color:var(--primary);transform:translateY(-50%) scale(1.08);box-shadow:0 6px 24px rgba(232,160,32,.4)}
    .slider-arrow:active{transform:translateY(-50%) scale(.95)}
    .slider-arrow.prev{left:24px}
    .slider-arrow.next{right:24px}

    /* ===== FEATURES BAR ===== */
    .features-bar{background:var(--white);padding:0 40px;border-bottom:1px solid var(--border)}
    .features-grid{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:0}
    .feature-item{display:flex;align-items:center;gap:14px;padding:24px 20px;border-right:1px solid var(--border);transition:var(--transition)}
    .feature-item:last-child{border-right:none}
    .feature-item:hover{background:rgba(232,160,32,.05)}
    .feature-icon{width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(232,160,32,.1),rgba(232,160,32,.05));display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--accent);flex-shrink:0}
    .feature-text h4{font-size:13.5px;font-weight:700;color:var(--primary);margin-bottom:2px}
    .feature-text p{font-size:12px;color:var(--muted)}

    /* ===== SECTION COMMON ===== */
    .section{padding:80px 40px;max-width:1200px;margin:0 auto}
    .section-header{text-align:center;margin-bottom:50px}
    .section-label{font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--accent);font-weight:700;margin-bottom:8px;display:flex;align-items:center;justify-content:center;gap:8px}
    .section-label::before,.section-label::after{content:'';width:24px;height:2px;background:var(--accent);border-radius:1px}
    .section-title{font-family:'Playfair Display',serif;font-size:38px;font-weight:800;color:var(--primary);margin-bottom:10px}
    .section-desc{font-size:15px;color:var(--muted);max-width:520px;margin:0 auto}
    .section-line{width:50px;height:3px;background:linear-gradient(90deg,var(--accent),#f0b840);margin:16px auto 0;border-radius:2px}

    /* ===== CATEGORIES ===== */
    .categories-section{background:var(--white)}
    .cat-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:18px}
    .cat-card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius);text-align:center;cursor:pointer;transition:var(--transition);position:relative;overflow:hidden}
    .cat-card::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--accent),#f0b840);transform:scaleX(0);transition:transform .35s ease;transform-origin:center;z-index:2}
    .cat-card:hover{transform:translateY(-8px);box-shadow:var(--shadow-hover);border-color:transparent}
    .cat-card:hover::before{transform:scaleX(1)}
    .cat-card:hover .cat-img img{transform:scale(1.1)}
    .cat-card:hover .cat-overlay{opacity:1}
    .cat-img{width:100%;height:160px;position:relative;overflow:hidden}
    .cat-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
    .cat-overlay{position:absolute;inset:0;background:linear-gradient(180deg,transparent 30%,rgba(10,35,66,.6) 100%);opacity:0;transition:var(--transition)}
    .cat-info{padding:16px 12px 18px}
    .cat-name{font-size:14px;font-weight:700;color:var(--primary);margin-bottom:4px}
    .cat-count{font-size:11.5px;color:var(--muted);font-weight:500}

    /* ===== PROMO BANNER (Split Image + Text) ===== */
    .promo-split{padding:0 40px;margin:0 auto;max-width:1200px}
    .promo-split-inner{display:flex;border-radius:20px;overflow:hidden;box-shadow:var(--shadow-hover);min-height:400px}
    .promo-img{flex:0 0 50%;position:relative;overflow:hidden}
    .promo-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
    .promo-split-inner:hover .promo-img img{transform:scale(1.05)}
    .promo-text{flex:1;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);padding:50px 48px;display:flex;flex-direction:column;justify-content:center}
    .promo-text .promo-label{font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--accent);font-weight:700;margin-bottom:12px}
    .promo-text h2{font-family:'Playfair Display',serif;font-size:38px;font-weight:800;color:#fff;line-height:1.25;margin-bottom:14px}
    .promo-text p{color:rgba(255,255,255,.7);font-size:15px;line-height:1.8;margin-bottom:28px}
    .promo-text .btn-promo{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);border:none;padding:14px 30px;border-radius:12px;font-size:14px;font-weight:700;transition:var(--transition)}
    .promo-text .btn-promo:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(232,160,32,.4)}

    /* ===== PRODUCTS ===== */
    .products-section{background:var(--light)}
    .prod-tabs{display:flex;justify-content:center;gap:8px;margin-bottom:40px;flex-wrap:wrap}
    .prod-tab{padding:9px 22px;border-radius:30px;border:1.5px solid var(--border);background:var(--white);font-size:13px;font-weight:600;color:var(--muted);transition:var(--transition);cursor:pointer}
    .prod-tab:hover,.prod-tab.active{background:var(--primary);color:#fff;border-color:var(--primary)}
    .prod-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px}
    .prod-card{background:var(--white);border-radius:var(--radius);overflow:hidden;border:1px solid var(--border);transition:var(--transition);position:relative}
    .prod-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-hover);border-color:transparent}
    .prod-card .prod-img{height:220px;position:relative;overflow:hidden;background:var(--light)}
    .prod-card .prod-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
    .prod-card:hover .prod-img img{transform:scale(1.08)}
    .prod-card .prod-overlay{position:absolute;top:0;right:0;bottom:0;left:0;background:rgba(10,35,66,.05);opacity:0;transition:var(--transition);display:flex;align-items:center;justify-content:center;gap:10px}
    .prod-card:hover .prod-overlay{opacity:1}
    .prod-overlay-btn{width:40px;height:40px;border-radius:50%;background:var(--white);border:none;color:var(--primary);font-size:16px;box-shadow:0 4px 14px rgba(0,0,0,.1);transition:var(--transition);transform:translateY(10px);opacity:0}
    .prod-card:hover .prod-overlay-btn{transform:translateY(0);opacity:1}
    .prod-overlay-btn:hover{background:var(--accent);color:#fff}
    .prod-card:hover .prod-overlay-btn:nth-child(1){transition-delay:.05s}
    .prod-card:hover .prod-overlay-btn:nth-child(2){transition-delay:.1s}
    .prod-card:hover .prod-overlay-btn:nth-child(3){transition-delay:.15s}
    .prod-badge{position:absolute;top:14px;left:14px;font-size:10.5px;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:5px 12px;border-radius:6px;z-index:2}
    .badge-new{background:#dcf5e7;color:#1a8a4a}
    .badge-hot{background:#fff3db;color:#b07a10}
    .badge-sale{background:#fde8e8;color:#b02a2a}
    .prod-wishlist{position:absolute;top:14px;right:14px;width:34px;height:34px;border-radius:50%;background:var(--white);border:none;color:var(--muted);font-size:14px;z-index:2;box-shadow:0 2px 8px rgba(0,0,0,.08);transition:var(--transition)}
    .prod-wishlist:hover{color:var(--accent2);transform:scale(1.1)}
    .prod-body{padding:18px 20px 20px}
    .prod-cat{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:1px;font-weight:600;margin-bottom:6px}
    .prod-name{font-size:15px;font-weight:700;color:var(--primary);margin-bottom:8px;line-height:1.4}
    .prod-rating{display:flex;align-items:center;gap:4px;margin-bottom:10px}
    .prod-rating i{font-size:12px;color:var(--accent)}
    .prod-rating span{font-size:11.5px;color:var(--muted);margin-left:4px}
    .prod-price-row{display:flex;align-items:baseline;gap:8px;margin-bottom:14px}
    .prod-price{font-size:20px;font-weight:800;color:var(--primary)}
    .prod-old{font-size:13px;color:var(--muted);text-decoration:line-through}
    .prod-discount{font-size:11px;font-weight:700;color:#1a8a4a;background:#dcf5e7;padding:2px 8px;border-radius:4px}
    .btn-add{width:100%;background:var(--primary);color:#fff;border:none;padding:12px;border-radius:10px;font-size:13.5px;font-weight:700;transition:var(--transition);display:flex;align-items:center;justify-content:center;gap:8px}
    .btn-add:hover{background:var(--accent);color:var(--primary)}


    /* ===== ABOUT US ===== */
    .about-section{padding:80px 40px;background:var(--white);position:relative;overflow:hidden}
    .about-section::before{content:'';position:absolute;top:-100px;right:-100px;width:350px;height:350px;border-radius:50%;background:rgba(232,160,32,.04)}
    .about-section::after{content:'';position:absolute;bottom:-80px;left:-80px;width:280px;height:280px;border-radius:50%;background:rgba(10,35,66,.03)}
    .about-wrapper{max-width:1200px;margin:0 auto;position:relative;z-index:1}
    .about-grid{display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center;margin-bottom:60px}
    .about-img-box{position:relative}
    .about-img-box img{width:100%;height:480px;object-fit:cover;border-radius:20px;box-shadow:0 20px 50px rgba(10,35,66,.12)}
    .about-img-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr;gap:2px;border-radius:20px;overflow:hidden;box-shadow:0 20px 50px rgba(10,35,66,.12);height:480px;background:#fff}
    .about-img-grid .tile{position:relative;overflow:hidden}
    .about-img-grid .tile img{width:100%;height:100%;object-fit:cover;border-radius:0;box-shadow:none;transition:transform .6s ease;display:block}
    .about-img-grid .tile:hover img{transform:scale(1.06)}
    .about-img-box::after{content:'';position:absolute;top:20px;left:20px;right:-20px;bottom:-20px;border:2.5px solid var(--accent);border-radius:20px;z-index:-1;opacity:.4}
    .about-img-badge{position:absolute;bottom:24px;right:-20px;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);padding:18px 28px;border-radius:14px;box-shadow:0 10px 30px rgba(232,160,32,.35);text-align:center}
    .about-img-badge .badge-num{font-family:'Playfair Display',serif;font-size:36px;font-weight:900;line-height:1}
    .about-img-badge .badge-text{font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-top:2px}
    .about-text-box .about-label{font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--accent);font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px}
    .about-text-box .about-label::before{content:'';width:24px;height:2px;background:var(--accent);border-radius:1px}
    .about-text-box h2{font-family:'Playfair Display',serif;font-size:38px;font-weight:800;color:var(--primary);line-height:1.25;margin-bottom:18px}
    .about-text-box h2 span{color:var(--accent);position:relative}
    .about-text-box>p{font-size:15.5px;color:var(--muted);line-height:1.85;margin-bottom:24px}
    .about-highlights{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:28px}
    .about-highlight{display:flex;align-items:flex-start;gap:12px}
    .about-highlight .ah-icon{width:42px;height:42px;border-radius:10px;background:rgba(232,160,32,.1);display:flex;align-items:center;justify-content:center;font-size:17px;color:var(--accent);flex-shrink:0}
    .about-highlight .ah-text h4{font-size:13.5px;font-weight:700;color:var(--primary);margin-bottom:2px}
    .about-highlight .ah-text p{font-size:12px;color:var(--muted);line-height:1.6}
    .btn-about{display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);border:none;padding:14px 30px;border-radius:12px;font-size:14px;font-weight:700;transition:var(--transition);box-shadow:0 4px 14px rgba(232,160,32,.3)}
    .btn-about:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(232,160,32,.45)}

    /* ===== MISSION / OBJECTIVE V2 ===== */
    .mission-section{background:var(--light)}
    .obj-cards-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
    .obj-v2{display:flex;flex-direction:column;align-items:center;text-align:center;background:var(--white);border:1px solid var(--border);border-radius:var(--radius);padding:32px 22px;transition:var(--transition);position:relative;overflow:hidden}
    .obj-v2::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--accent),#f0b840);transform:scaleX(0);transition:transform .35s ease;transform-origin:center}
    .obj-v2:hover{transform:translateY(-6px);box-shadow:var(--shadow-hover);border-color:transparent}
    .obj-v2:hover::before{transform:scaleX(1)}
    .obj-v2:hover .obj-v2-icon{background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary)}
    .obj-v2-icon{width:60px;height:60px;border-radius:50%;background:rgba(232,160,32,.1);display:flex;align-items:center;justify-content:center;font-size:24px;color:var(--accent);flex-shrink:0;transition:var(--transition);margin-bottom:18px}
    .obj-v2-body h3{font-family:'Playfair Display',serif;font-size:17px;font-weight:700;color:var(--primary);margin-bottom:8px}
    .obj-v2-body p{font-size:13px;color:var(--muted);line-height:1.8}

    /* ===== YOUTH EMPOWERMENT V2 — Image + Text ===== */
    .youth-section{max-width:1200px;margin:0 auto;padding:0 40px 80px}
    .youth-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;border-radius:24px;overflow:hidden;box-shadow:var(--shadow-hover)}
    .youth-img-side{position:relative;overflow:hidden;min-height:440px}
    .youth-img-side img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
    .youth-grid:hover .youth-img-side img{transform:scale(1.04)}
    .youth-text-side{background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);padding:50px 48px;display:flex;flex-direction:column;justify-content:center;position:relative;overflow:hidden}
    .youth-text-side::before{content:'';position:absolute;top:-40%;right:-15%;width:300px;height:300px;border-radius:50%;background:rgba(232,160,32,.06)}
    .youth-text-side h2{font-family:'Playfair Display',serif;font-size:34px;font-weight:800;color:#fff;line-height:1.3;margin-bottom:16px;position:relative;z-index:1}
    .youth-text-side h2 span{color:var(--accent)}
    .youth-text-side p{color:rgba(255,255,255,.7);font-size:14.5px;line-height:1.85;margin-bottom:12px;position:relative;z-index:1}
    .btn-youth-v2{display:inline-flex;align-items:center;gap:8px;margin-top:14px;padding:14px 32px;border-radius:12px;font-size:14.5px;font-weight:700;border:none;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);transition:var(--transition);box-shadow:0 4px 18px rgba(232,160,32,.35);position:relative;z-index:1;align-self:flex-start}
    .btn-youth-v2:hover{transform:translateY(-3px);box-shadow:0 8px 30px rgba(232,160,32,.5)}

    /* ===== ADVERTISING V2 — Professional Clean Grid ===== */
    .adv-section-v2{background:var(--white);position:relative;overflow:hidden}
    .adv-section-v2::before{content:'';position:absolute;top:-10%;right:-8%;width:500px;height:500px;border-radius:50%;background:rgba(232,160,32,.04)}
    .adv-section-v2::after{content:'';position:absolute;bottom:-10%;left:-5%;width:400px;height:400px;border-radius:50%;background:rgba(10,35,66,.03)}
    .adv-grid-v2{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:20px;position:relative;z-index:1}
    .adv-v2{background:var(--white);border:1px solid var(--border);border-radius:var(--radius);text-align:center;transition:var(--transition);position:relative;overflow:hidden}
    .adv-v2::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--accent),#f0b840);transform:scaleX(0);transition:transform .35s ease;transform-origin:center}
    .adv-v2:hover{transform:translateY(-6px);box-shadow:var(--shadow-hover);border-color:transparent}
    .adv-v2:hover::before{transform:scaleX(1)}
    .adv-v2:hover .adv-v2-img img{transform:scale(1.08)}
    .adv-v2-img{width:100%;height:140px;overflow:hidden}
    .adv-v2-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
    .adv-v2-text{padding:18px 16px 22px}
    .adv-v2-text h4{font-size:15px;font-weight:700;color:var(--primary);margin-bottom:5px}
    .adv-v2-text p{font-size:12.5px;color:var(--muted);line-height:1.7}

    /* ===== CONTACT / ENQUIRY SECTION ===== */
    .enquiry-section{padding:80px 40px;background:var(--light)}
    .enquiry-grid{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:0;border-radius:24px;overflow:hidden;box-shadow:var(--shadow-hover)}
    .enquiry-img{position:relative;overflow:hidden;min-height:560px}
    .enquiry-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s ease}
    .enquiry-img:hover img{transform:scale(1.04)}
    .enquiry-img-overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(10,35,66,.3) 0%,rgba(10,35,66,.85) 100%);display:flex;flex-direction:column;justify-content:flex-end;padding:40px}
    .enquiry-img-overlay .eio-label{font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--accent);font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px}
    .enquiry-img-overlay .eio-label::before{content:'';width:20px;height:2px;background:var(--accent);border-radius:1px}
    .enquiry-img-overlay h2{font-family:'Playfair Display',serif;font-size:32px;font-weight:800;color:#fff;line-height:1.25;margin-bottom:12px}
    .enquiry-img-overlay h2 span{color:var(--accent)}
    .enquiry-img-overlay p{color:rgba(255,255,255,.7);font-size:14px;line-height:1.8;max-width:380px}
    .enquiry-img-stats{display:flex;gap:24px;margin-top:24px}
    .eio-stat{text-align:center}
    .eio-stat .stat-num{font-family:'Playfair Display',serif;font-size:28px;font-weight:900;color:var(--accent)}
    .eio-stat .stat-label{font-size:11px;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:1px;margin-top:2px}
    .enquiry-form-box{background:var(--white);padding:48px 44px;display:flex;flex-direction:column;justify-content:center}
    .enquiry-form-box .ef-title{font-family:'Playfair Display',serif;font-size:26px;font-weight:800;color:var(--primary);margin-bottom:6px}
    .enquiry-form-box .ef-desc{font-size:13.5px;color:var(--muted);margin-bottom:28px;line-height:1.6}
    .ef-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
    .ef-row.full{grid-template-columns:1fr}
    .ef-field{display:flex;flex-direction:column;gap:6px}
    .ef-field label{font-size:12px;font-weight:700;color:var(--primary);letter-spacing:.5px;text-transform:uppercase}
    .ef-field input,.ef-field select,.ef-field textarea{width:100%;padding:12px 16px;border:1.5px solid var(--border);border-radius:10px;font-size:13.5px;font-family:inherit;color:var(--text);background:var(--light);transition:var(--transition);outline:none}
    .ef-field input:focus,.ef-field select:focus,.ef-field textarea:focus{border-color:var(--accent);background:var(--white);box-shadow:0 0 0 3px rgba(232,160,32,.1)}
    .ef-field textarea{resize:vertical;min-height:90px}
    .ef-field .ef-error{font-size:11.5px;color:#b02a2a;margin-top:2px}
    .btn-enquiry{width:100%;margin-top:8px;padding:14px;border-radius:12px;border:none;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);font-size:15px;font-weight:700;letter-spacing:.3px;transition:var(--transition);box-shadow:0 4px 14px rgba(232,160,32,.3);display:flex;align-items:center;justify-content:center;gap:8px}
    .btn-enquiry:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(232,160,32,.45)}
    .ef-note{font-size:11.5px;color:var(--muted);text-align:center;margin-top:14px}
    .ef-note i{color:var(--accent)}
    .ef-alert{padding:12px 16px;border-radius:10px;font-size:13px;font-weight:600;margin-bottom:18px;display:flex;align-items:center;gap:8px}
    .ef-alert.success{background:#dcf5e7;color:#1a8a4a;border:1px solid #1a8a4a33}
    .ef-alert.error{background:#fde8e8;color:#b02a2a;border:1px solid #b02a2a33}

    @media(max-width:768px){
      .about-grid{grid-template-columns:1fr}
      .about-img-box::after{display:none}
      .about-img-badge{right:16px}
      .obj-cards-grid{grid-template-columns:1fr 1fr}
      .youth-grid{grid-template-columns:1fr}
      .youth-img-side{min-height:280px}
      .adv-grid-v2{grid-template-columns:repeat(2,1fr)}
      .about-highlights{grid-template-columns:1fr}
      .enquiry-grid{grid-template-columns:1fr}
    }

    /* ===== FOOTER ===== */
    footer{background:#060f1e;color:rgba(255,255,255,.65);padding:70px 40px 0}
    .footer-top{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:48px;padding-bottom:50px;border-bottom:1px solid rgba(255,255,255,.08)}
    .foot-brand .foot-logo{font-family:'Playfair Display',serif;font-size:24px;font-weight:800;color:#fff;margin-bottom:14px}
    .foot-brand .foot-tagline{font-size:13.5px;line-height:1.8;margin-bottom:20px}
    .foot-brand .social-links{display:flex;gap:10px}
    .social-links a{width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:15px;transition:var(--transition)}
    .social-links a:hover{background:var(--accent);border-color:var(--accent);color:var(--primary)}
    .foot-col h4{font-size:13px;font-weight:700;color:#fff;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:20px;padding-bottom:10px;border-bottom:2px solid var(--accent);display:inline-block}
    .foot-col ul{list-style:none}
    .foot-col ul li{margin-bottom:10px}
    .foot-col ul li a{font-size:13px;color:rgba(255,255,255,.55);transition:var(--transition);display:flex;align-items:center;gap:6px}
    .foot-col ul li a:hover{color:var(--accent);padding-left:4px}
    .foot-col ul li a i{font-size:10px;color:var(--accent);opacity:.5}
    .footer-bottom{max-width:1200px;margin:0 auto;padding:24px 0;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px}
    .footer-bottom p{font-size:12px;color:rgba(255,255,255,.35)}
    .foot-badges{display:flex;gap:10px}
    .f-badge{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:6px 14px;font-size:11.5px;color:rgba(255,255,255,.55);display:flex;align-items:center;gap:6px}
    .f-badge i{color:var(--accent);font-size:13px}

    /* ===== SCROLL TOP ===== */
    .scroll-top{position:fixed;bottom:30px;right:30px;width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);border:none;font-size:18px;box-shadow:0 6px 20px rgba(232,160,32,.35);z-index:999;opacity:0;transform:translateY(20px);transition:var(--transition);display:flex;align-items:center;justify-content:center}
    .scroll-top.show{opacity:1;transform:translateY(0)}
    .scroll-top:hover{transform:translateY(-3px);box-shadow:0 8px 28px rgba(232,160,32,.5)}

    /* ===== WHATSAPP FLOATING ===== */
    .whatsapp-float{position:fixed;bottom:90px;right:30px;width:54px;height:54px;border-radius:50%;background:#25D366;color:#fff;font-size:28px;display:flex;align-items:center;justify-content:center;z-index:999;box-shadow:0 6px 20px rgba(37,211,102,.4);transition:var(--transition);text-decoration:none}
    .whatsapp-float:hover{transform:scale(1.1);box-shadow:0 8px 28px rgba(37,211,102,.55)}
    .whatsapp-float .wa-pulse{position:absolute;inset:-4px;border-radius:50%;border:2px solid #25D366;animation:waPulse 2s ease-in-out infinite}
    @keyframes waPulse{0%,100%{transform:scale(1);opacity:.6}50%{transform:scale(1.3);opacity:0}}

    /* ===== RESPONSIVE ===== */
    @media(max-width:1024px){
      .cat-grid{grid-template-columns:repeat(4,1fr)}
      .prod-grid{grid-template-columns:repeat(3,1fr)}
      .adv-grid-v2{grid-template-columns:repeat(3,1fr)}
      .slide-right{display:none}
      .slide h1{font-size:42px}
      .hero-slider{height:500px}
    }
    @media(max-width:768px){
      .topbar{flex-direction:column;gap:4px;text-align:center;padding:8px 16px}
      .navbar{padding:0 16px}
      .nav-menu{display:none}
      .nav-actions .search-box{display:none}
      .cat-grid{grid-template-columns:repeat(3,1fr)}
      .prod-grid{grid-template-columns:repeat(2,1fr)}
      .adv-grid{grid-template-columns:repeat(2,1fr)}
      .features-grid{grid-template-columns:repeat(2,1fr)}
      .feature-item{border-right:none;border-bottom:1px solid var(--border)}
      .footer-top{grid-template-columns:1fr 1fr}
      .cta-inner{padding:40px 24px}
      .promo-split-inner{flex-direction:column}
      .slide h1{font-size:32px}
      .slide p{font-size:14px}
      .hero-slider{height:450px}
      .section{padding:50px 16px}
    }
    @media(max-width:480px){
      .cat-grid{grid-template-columns:repeat(2,1fr)}
      .prod-grid{grid-template-columns:1fr}
      .adv-grid-v2{grid-template-columns:1fr}
      .footer-top{grid-template-columns:1fr}
    }
  </style>
</head>
<body>

<!-- ===== TOP BAR ===== -->
<div class="topbar">
  <span><i class="fas fa-location-dot"></i> By Pass Road, Hukkeri, Belgaum — 591309, Karnataka</span>
  <span><i class="fas fa-phone"></i> +91 88841 10767 &nbsp;|&nbsp; <i class="fas fa-clock"></i> Mon–Sat: 9AM–7PM</span>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar" id="navbar">
  <div class="logo">
    <div class="logo-mark">
      @if(!empty($settings['logo_path']))
        <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;background:#0A2342;padding:4px">
      @else
        <svg viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="46" height="46" rx="12" fill="#0A2342"/>
          <path d="M8 33 L16 13 L23 28 L30 13 L38 33" stroke="#E8A020" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          <circle cx="23" cy="12" r="3" fill="#E8A020"/>
          <path d="M13 36 L33 36" stroke="#E8A020" stroke-width="2" stroke-linecap="round" opacity=".5"/>
        </svg>
      @endif
    </div>
    <div>
      <div class="logo-text">Yesb <em>Confident</em></div>
      <div class="logo-sub">E-Commerce & Advertising</div>
    </div>
  </div>
  <div class="nav-menu">
    <a href="#" class="active">Home</a>
    <a href="#about">About Us</a>
    <a href="#categories">Category</a>
    <a href="#advertising">Advertising</a>
    <a href="#enquiry">Contact</a>
  </div>
  <div class="nav-actions">
    <button class="btn-cta" onclick="window.location.href='tel:+918884110767'"><i class="fas fa-phone"></i>&nbsp; Call Now</button>
  </div>
</nav>

<!-- ===== HERO SLIDER ===== -->
<div class="hero-slider" id="heroSlider">
  <!-- Slide 1 -->
  <div class="slide active">
    <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1400&q=80')"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-left">
        <div class="slide-badge"><i class="fas fa-bullhorn"></i> Advertising & Branding Experts</div>
        <h1>Grow Your<br><span>Business</span> With<br>Yesb Confident</h1>
        <p>Complete advertising solutions — from social media to outdoor hoardings. Let us help your brand reach the right audience and grow faster.</p>
        <div class="slide-btns">
          <button class="btn-slide primary" onclick="document.getElementById('enquiry').scrollIntoView({behavior:'smooth'})"><i class="fas fa-paper-plane"></i>&nbsp; Contact Us</button>
          <button class="btn-slide secondary" onclick="document.getElementById('advertising').scrollIntoView({behavior:'smooth'})"><i class="fas fa-rocket"></i>&nbsp; Our Services</button>
        </div>
      </div>
      <div class="slide-right">
        <div class="slide-image">
          <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&q=80" alt="Electronics">
        </div>
      </div>
    </div>
  </div>

  <!-- Slide 2 -->
  <div class="slide">
    <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1400&q=80')"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-left">
        <div class="slide-badge"><i class="fas fa-briefcase"></i> Career Opportunities</div>
        <h1>Work With Us<br>Earn With<br><span>Confidence</span></h1>
        <p>Join our affiliate program and start your career journey — no experience needed, just the will to learn, grow, and earn.</p>
        <div class="slide-btns">
          <button class="btn-slide primary" onclick="document.getElementById('enquiry').scrollIntoView({behavior:'smooth'})"><i class="fas fa-user-plus"></i>&nbsp; Join Us Today</button>
          <button class="btn-slide secondary" onclick="document.getElementById('about').scrollIntoView({behavior:'smooth'})"><i class="fas fa-info-circle"></i>&nbsp; Learn More</button>
        </div>
      </div>
      <div class="slide-right">
        <div class="slide-image">
          <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=500&q=80" alt="Fashion">
        </div>
      </div>
    </div>
  </div>

  <!-- Slide 3 -->
  <div class="slide">
    <div class="slide-bg" style="background-image:url('https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1400&q=80')"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-left">
        <div class="slide-badge"><i class="fas fa-bullhorn"></i> Grow Your Brand</div>
        <h1>14 Powerful<br><span>Advertising</span><br>Services</h1>
        <p>From social media to outdoor hoardings — we offer complete advertising solutions to skyrocket your business growth.</p>
        <div class="slide-btns">
          <button class="btn-slide primary" onclick="document.getElementById('advertising').scrollIntoView({behavior:'smooth'})"><i class="fas fa-rocket"></i>&nbsp; Get Started</button>
          <button class="btn-slide secondary" onclick="window.location.href='tel:+918884110767'"><i class="fas fa-phone"></i>&nbsp; Call for Quote</button>
        </div>
      </div>
      <div class="slide-right">
        <div class="slide-image">
          <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&q=80" alt="Advertising">
        </div>
      </div>
    </div>
  </div>

  <!-- Slider Arrows -->
  <button class="slider-arrow prev" onclick="changeSlide(-1)"><i class="fas fa-arrow-left"></i></button>
  <button class="slider-arrow next" onclick="changeSlide(1)"><i class="fas fa-arrow-right"></i></button>

  <!-- Slider Dots -->
  <div class="slider-controls">
    <div class="slider-dot active" onclick="goToSlide(0)"></div>
    <div class="slider-dot" onclick="goToSlide(1)"></div>
    <div class="slider-dot" onclick="goToSlide(2)"></div>
  </div>
</div>

<!-- ===== FEATURES BAR ===== -->
<div class="features-bar">
  <div class="features-grid">
    <div class="feature-item">
      <div class="feature-icon"><i class="fas fa-truck-fast"></i></div>
      <div class="feature-text"><h4>Free Shipping</h4><p>On orders above ₹499</p></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
      <div class="feature-text"><h4>Secure Payment</h4><p>100% protected checkout</p></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon"><i class="fas fa-rotate-left"></i></div>
      <div class="feature-text"><h4>Easy Returns</h4><p>7-day return policy</p></div>
    </div>
    <div class="feature-item">
      <div class="feature-icon"><i class="fas fa-headset"></i></div>
      <div class="feature-text"><h4>24/7 Support</h4><p>Dedicated help center</p></div>
    </div>
  </div>
</div>

<!-- ========================================================
     1. ABOUT US — Who We Are
     ======================================================== -->
<div class="about-section" id="about">
  <div class="about-wrapper">
    <div class="about-grid">
      <div class="about-img-box reveal">
        <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?w=900&q=85" alt="Variety of e-commerce products">
        <div class="about-img-badge">
          <div class="badge-num">5+</div>
          <div class="badge-text">Years of Service</div>
        </div>
      </div>
      <div class="about-text-box reveal">
        <div class="about-label">Who We Are</div>
        <h2>About <span>Yesb Confident</span><br>Commerce & Advertising</h2>
        <p>We are more than just an e-commerce platform. Yesb Confident is a mission-driven initiative that delivers quality products customers can trust — while empowering unemployed youth with real-world careers in advertising and sales.</p>
        <p>In today's fast-evolving digital landscape, advertising and sales are among the most in-demand skills. We provide an innovative platform that gives young professionals hands-on experience, industry training, and a launchpad to build their careers.</p>
        <div class="about-highlights">
          <div class="about-highlight">
            <div class="ah-icon"><i class="fas fa-handshake"></i></div>
            <div class="ah-text"><h4>Trusted Products</h4><p>Quality goods at honest prices</p></div>
          </div>
          <div class="about-highlight">
            <div class="ah-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="ah-text"><h4>Youth Careers</h4><p>Jobs for unemployed youth</p></div>
          </div>
          <div class="about-highlight">
            <div class="ah-icon"><i class="fas fa-bullhorn"></i></div>
            <div class="ah-text"><h4>14 Ad Services</h4><p>Full-spectrum advertising</p></div>
          </div>
          <div class="about-highlight">
            <div class="ah-icon"><i class="fas fa-heart"></i></div>
            <div class="ah-text"><h4>Community First</h4><p>Building local livelihoods</p></div>
          </div>
        </div>
        <button class="btn-about" onclick="document.getElementById('advertising').scrollIntoView({behavior:'smooth'})"><i class="fas fa-arrow-right"></i> Explore Our Services</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     2. OUR OBJECTIVE + YOUTH EMPOWERMENT (Redesigned)
     ======================================================== -->
<div class="mission-section" id="mission">
  <div class="section" style="padding-bottom:40px">
    <div class="section-header reveal">
      <div class="section-label">Our Mission</div>
      <div class="section-title">Our Objective</div>
      <div class="section-desc">What drives us every day — quality, trust, and empowering the next generation</div>
      <div class="section-line"></div>
    </div>
    <!-- Objective Cards — icon left, text right -->
    <div class="obj-cards-grid">
      <div class="obj-v2 reveal">
        <div class="obj-v2-icon"><i class="fas fa-gem"></i></div>
        <div class="obj-v2-body">
          <h3>Quality & Trust</h3>
          <p>Providing quality products that are good and trustworthy to every customer. We carefully curate our catalog so customers shop with confidence.</p>
        </div>
      </div>
      <div class="obj-v2 reveal">
        <div class="obj-v2-icon"><i class="fas fa-headset"></i></div>
        <div class="obj-v2-body">
          <h3>Continuous Service</h3>
          <p>Providing continuous, reliable quality service that goes beyond the sale. From pre-purchase guidance to after-sales support, we build lasting relationships.</p>
        </div>
      </div>
      <div class="obj-v2 reveal">
        <div class="obj-v2-icon"><i class="fas fa-briefcase"></i></div>
        <div class="obj-v2-body">
          <h3>Empowering Youth</h3>
          <p>Creating advertising and sales jobs for unemployed youth — roles in constant demand. We give real experience, practical skills, and meaningful work.</p>
        </div>
      </div>
      <div class="obj-v2 reveal">
        <div class="obj-v2-icon"><i class="fas fa-lightbulb"></i></div>
        <div class="obj-v2-body">
          <h3>Innovation & Growth</h3>
          <p>An innovative platform that meets modern-day demands — combining e-commerce and advertising to build a platform that grows with you.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Youth Empowerment — Image + Text (Redesigned) -->
  <div class="youth-section">
    <div class="youth-grid reveal">
      <div class="youth-img-side">
        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=700&q=80" alt="Young team working in e-commerce">
      </div>
      <div class="youth-text-side">
        <div class="section-label" style="justify-content:flex-start">Our Initiative</div>
        <h2>A Small Contribution to<br><span>Unemployed Youth</span></h2>
        <p>Use this platform and earn money. Advertising and sales are among the most in-demand careers today. We are trying to do an innovative job that gives you real experience, builds your skills, and puts you to work.</p>
        <p>Join us and start your career journey today — no experience needed, just the will to learn and grow.</p>
        <button class="btn-youth-v2" onclick="document.getElementById('enquiry').scrollIntoView({behavior:'smooth'})"><i class="fas fa-rocket"></i>&nbsp; Join Us Today</button>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     3. DEALS — Categories (Renamed, Short)
     ======================================================== -->
<div class="categories-section" id="categories">
  <div class="section">
    <div class="section-header reveal">
      <div class="section-label">Best Deals</div>
      <div class="section-title">Deals & Categories</div>
      <div class="section-desc">Explore top deals across our most popular product categories</div>
      <div class="section-line"></div>
    </div>
    <div class="cat-grid">
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&q=80" alt="Smartphones"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Smartphones</div><div class="cat-count">120+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=300&q=80" alt="Laptops"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Laptops</div><div class="cat-count">85+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&q=80" alt="Audio"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Audio</div><div class="cat-count">200+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?w=300&q=80" alt="Gaming"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Gaming</div><div class="cat-count">65+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=300&q=80" alt="Kitchen"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Kitchen</div><div class="cat-count">150+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&q=80" alt="Furniture"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Furniture</div><div class="cat-count">90+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=300&q=80" alt="Fashion"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Fashion</div><div class="cat-count">500+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&q=80" alt="Bags"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Bags</div><div class="cat-count">75+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=300&q=80" alt="Auto Parts"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Auto Parts</div><div class="cat-count">110+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?w=300&q=80" alt="Bike Parts"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Bike Parts</div><div class="cat-count">80+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=300&q=80" alt="Garden"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Garden</div><div class="cat-count">60+ Deals</div></div>
      </div>
      <div class="cat-card reveal">
        <div class="cat-img"><img src="https://images.unsplash.com/photo-1563453392212-326f5e854473?w=300&q=80" alt="Cleaning"><div class="cat-overlay"></div></div>
        <div class="cat-info"><div class="cat-name">Cleaning</div><div class="cat-count">45+ Deals</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ========================================================
     5. ADVERTISING SERVICES — Redesigned Professional
     ======================================================== -->
<div class="adv-section-v2" id="advertising">
  <div style="max-width:1200px;margin:0 auto;padding:80px 40px">
    <div class="section-header reveal">
      <div class="section-label">Grow Your Brand</div>
      <div class="section-title">14 Advertising Services</div>
      <div class="section-desc">Complete advertising solutions to boost your business visibility</div>
      <div class="section-line"></div>
    </div>
    <div class="adv-grid-v2">
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1504270997636-07ddfbd48945?w=400&q=80" alt="Print"></div><div class="adv-v2-text"><h4>Print Advertisement</h4><p>Newspapers, magazines & flyers with wide regional reach</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=400&q=80" alt="Business Cards"></div><div class="adv-v2-text"><h4>Direct BC Ads</h4><p>Targeted business card campaigns for local businesses</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1526554850534-7c78330d5f90?w=400&q=80" alt="Direct Mail"></div><div class="adv-v2-text"><h4>Direct Mail</h4><p>Physical mailers delivered directly to your audience</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?w=400&q=80" alt="Podcast"></div><div class="adv-v2-text"><h4>Podcast Ads</h4><p>Reach engaged listeners through curated podcast spots</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&q=80" alt="Mobile"></div><div class="adv-v2-text"><h4>Mobile Ads</h4><p>SMS, in-app & push notification campaigns</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=400&q=80" alt="Social Media"></div><div class="adv-v2-text"><h4>Social Media</h4><p>Facebook, Instagram, YouTube & more — all managed</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&q=80" alt="PPC"></div><div class="adv-v2-text"><h4>Paid Search (PPC)</h4><p>Google Ads & Bing — top of search results</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=400&q=80" alt="Native"></div><div class="adv-v2-text"><h4>Native Advertising</h4><p>Seamlessly blend ads into editorial content</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&q=80" alt="Display"></div><div class="adv-v2-text"><h4>Display Ads</h4><p>Banner & rich media across premium networks</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=400&q=80" alt="Outdoor"></div><div class="adv-v2-text"><h4>Outdoor Ads</h4><p>Hoardings, bus stops & out-of-home placements</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1533750516457-a7f992034fec?w=400&q=80" alt="Guerrilla"></div><div class="adv-v2-text"><h4>Guerrilla Ads</h4><p>Creative street-level activations that stop people</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1485846234645-a62644f84728?w=400&q=80" alt="Product Placement"></div><div class="adv-v2-text"><h4>Product Placement</h4><p>Feature your brand in videos & online content</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&q=80" alt="Public Service"></div><div class="adv-v2-text"><h4>Public Service Ads</h4><p>Build trust through community-focused campaigns</p></div></div>
      <div class="adv-v2 reveal"><div class="adv-v2-img"><img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=400&q=80" alt="Programmatic"></div><div class="adv-v2-text"><h4>Programmatic Ads</h4><p>AI-driven automated ad buying across thousands of sites</p></div></div>
    </div>
  </div>
</div>

<!-- ========================================================
     6. CONTACT US — Enquiry Form
     ======================================================== -->
<div class="enquiry-section" id="enquiry">
  <div style="max-width:1200px;margin:0 auto;padding:0 40px">
    <div class="section-header reveal" style="margin-bottom:40px">
      <div class="section-label">Contact Us</div>
      <div class="section-title">Get In Touch</div>
      <div class="section-desc">Have a question or want to work with us? Send us a message and we'll respond within 24 hours.</div>
      <div class="section-line"></div>
    </div>
  </div>
  <div class="enquiry-grid reveal">
    <div class="enquiry-img">
      <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&q=80" alt="Get in Touch">
      <div class="enquiry-img-overlay">
        <div class="eio-label">We're Here to Help</div>
        <h2>Ready to <span>Advertise</span> or Start Shopping?</h2>
        <p>Connect with us today — promote your business or find the best deals across our catalog.</p>
        <div class="enquiry-img-stats">
          <div class="eio-stat"><div class="stat-num">2500+</div><div class="stat-label">Products</div></div>
          <div class="eio-stat"><div class="stat-num">8500+</div><div class="stat-label">Customers</div></div>
          <div class="eio-stat"><div class="stat-num">14</div><div class="stat-label">Ad Services</div></div>
        </div>
      </div>
    </div>
    <div class="enquiry-form-box">
      <div class="ef-title">Send Us an Enquiry</div>
      <div class="ef-desc">Fill in the details below and our team will get back to you within 24 hours.</div>

      @if (session('success'))
        <div class="ef-alert success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="ef-alert error"><i class="fas fa-exclamation-circle"></i> Please fix the errors below and try again.</div>
      @endif

      <form method="POST" action="{{ route('enquiry.store') }}">
        @csrf
        <div class="ef-row full">
          <div class="ef-field">
            <label>Full Name <span style="color:var(--accent)">*</span></label>
            <input type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
            @error('name')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="ef-row full">
          <div class="ef-field">
            <label>Address <span style="color:var(--accent)">*</span></label>
            <textarea name="address" placeholder="Enter your full address" rows="2" required>{{ old('address') }}</textarea>
            @error('address')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="ef-row">
          <div class="ef-field">
            <label>Contact Number <span style="color:var(--accent)">*</span></label>
            <input type="tel" name="phone" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required>
            @error('phone')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
          <div class="ef-field">
            <label>Email ID <span style="font-size:10px;color:var(--muted)">(Optional)</span></label>
            <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}">
            @error('email')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="ef-row full">
          <div class="ef-field">
            <label>Occupation <span style="color:var(--accent)">*</span></label>
            <input type="text" name="occupation" placeholder="e.g. Student, Business, Employee..." value="{{ old('occupation') }}" required>
            @error('occupation')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="ef-row full">
          <div class="ef-field">
            <label>Interested in Affiliate Program <span style="color:var(--accent)">*</span></label>
            <select name="affiliate_interest" required>
              <option value="">Select...</option>
              <option value="yes" {{ old('affiliate_interest') === 'yes' ? 'selected' : '' }}>Yes, I'm interested</option>
              <option value="no" {{ old('affiliate_interest') === 'no' ? 'selected' : '' }}>No, not right now</option>
            </select>
            @error('affiliate_interest')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="ef-row full">
          <div class="ef-field">
            <label>Any Experience about Affiliate <span style="font-size:10px;color:var(--muted)">(Optional)</span></label>
            <textarea name="affiliate_experience" placeholder="Tell us about your affiliate marketing experience, if any...">{{ old('affiliate_experience') }}</textarea>
            @error('affiliate_experience')<span class="ef-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <button type="submit" class="btn-enquiry"><i class="fas fa-paper-plane"></i> Submit Enquiry</button>
      </form>
      <div class="ef-note"><i class="fas fa-lock"></i>&nbsp; Your information is secure and will never be shared.</div>
    </div>
  </div>
</div>

<!-- ===== FOOTER ===== -->
<footer id="footer">
  <div class="footer-top">
    <div class="foot-brand">
      <div class="foot-logo">Yesb Confident</div>
      <div class="foot-tagline">Your trusted partner for online shopping and full-spectrum digital & traditional advertising services across India.</div>
      <div class="social-links">
        @if(!empty($settings['facebook_url']))<a href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>@endif
        @if(!empty($settings['instagram_url']))<a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>@endif
        @if(!empty($settings['youtube_url']))<a href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>@endif
        @if(!empty($settings['twitter_url']))<a href="{{ $settings['twitter_url'] }}" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>@endif
        @if(!empty($settings['whatsapp_url']))
          @php $wa = str_starts_with($settings['whatsapp_url'], 'http') ? $settings['whatsapp_url'] : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_url']); @endphp
          <a href="{{ $wa }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
        @endif
      </div>
    </div>
    <div class="foot-col">
      <h4>Shop</h4>
      <ul>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Electronics</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Fashion</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Home & Kitchen</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Auto Parts</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Garden Tools</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Bags & Luggage</a></li>
      </ul>
    </div>
    <div class="foot-col">
      <h4>Advertising</h4>
      <ul>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Print & Mail</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Social Media</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Paid Search</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Outdoor Ads</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Programmatic</a></li>
        <li><a href="#"><i class="fas fa-chevron-right"></i> Podcast</a></li>
      </ul>
    </div>
    <div class="foot-col">
      <h4>Contact</h4>
      <ul>
        <li><a href="#"><i class="fas fa-location-dot"></i> By Pass Road, Hukkeri, Belgaum 591309</a></li>
        <li><a href="tel:+918884110767"><i class="fas fa-phone"></i> +91 88841 10767</a></li>
        <li><a href="#"><i class="fas fa-clock"></i> Mon–Sat: 9AM–7PM</a></li>
        <li><a href="#"><i class="fas fa-envelope"></i> info@yesbconfident.com</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Yesb Confident E-Commerce & Advertising. All rights reserved.</p>
    <div class="foot-badges">
      <span class="f-badge"><i class="fas fa-lock"></i> Secure</span>
      <span class="f-badge"><i class="fas fa-truck"></i> Free Delivery</span>
      <span class="f-badge"><i class="fas fa-rotate-left"></i> Easy Returns</span>
      <a href="{{ route('admin.login') }}" class="f-badge" style="text-decoration:none;cursor:pointer;opacity:.5;transition:opacity .3s" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.5'"><i class="fas fa-user-shield"></i> Admin</a>
    </div>
  </div>
</footer>

<!-- WhatsApp Float -->
<a href="https://wa.me/918884110767" target="_blank" class="whatsapp-float"><i class="fab fa-whatsapp"></i><span class="wa-pulse"></span></a>

<!-- Scroll to Top -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-arrow-up"></i></button>

<!-- ===== JAVASCRIPT ===== -->
<script>
  // ===== HERO SLIDER =====
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.slider-dot');
  let slideInterval;

  function goToSlide(n) {
    slides[currentSlide].classList.remove('active');
    dots[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
    resetInterval();
  }

  function changeSlide(dir) {
    goToSlide(currentSlide + dir);
  }

  function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(() => changeSlide(1), 5000);
  }
  resetInterval();

  // ===== NAVBAR SCROLL =====
  const navbar = document.getElementById('navbar');
  const scrollTopBtn = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
      scrollTopBtn.classList.add('show');
    } else {
      navbar.classList.remove('scrolled');
      scrollTopBtn.classList.remove('show');
    }
  });

  // ===== SCROLL REVEAL =====
  const revealElements = document.querySelectorAll('.reveal');
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add('active');
        }, i * 80);
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  revealElements.forEach(el => revealObserver.observe(el));

  // ===== PRODUCT TABS =====
  document.querySelectorAll('.prod-tab').forEach(tab => {
    tab.addEventListener('click', function() {
      document.querySelectorAll('.prod-tab').forEach(t => t.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // ===== WISHLIST TOGGLE =====
  document.querySelectorAll('.prod-wishlist').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      const icon = this.querySelector('i');
      icon.classList.toggle('far');
      icon.classList.toggle('fas');
      if (icon.classList.contains('fas')) {
        this.style.color = '#C0392B';
        this.style.transform = 'scale(1.2)';
        setTimeout(() => this.style.transform = 'scale(1)', 200);
      } else {
        this.style.color = '';
      }
    });
  });

  // ===== ADD TO CART ANIMATION =====
  document.querySelectorAll('.btn-add').forEach(btn => {
    btn.addEventListener('click', function() {
      const original = this.innerHTML;
      this.innerHTML = '<i class="fas fa-check"></i> Added!';
      this.style.background = '#1a8a4a';
      setTimeout(() => {
        this.innerHTML = original;
        this.style.background = '';
      }, 1500);
    });
  });

  // ===== TOUCH SWIPE FOR SLIDER =====
  let touchStartX = 0;
  const slider = document.getElementById('heroSlider');
  slider.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
  slider.addEventListener('touchend', e => {
    const diff = touchStartX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) changeSlide(diff > 0 ? 1 : -1);
  });

  // Scroll to enquiry if success flash present
  @if (session('success'))
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('enquiry').scrollIntoView({behavior:'smooth'});
    });
  @endif
</script>

</body>
</html>
