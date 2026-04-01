<svelte:head>
  <title>MusicFlow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#111;color:#e2e8f0;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:12px 24px;border-bottom:1px solid rgba(255,255,255,0.06)}
.logo{font-size:16px;font-weight:700;color:#1db954}
.search{height:28px;width:180px;background:rgba(255,255,255,0.06);border-radius:14px;display:flex;align-items:center;padding:0 12px;font-size:10px;color:#666}
.hero{margin:14px 24px;height:130px;background:linear-gradient(135deg,#1a3320,#111);border-radius:12px;display:flex;align-items:center;padding:0 20px;gap:14px}
.hero-cover{width:90px;height:90px;border-radius:8px;background:linear-gradient(135deg,#1db954,#15803d);flex-shrink:0}
.hero h2{font-size:14px;font-weight:700;margin-bottom:2px}
.hero p{font-size:10px;color:#888;margin-bottom:8px}
.play-btn{background:#1db954;color:#111;padding:6px 18px;border-radius:20px;font-size:10px;font-weight:600;display:inline-block}
.section-title{padding:0 24px;font-size:12px;font-weight:600;margin:14px 0 8px}
.tracks{padding:0 24px}
.track{display:flex;align-items:center;gap:10px;padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.04)}
.track-num{font-size:10px;color:#666;width:16px}
.track-cover{width:34px;height:34px;border-radius:4px;flex-shrink:0}
.tc1{background:linear-gradient(135deg,#7c3aed,#4c1d95)}
.tc2{background:linear-gradient(135deg,#ec4899,#be185d)}
.tc3{background:linear-gradient(135deg,#f59e0b,#d97706)}
.tc4{background:linear-gradient(135deg,#38bdf8,#0284c7)}
.track-info{flex:1}
.track-name{font-size:11px;font-weight:500}
.track-artist{font-size:9px;color:#888}
.track-dur{font-size:9px;color:#666}
.player{position:fixed;bottom:0;left:0;right:0;height:52px;background:#181818;border-top:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;padding:0 20px;gap:10px}
.player-cover{width:36px;height:36px;border-radius:4px;background:linear-gradient(135deg,#1db954,#15803d)}
.player-info{flex:1}
.player-name{font-size:10px;font-weight:500}
.player-artist{font-size:8px;color:#888}
.player-controls{display:flex;gap:12px;align-items:center;font-size:14px;color:#fff}
.player-bar{flex:2;height:3px;background:rgba(255,255,255,0.1);border-radius:2px;overflow:hidden}
.player-progress{height:100%;width:35%;background:#1db954;border-radius:2px}

  </style>
</svelte:head>

<nav>
    <span class="logo">🎵 MusicFlow</span>
    <div class="search">🔍 Search songs...</div>
</nav>
<div class="hero">
    <div class="hero-cover"></div>
    <div><h2>Daily Mix</h2><p>Curated for you · 25 songs</p><div class="play-btn">▶ Play All</div></div>
</div>
<div class="section-title">Popular Tracks</div>
<div class="tracks">
    <div class="track"><div class="track-num">1</div><div class="track-cover tc1"></div><div class="track-info"><div class="track-name">Midnight Dreams</div><div class="track-artist">Luna Park</div></div><div class="track-dur">3:42</div></div>
    <div class="track"><div class="track-num">2</div><div class="track-cover tc2"></div><div class="track-info"><div class="track-name">Neon Lights</div><div class="track-artist">The Weeknd</div></div><div class="track-dur">4:15</div></div>
    <div class="track"><div class="track-num">3</div><div class="track-cover tc3"></div><div class="track-info"><div class="track-name">Golden Hour</div><div class="track-artist">JVKE</div></div><div class="track-dur">3:28</div></div>
    <div class="track"><div class="track-num">4</div><div class="track-cover tc4"></div><div class="track-info"><div class="track-name">Ocean Eyes</div><div class="track-artist">Billie Eilish</div></div><div class="track-dur">3:56</div></div>
</div>
<div class="player">
    <div class="player-cover"></div>
    <div class="player-info"><div class="player-name">Midnight Dreams</div><div class="player-artist">Luna Park</div></div>
    <div class="player-controls">⏮ ▶ ⏭</div>
    <div class="player-bar"><div class="player-progress"></div></div>
</div>
