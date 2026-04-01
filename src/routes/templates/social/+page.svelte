<svelte:head>
  <title>SocialConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0f0520;color:#e2e8f0;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:12px 24px;background:rgba(15,5,32,0.95);border-bottom:1px solid rgba(167,139,250,0.1)}
.logo{font-size:16px;font-weight:700;color:#a78bfa}
.nav-right{display:flex;gap:10px;align-items:center}
.notif{width:26px;height:26px;border-radius:50%;background:rgba(167,139,250,0.1);display:flex;align-items:center;justify-content:center;font-size:11px}
.avatar{width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,#a78bfa,#7c3aed)}
.stories{display:flex;gap:10px;padding:14px 24px;overflow:hidden}
.story{text-align:center}
.story-ring{width:48px;height:48px;border-radius:50%;padding:2px;background:linear-gradient(135deg,#a78bfa,#ec4899);margin-bottom:4px}
.story-img{width:100%;height:100%;border-radius:50%;background:#1a0a30;border:2px solid #0f0520}
.story-img.s1{background:linear-gradient(135deg,#c084fc,#7c3aed)}
.story-img.s2{background:linear-gradient(135deg,#f472b6,#be185d)}
.story-img.s3{background:linear-gradient(135deg,#38bdf8,#0284c7)}
.story-img.s4{background:linear-gradient(135deg,#34d399,#059669)}
.story-name{font-size:8px;color:rgba(255,255,255,0.4)}
.feed{padding:0 24px}
.post{background:rgba(255,255,255,0.03);border:1px solid rgba(167,139,250,0.08);border-radius:12px;padding:14px;margin-bottom:10px}
.post-header{display:flex;align-items:center;gap:8px;margin-bottom:10px}
.post-avatar{width:30px;height:30px;border-radius:50%;flex-shrink:0}
.pa1{background:linear-gradient(135deg,#a78bfa,#6d28d9)}
.pa2{background:linear-gradient(135deg,#f472b6,#db2777)}
.post-name{font-size:11px;font-weight:600}
.post-time{font-size:8px;color:rgba(255,255,255,0.3)}
.post-content{font-size:10px;line-height:1.5;color:#cbd5e1;margin-bottom:10px}
.post-image{height:100px;background:linear-gradient(135deg,rgba(167,139,250,0.1),rgba(236,72,153,0.1));border-radius:8px;margin-bottom:10px}
.post-actions{display:flex;gap:16px;font-size:10px;color:rgba(255,255,255,0.4)}
.post-actions span{cursor:pointer}

  </style>
</svelte:head>

<nav>
    <span class="logo">Social</span>
    <div class="nav-right">
        <div class="notif">🔔</div>
        <div class="avatar"></div>
    </div>
</nav>
<div class="stories">
    <div class="story"><div class="story-ring"><div class="story-img s1"></div></div><div class="story-name">Rina</div></div>
    <div class="story"><div class="story-ring"><div class="story-img s2"></div></div><div class="story-name">Dimas</div></div>
    <div class="story"><div class="story-ring"><div class="story-img s3"></div></div><div class="story-name">Fajar</div></div>
    <div class="story"><div class="story-ring"><div class="story-img s4"></div></div><div class="story-name">Maya</div></div>
</div>
<div class="feed">
    <div class="post">
        <div class="post-header"><div class="post-avatar pa1"></div><div><div class="post-name">Rina Amelia</div><div class="post-time">2 jam lalu</div></div></div>
        <div class="post-content">Sunset di Bali memang selalu bikin kangen! 🌅 Siapa yang mau ikut trip berikutnya?</div>
        <div class="post-image"></div>
        <div class="post-actions"><span>❤️ 128</span><span>💬 24</span><span>🔗 Share</span></div>
    </div>
    <div class="post">
        <div class="post-header"><div class="post-avatar pa2"></div><div><div class="post-name">Dimas Prasetyo</div><div class="post-time">5 jam lalu</div></div></div>
        <div class="post-content">Baru aja selesai project client ke-50! 🎉 Terima kasih semuanya yang sudah support.</div>
        <div class="post-actions"><span>❤️ 256</span><span>💬 43</span><span>🔗 Share</span></div>
    </div>
</div>
