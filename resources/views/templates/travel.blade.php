<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TravelGo</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#041a1a;color:#e2f0f0;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:14px 28px}
.logo{font-size:16px;font-weight:700;color:#2dd4bf}
.nav-links{display:flex;gap:16px;font-size:11px;color:rgba(255,255,255,0.4)}
.hero{margin:0 28px;height:160px;background:linear-gradient(135deg,rgba(45,212,191,0.15),rgba(4,26,26,0.9));border-radius:14px;position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:flex-end;padding:18px}
.hero h1{font-size:22px;font-weight:800;color:#fff;margin-bottom:4px}
.hero p{font-size:10px;color:rgba(255,255,255,0.5);margin-bottom:10px}
.search-bar{display:flex;gap:6px;align-items:center}
.search-field{flex:1;height:30px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0 10px;font-size:10px;color:#fff;display:flex;align-items:center}
.search-btn{background:#2dd4bf;color:#041a1a;padding:6px 16px;border-radius:8px;font-size:10px;font-weight:600}
.section-title{padding:0 28px;font-size:12px;font-weight:600;margin:16px 0 10px;color:#2dd4bf}
.destinations{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;padding:0 28px}
.dest{border-radius:10px;overflow:hidden;background:rgba(255,255,255,0.03);border:1px solid rgba(45,212,191,0.08)}
.dest-img{height:80px}
.dest-img.d1{background:linear-gradient(135deg,#0d9488,#115e59)}
.dest-img.d2{background:linear-gradient(135deg,#0891b2,#164e63)}
.dest-img.d3{background:linear-gradient(135deg,#059669,#064e3b)}
.dest-info{padding:8px}
.dest-info h3{font-size:10px;font-weight:600;margin-bottom:2px}
.dest-info p{font-size:8px;color:rgba(255,255,255,0.35)}
.dest-price{display:flex;justify-content:space-between;align-items:center;margin-top:4px}
.dest-price span{font-size:10px;font-weight:700;color:#2dd4bf}
.dest-rating{font-size:8px;color:#fbbf24}
</style>
</head>
<body>
<nav>
    <span class="logo">✈️ TravelGo</span>
    <div class="nav-links">Destinations Hotels Flights</div>
</nav>
<div class="hero">
    <h1>Jelajahi Dunia</h1>
    <p>Temukan destinasi impian dengan harga terbaik</p>
    <div class="search-bar">
        <div class="search-field">📍 Kemana kamu mau pergi?</div>
        <div class="search-btn">Cari</div>
    </div>
</div>
<div class="section-title">Destinasi Populer</div>
<div class="destinations">
    <div class="dest"><div class="dest-img d1"></div><div class="dest-info"><h3>Bali, Indonesia</h3><p>4 Days / 3 Nights</p><div class="dest-price"><span>Rp 2.5 Jt</span><span class="dest-rating">⭐ 4.8</span></div></div></div>
    <div class="dest"><div class="dest-img d2"></div><div class="dest-info"><h3>Raja Ampat</h3><p>5 Days / 4 Nights</p><div class="dest-price"><span>Rp 4.2 Jt</span><span class="dest-rating">⭐ 4.9</span></div></div></div>
    <div class="dest"><div class="dest-img d3"></div><div class="dest-info"><h3>Labuan Bajo</h3><p>3 Days / 2 Nights</p><div class="dest-price"><span>Rp 3.8 Jt</span><span class="dest-rating">⭐ 4.7</span></div></div></div>
</div>
</body>
</html>
