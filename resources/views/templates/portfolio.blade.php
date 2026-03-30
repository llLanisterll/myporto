<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portfolio — Alex Rivera</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Space Grotesk',sans-serif;background:#050505;color:#fff;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:16px 28px}
.logo{font-size:16px;font-weight:700;letter-spacing:-0.5px}
.nav-links{display:flex;gap:20px;font-size:11px;color:rgba(255,255,255,0.4)}
.hero{padding:50px 28px 28px;display:flex;flex-direction:column;align-items:center;text-align:center}
.hero-label{font-size:10px;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:3px;margin-bottom:12px}
.hero h1{font-size:42px;font-weight:700;line-height:1.1;letter-spacing:-1.5px;margin-bottom:10px}
.hero h1 span{color:rgba(255,255,255,0.2)}
.hero p{font-size:12px;color:rgba(255,255,255,0.35);max-width:320px;line-height:1.6}
.scroll-indicator{margin-top:30px;font-size:9px;color:rgba(255,255,255,0.2);display:flex;flex-direction:column;align-items:center;gap:6px}
.scroll-line{width:1px;height:30px;background:linear-gradient(to bottom,rgba(255,255,255,0.2),transparent)}
.projects{display:flex;gap:14px;padding:20px 28px}
.project{flex:1;height:100px;border-radius:10px;position:relative;overflow:hidden;border:1px solid rgba(255,255,255,0.06)}
.project.p1{background:linear-gradient(135deg,#1a1a2e,#16213e)}
.project.p2{background:linear-gradient(135deg,#0f0f0f,#1a1a1a)}
.project.p3{background:linear-gradient(135deg,#1a0a2e,#16132e)}
.project-label{position:absolute;bottom:8px;left:10px;font-size:9px;color:rgba(255,255,255,0.5)}
</style>
</head>
<body>
<nav>
    <span class="logo">Alex Rivera</span>
    <div class="nav-links">Work About Contact</div>
</nav>
<div class="hero">
    <div class="hero-label">Creative Developer</div>
    <h1>I build digital<br>experiences<span>.</span></h1>
    <p>A creative developer based in Jakarta, crafting meaningful digital products and immersive web experiences.</p>
    <div class="scroll-indicator">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</div>
<div class="projects">
    <div class="project p1"><div class="project-label">Nike Campaign</div></div>
    <div class="project p2"><div class="project-label">Spotify Wrapped</div></div>
    <div class="project p3"><div class="project-label">Meta Rebrand</div></div>
</div>
</body>
</html>
