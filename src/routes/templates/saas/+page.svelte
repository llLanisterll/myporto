<svelte:head>
  <title>CloudSync SaaS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0f172a;color:#e2e8f0;overflow:hidden}
nav{display:flex;align-items:center;justify-content:space-between;padding:14px 28px}
.logo{font-size:16px;font-weight:700;color:#38bdf8;display:flex;align-items:center;gap:6px}
.logo span{width:20px;height:20px;background:linear-gradient(135deg,#38bdf8,#818cf8);border-radius:5px}
.nav-links{display:flex;gap:18px;font-size:11px;color:#94a3b8}
.cta-nav{background:#38bdf8;color:#0f172a;padding:6px 16px;border-radius:6px;font-size:10px;font-weight:600}
.hero{text-align:center;padding:30px 40px 20px}
.badge{display:inline-block;background:rgba(56,189,248,0.1);border:1px solid rgba(56,189,248,0.2);border-radius:20px;padding:3px 12px;font-size:9px;color:#38bdf8;margin-bottom:12px}
.hero h1{font-size:28px;font-weight:800;line-height:1.2;margin-bottom:10px;background:linear-gradient(135deg,#fff,#94a3b8);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.hero p{font-size:12px;color:#64748b;max-width:380px;margin:0 auto 16px;line-height:1.6}
.hero-btns{display:flex;gap:10px;justify-content:center}
.btn-primary{background:linear-gradient(135deg,#38bdf8,#818cf8);color:#fff;padding:8px 22px;border-radius:8px;font-size:11px;font-weight:600}
.btn-secondary{background:rgba(255,255,255,0.05);color:#e2e8f0;padding:8px 22px;border-radius:8px;font-size:11px;font-weight:500;border:1px solid rgba(255,255,255,0.1)}
.features{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;padding:24px 28px}
.feature{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:10px;padding:14px;text-align:center}
.feature-icon{width:32px;height:32px;border-radius:8px;margin:0 auto 8px;display:flex;align-items:center;justify-content:center;font-size:16px}
.feature-icon.f1{background:rgba(56,189,248,0.15)}
.feature-icon.f2{background:rgba(129,140,248,0.15)}
.feature-icon.f3{background:rgba(34,211,153,0.15)}
.feature h3{font-size:11px;font-weight:600;margin-bottom:3px}
.feature p{font-size:8px;color:#64748b}

  </style>
</svelte:head>

<nav>
    <div class="logo"><span></span>CloudSync</div>
    <div class="nav-links">Features Product Pricing Docs</div>
    <div class="cta-nav">Get Started</div>
</nav>
<div class="hero">
    <div class="badge">✨ Now with AI-powered insights</div>
    <h1>Scale your workflow with confidence</h1>
    <p>The all-in-one platform for modern teams. Automate, collaborate, and deliver faster than ever.</p>
    <div class="hero-btns">
        <div class="btn-primary">Start Free Trial</div>
        <div class="btn-secondary">Watch Demo →</div>
    </div>
</div>
<div class="features">
    <div class="feature"><div class="feature-icon f1">⚡</div><h3>Lightning Fast</h3><p>Built on edge computing for instant response times globally.</p></div>
    <div class="feature"><div class="feature-icon f2">🔒</div><h3>Enterprise Security</h3><p>SOC2 compliant with end-to-end encryption built in.</p></div>
    <div class="feature"><div class="feature-icon f3">📊</div><h3>Smart Analytics</h3><p>AI-powered insights to help you make better decisions.</p></div>
</div>
