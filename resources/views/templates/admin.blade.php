<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:#0d1117;color:#c9d1d9;display:flex;height:100vh;overflow:hidden}
.sidebar{width:180px;background:#161b22;border-right:1px solid #21262d;padding:16px;display:flex;flex-direction:column;gap:3px}
.sidebar-logo{font-size:14px;font-weight:700;color:#22c55e;margin-bottom:14px;display:flex;align-items:center;gap:6px}
.sidebar-logo span{width:18px;height:18px;background:#22c55e;border-radius:4px;display:flex;align-items:center;justify-content:center;color:#0d1117;font-size:10px;font-weight:700}
.sidebar-item{padding:6px 10px;border-radius:5px;font-size:10px;color:#8b949e;display:flex;align-items:center;gap:8px}
.sidebar-item.active{background:rgba(34,197,94,0.1);color:#22c55e}
.main{flex:1;padding:18px;overflow:hidden}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
.topbar h1{font-size:16px;font-weight:700}
.add-btn{background:#22c55e;color:#0d1117;padding:5px 14px;border-radius:6px;font-size:10px;font-weight:600}
.table{width:100%;border-collapse:collapse;background:rgba(255,255,255,0.02);border:1px solid #21262d;border-radius:8px;overflow:hidden}
.table th{text-align:left;padding:8px 12px;font-size:9px;color:#8b949e;background:#161b22;border-bottom:1px solid #21262d;font-weight:500;text-transform:uppercase;letter-spacing:0.5px}
.table td{padding:7px 12px;font-size:10px;border-bottom:1px solid #21262d}
.status{padding:2px 8px;border-radius:10px;font-size:8px;font-weight:500}
.status.active{background:rgba(34,197,94,0.12);color:#22c55e}
.status.pending{background:rgba(250,204,21,0.12);color:#facc15}
.status.inactive{background:rgba(239,68,68,0.12);color:#ef4444}
.user-cell{display:flex;align-items:center;gap:8px}
.user-avatar{width:22px;height:22px;border-radius:50%}
.ua1{background:linear-gradient(135deg,#818cf8,#6366f1)}
.ua2{background:linear-gradient(135deg,#f472b6,#ec4899)}
.ua3{background:linear-gradient(135deg,#38bdf8,#0ea5e9)}
.ua4{background:linear-gradient(135deg,#a78bfa,#7c3aed)}
.ua5{background:linear-gradient(135deg,#34d399,#10b981)}
.pagination{display:flex;align-items:center;gap:6px;margin-top:12px;justify-content:flex-end}
.page-btn{width:24px;height:24px;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:9px;background:rgba(255,255,255,0.04);color:#8b949e}
.page-btn.active{background:#22c55e;color:#0d1117}
</style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo"><span>A</span> AdminPro</div>
    <div class="sidebar-item">📊 Dashboard</div>
    <div class="sidebar-item active">👥 Users</div>
    <div class="sidebar-item">📦 Products</div>
    <div class="sidebar-item">📋 Orders</div>
    <div class="sidebar-item">💬 Messages</div>
    <div class="sidebar-item">⚙️ Settings</div>
</div>
<div class="main">
    <div class="topbar">
        <h1>User Management</h1>
        <div class="add-btn">+ Add User</div>
    </div>
    <table class="table">
        <thead><tr><th>User</th><th>Email</th><th>Role</th><th>Status</th></tr></thead>
        <tbody>
            <tr><td><div class="user-cell"><div class="user-avatar ua1"></div>Ahmad Rizky</div></td><td>ahmad@mail.com</td><td>Admin</td><td><span class="status active">Active</span></td></tr>
            <tr><td><div class="user-cell"><div class="user-avatar ua2"></div>Siti Nurhaliza</div></td><td>siti@mail.com</td><td>Editor</td><td><span class="status active">Active</span></td></tr>
            <tr><td><div class="user-cell"><div class="user-avatar ua3"></div>Budi Santoso</div></td><td>budi@mail.com</td><td>Viewer</td><td><span class="status pending">Pending</span></td></tr>
            <tr><td><div class="user-cell"><div class="user-avatar ua4"></div>Dewi Lestari</div></td><td>dewi@mail.com</td><td>Editor</td><td><span class="status inactive">Inactive</span></td></tr>
            <tr><td><div class="user-cell"><div class="user-avatar ua5"></div>Raka Pratama</div></td><td>raka@mail.com</td><td>Admin</td><td><span class="status active">Active</span></td></tr>
        </tbody>
    </table>
    <div class="pagination">
        <div class="page-btn active">1</div>
        <div class="page-btn">2</div>
        <div class="page-btn">3</div>
        <div class="page-btn">→</div>
    </div>
</div>
</body>
</html>
