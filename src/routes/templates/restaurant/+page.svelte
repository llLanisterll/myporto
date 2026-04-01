<svelte:head>
  <title>Warung Nusantara</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0c0704;color:#fef3c7;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:14px 28px;border-bottom:1px solid rgba(245,158,11,0.1)}
.logo{font-family:'Playfair Display',serif;font-size:18px;color:#f59e0b}
.nav-links{display:flex;gap:18px;font-size:11px;color:rgba(254,243,199,0.4)}
.reserve-btn{background:#f59e0b;color:#0c0704;padding:5px 14px;border-radius:6px;font-size:10px;font-weight:600}
.hero{height:170px;background:linear-gradient(135deg,rgba(245,158,11,0.15),rgba(120,53,15,0.1));margin:14px 28px;border-radius:14px;display:flex;align-items:center;padding:0 28px}
.hero-text h1{font-family:'Playfair Display',serif;font-size:24px;line-height:1.2;margin-bottom:6px;color:#fff}
.hero-text h1 span{color:#f59e0b}
.hero-text p{font-size:10px;color:rgba(254,243,199,0.5);line-height:1.5;margin-bottom:10px}
.hero-btn{background:#f59e0b;color:#0c0704;padding:6px 16px;border-radius:6px;font-size:10px;font-weight:600;display:inline-block}
.section-title{padding:0 28px;font-size:12px;font-weight:600;margin:16px 0 10px;color:#f59e0b}
.menu{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;padding:0 28px}
.menu-item{background:rgba(245,158,11,0.05);border:1px solid rgba(245,158,11,0.1);border-radius:10px;padding:10px;display:flex;gap:10px}
.menu-img{width:50px;height:50px;border-radius:8px;flex-shrink:0}
.menu-img.m1{background:linear-gradient(135deg,#f59e0b30,#92400e30)}
.menu-img.m2{background:linear-gradient(135deg,#ef444430,#991b1b30)}
.menu-img.m3{background:linear-gradient(135deg,#22c55e30,#14532d30)}
.menu-img.m4{background:linear-gradient(135deg,#f97316,#ea580c30)}
.menu-info h3{font-size:11px;font-weight:600;color:#fef3c7;margin-bottom:2px}
.menu-info p{font-size:8px;color:rgba(254,243,199,0.4);margin-bottom:4px}
.menu-price{font-size:11px;font-weight:700;color:#f59e0b}

  </style>
</svelte:head>

<nav>
    <span class="logo">🍜 Nusantara</span>
    <div class="nav-links">Menu About Gallery</div>
    <div class="reserve-btn">Reservasi</div>
</nav>
<div class="hero">
    <div class="hero-text">
        <h1>Rasakan <span>Cita Rasa</span><br>Nusantara</h1>
        <p>Autentik kuliner Indonesia dengan sentuhan modern di setiap hidangan.</p>
        <div class="hero-btn">Lihat Menu</div>
    </div>
</div>
<div class="section-title">Menu Favorit</div>
<div class="menu">
    <div class="menu-item"><div class="menu-img m1"></div><div class="menu-info"><h3>Nasi Goreng Special</h3><p>Nasi goreng dengan telur & ayam</p><div class="menu-price">Rp 35.000</div></div></div>
    <div class="menu-item"><div class="menu-img m2"></div><div class="menu-info"><h3>Rendang Sapi</h3><p>Rendang daging sapi Padang</p><div class="menu-price">Rp 55.000</div></div></div>
    <div class="menu-item"><div class="menu-img m3"></div><div class="menu-info"><h3>Sate Ayam</h3><p>10 tusuk sate & lontong</p><div class="menu-price">Rp 28.000</div></div></div>
    <div class="menu-item"><div class="menu-img m4"></div><div class="menu-info"><h3>Mie Goreng Aceh</h3><p>Mie goreng khas Aceh pedas</p><div class="menu-price">Rp 32.000</div></div></div>
</div>
