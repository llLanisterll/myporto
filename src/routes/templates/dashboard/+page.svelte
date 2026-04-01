<svelte:head>
  <title>Analytics Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0f1117;color:#e2e8f0;display:flex;height:100vh;overflow:hidden}
.sidebar{width:180px;background:#161b22;border-right:1px solid rgba(255,255,255,0.06);padding:16px;display:flex;flex-direction:column;gap:4px}
.sidebar-logo{font-size:15px;font-weight:700;color:#818cf8;margin-bottom:16px}
.sidebar-item{padding:7px 10px;border-radius:6px;font-size:11px;color:#8b949e;cursor:pointer;display:flex;align-items:center;gap:8px}
.sidebar-item.active{background:rgba(129,140,248,0.1);color:#818cf8}
.sidebar-item .dot{width:6px;height:6px;border-radius:50%;background:currentColor;opacity:0.5}
.main{flex:1;padding:20px;overflow:hidden}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
.topbar h1{font-size:18px;font-weight:700}
.topbar-right{display:flex;gap:10px;align-items:center}
.avatar{width:26px;height:26px;border-radius:50%;background:linear-gradient(135deg,#818cf8,#6366f1)}
.search-box{height:28px;width:160px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:6px;padding:0 10px;font-size:10px;color:#64748b;display:flex;align-items:center}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:18px}
.stat{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:10px;padding:12px}
.stat-label{font-size:9px;color:#8b949e;margin-bottom:4px}
.stat-value{font-size:18px;font-weight:700}
.stat-change{font-size:9px;color:#22c55e;margin-top:2px}
.stat-change.down{color:#ef4444}
.chart-area{background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);border-radius:10px;padding:14px;height:200px}
.chart-title{font-size:11px;font-weight:600;margin-bottom:12px}
.bars{display:flex;align-items:flex-end;gap:6px;height:140px;padding-top:10px}
.bar{flex:1;border-radius:4px 4px 0 0;background:linear-gradient(to top,#818cf830,#818cf8);min-width:12px}
.bar-label{font-size:7px;color:#64748b;text-align:center;margin-top:4px}

  </style>
</svelte:head>

<div class="sidebar">
    <div class="sidebar-logo">📊 DashPro</div>
    <div class="sidebar-item active"><span class="dot"></span>Dashboard</div>
    <div class="sidebar-item"><span class="dot"></span>Analytics</div>
    <div class="sidebar-item"><span class="dot"></span>Users</div>
    <div class="sidebar-item"><span class="dot"></span>Products</div>
    <div class="sidebar-item"><span class="dot"></span>Revenue</div>
    <div class="sidebar-item"><span class="dot"></span>Settings</div>
</div>
<div class="main">
    <div class="topbar">
        <h1>Dashboard</h1>
        <div class="topbar-right">
            <div class="search-box">🔍 Search...</div>
            <div class="avatar"></div>
        </div>
    </div>
    <div class="stats">
        <div class="stat"><div class="stat-label">Total Users</div><div class="stat-value">12,847</div><div class="stat-change">+12.5%</div></div>
        <div class="stat"><div class="stat-label">Revenue</div><div class="stat-value">$48.2K</div><div class="stat-change">+8.3%</div></div>
        <div class="stat"><div class="stat-label">Orders</div><div class="stat-value">1,429</div><div class="stat-change down">-3.1%</div></div>
        <div class="stat"><div class="stat-label">Conversion</div><div class="stat-value">3.24%</div><div class="stat-change">+0.8%</div></div>
    </div>
    <div class="chart-area">
        <div class="chart-title">Revenue Overview</div>
        <div class="bars">
            <div><div class="bar" style="height:45%"></div><div class="bar-label">Jan</div></div>
            <div><div class="bar" style="height:60%"></div><div class="bar-label">Feb</div></div>
            <div><div class="bar" style="height:40%"></div><div class="bar-label">Mar</div></div>
            <div><div class="bar" style="height:75%"></div><div class="bar-label">Apr</div></div>
            <div><div class="bar" style="height:55%"></div><div class="bar-label">May</div></div>
            <div><div class="bar" style="height:85%"></div><div class="bar-label">Jun</div></div>
            <div><div class="bar" style="height:70%"></div><div class="bar-label">Jul</div></div>
            <div><div class="bar" style="height:92%"></div><div class="bar-label">Aug</div></div>
            <div><div class="bar" style="height:65%"></div><div class="bar-label">Sep</div></div>
            <div><div class="bar" style="height:80%"></div><div class="bar-label">Oct</div></div>
            <div><div class="bar" style="height:50%"></div><div class="bar-label">Nov</div></div>
            <div><div class="bar" style="height:95%"></div><div class="bar-label">Dec</div></div>
        </div>
    </div>
</div>
