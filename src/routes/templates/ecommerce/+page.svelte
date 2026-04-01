<svelte:head>
  <title>ShopNest</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0a0f1c;color:#e2e8f0;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:12px 24px;background:rgba(15,23,42,0.95);border-bottom:1px solid rgba(255,255,255,0.06)}
.logo{font-size:18px;font-weight:700;color:#38bdf8}
.nav-links{display:flex;gap:16px;font-size:11px;color:#94a3b8}
.nav-links a{color:#94a3b8;text-decoration:none}
.cart-icon{width:18px;height:18px;border-radius:50%;border:1.5px solid #38bdf8;display:flex;align-items:center;justify-content:center;font-size:9px;color:#38bdf8}
.search{margin:12px 24px;height:32px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:16px;display:flex;align-items:center;padding:0 14px;color:#64748b;font-size:11px}
.hero{margin:0 24px 16px;height:120px;background:linear-gradient(135deg,#1e3a5f,#0f172a);border-radius:12px;display:flex;align-items:center;padding:0 24px}
.hero h2{font-size:16px;font-weight:700;color:#fff;margin-bottom:4px}
.hero p{font-size:10px;color:#94a3b8}
.hero-btn{margin-top:8px;background:#38bdf8;color:#0f172a;padding:5px 14px;border-radius:6px;font-size:10px;font-weight:600;display:inline-block}
.section-title{padding:0 24px;font-size:12px;font-weight:600;color:#f1f5f9;margin-bottom:10px}
.products{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:0 24px}
.product{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:10px;overflow:hidden}
.product-img{height:70px;background:linear-gradient(135deg,#1e293b,#334155)}
.product-img.p1{background:linear-gradient(135deg,#7c3aed20,#1e1b4b)}
.product-img.p2{background:linear-gradient(135deg,#05966920,#064e3b)}
.product-img.p3{background:linear-gradient(135deg,#dc262620,#450a0a)}
.product-info{padding:8px}
.product-name{font-size:9px;color:#cbd5e1;margin-bottom:3px}
.product-price{font-size:11px;font-weight:700;color:#38bdf8}

  </style>
</svelte:head>

<nav>
    <span class="logo">ShopNest</span>
    <div class="nav-links"><a>Katalog</a><a>Promo</a><a>Tentang</a></div>
    <div class="cart-icon">2</div>
</nav>
<div class="search">🔍 Cari produk...</div>
<div class="hero">
    <div>
        <h2>Flash Sale 🔥</h2>
        <p>Diskon hingga 70% untuk semua koleksi</p>
        <div class="hero-btn">Belanja Sekarang</div>
    </div>
</div>
<div class="section-title">Produk Populer</div>
<div class="products">
    <div class="product"><div class="product-img p1"></div><div class="product-info"><div class="product-name">Wireless Headphone</div><div class="product-price">Rp 299.000</div></div></div>
    <div class="product"><div class="product-img p2"></div><div class="product-info"><div class="product-name">Smart Watch Pro</div><div class="product-price">Rp 1.299.000</div></div></div>
    <div class="product"><div class="product-img p3"></div><div class="product-info"><div class="product-name">Gaming Mouse</div><div class="product-price">Rp 459.000</div></div></div>
</div>
