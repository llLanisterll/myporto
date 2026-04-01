<svelte:head>
  <title>The Journal</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#fafafa;color:#1a1a1a;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:14px 28px;border-bottom:1px solid #e5e7eb}
.logo{font-family:'Playfair Display',serif;font-size:20px;font-weight:700}
.nav-links{display:flex;gap:18px;font-size:11px;color:#6b7280}
.nav-links a{color:#6b7280;text-decoration:none}
.subscribe-btn{background:#111;color:#fff;padding:5px 14px;border-radius:20px;font-size:10px;font-weight:500}
.hero-article{margin:16px 28px;display:flex;gap:16px;height:160px}
.hero-img{width:280px;border-radius:12px;background:linear-gradient(135deg,#c084fc,#818cf8,#6366f1);flex-shrink:0}
.hero-text{display:flex;flex-direction:column;justify-content:center}
.hero-tag{font-size:9px;font-weight:600;color:#7c3aed;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px}
.hero-text h1{font-family:'Playfair Display',serif;font-size:20px;line-height:1.3;margin-bottom:6px}
.hero-text p{font-size:10px;color:#6b7280;line-height:1.5}
.hero-meta{font-size:9px;color:#9ca3af;margin-top:8px}
.section-title{padding:0 28px;font-size:12px;font-weight:600;margin:16px 0 10px;color:#111}
.articles{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;padding:0 28px}
.article{background:#fff;border-radius:10px;overflow:hidden;border:1px solid #f0f0f0}
.article-img{height:65px}
.article-img.a1{background:linear-gradient(135deg,#fbbf24,#f59e0b)}
.article-img.a2{background:linear-gradient(135deg,#34d399,#10b981)}
.article-img.a3{background:linear-gradient(135deg,#f472b6,#ec4899)}
.article-body{padding:8px}
.article-body h3{font-size:10px;font-weight:600;margin-bottom:3px;line-height:1.3}
.article-body p{font-size:8px;color:#9ca3af}

  </style>
</svelte:head>

<nav>
    <span class="logo">The Journal</span>
    <div class="nav-links"><a>Home</a><a>Technology</a><a>Design</a><a>Business</a></div>
    <div class="subscribe-btn">Subscribe</div>
</nav>
<div class="hero-article">
    <div class="hero-img"></div>
    <div class="hero-text">
        <div class="hero-tag">Featured</div>
        <h1>The Future of AI in Web Development</h1>
        <p>Exploring how artificial intelligence is reshaping the way we build and deploy modern web applications.</p>
        <div class="hero-meta">By Sarah Chen · 5 min read · Dec 2025</div>
    </div>
</div>
<div class="section-title">Trending Articles</div>
<div class="articles">
    <div class="article"><div class="article-img a1"></div><div class="article-body"><h3>Design Systems at Scale</h3><p>Mar 12 · 4 min read</p></div></div>
    <div class="article"><div class="article-img a2"></div><div class="article-body"><h3>Green Tech Revolution</h3><p>Mar 10 · 6 min read</p></div></div>
    <div class="article"><div class="article-img a3"></div><div class="article-body"><h3>A New Era of UX Design</h3><p>Mar 8 · 3 min read</p></div></div>
</div>
