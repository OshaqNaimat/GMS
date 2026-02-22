<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IronCore — Admin Dashboard</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0a0c; --surface: #111114; --surface2: #18181d;
    --border: #222228; --accent: #e8ff47; --accent2: #ff4757;
    --text: #f0f0f0; --muted: #666672; --sidebar-w: 240px;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { background: var(--bg); color: var(--text); font-family: 'DM Sans', sans-serif; min-height: 100vh; overflow-x: hidden; }

  /* ── Fee Alert (inline in Members page) ────────────── */
  @keyframes feePulseText { 0%,100%{opacity:1;} 50%{opacity:.4;} }
  @keyframes feePulseDot  { 0%,100%{transform:scale(1);opacity:1;} 50%{transform:scale(1.8);opacity:.3;} }
  @keyframes feeRowGlow   { 0%,100%{box-shadow:inset 3px 0 0 #ff2d44, inset 0 0 0 rgba(255,45,68,0);} 50%{box-shadow:inset 3px 0 0 #ff2d44, inset 0 0 24px rgba(255,45,68,.13);} }
  @keyframes feeInlineIn  { from{opacity:0;transform:translateY(-8px);} to{opacity:1;transform:translateY(0);} }

  /* Inline fee alert panel */
  .fee-inline-panel {
    border-radius: 12px; overflow: hidden; margin-bottom: 20px;
    border: 1px solid rgba(255,45,68,.35);
    background: rgba(255,45,68,.07);
    animation: feeInlineIn .4s ease both;
  }
  .fee-inline-header {
    display:flex; align-items:center; gap:12px;
    padding:14px 20px;
    background: rgba(255,45,68,.1);
    border-bottom: 1px solid rgba(255,45,68,.2);
  }
  .fee-inline-dot {
    width:10px; height:10px; border-radius:50%; background:#ff2d44; flex-shrink:0;
    animation: feePulseDot 1.2s ease-in-out infinite;
  }
  .fee-inline-title { flex:1; font-weight:700; font-size:.92rem; color:#fff; }
  .fee-inline-title span { color:#ff6b6b; }
  .fee-inline-badge {
    background:#ff2d44; color:#fff; font-size:.72rem; font-weight:700;
    padding:3px 12px; border-radius:20px;
    animation: feePulseText 1.2s ease-in-out infinite;
  }
  .fee-inline-chips { display:flex; gap:8px; flex-wrap:wrap; padding:12px 20px; }
  .fee-inline-chip {
    display:flex; align-items:center; gap:7px;
    background:rgba(255,45,68,.15); border:1px solid rgba(255,45,68,.25);
    border-radius:20px; padding:4px 12px; font-size:.75rem; font-weight:600; color:#fca5a5;
  }
  .fee-inline-chip-av {
    width:20px; height:20px; border-radius:50%; display:grid; place-items:center;
    font-size:.62rem; font-weight:700; color:#000; flex-shrink:0;
  }

  /* Row blinking for due members */
  .fee-due-row { animation: feeRowGlow 1.4s ease-in-out infinite; }
  .fee-due-tag {
    display:inline-flex; align-items:center; gap:5px;
    margin-left:8px; font-size:.68rem; background:#ff2d44; color:#fff;
    padding:2px 8px; border-radius:20px; font-weight:700;
    animation: feePulseText 1.2s ease-in-out infinite;
  }
  .fee-due-tag i { font-size:.6rem; }

  /* ── Sidebar ──────────────────────────────────────── */
  .sidebar { position:fixed;left:0;top:0;bottom:0;width:var(--sidebar-w);background:var(--surface);border-right:1px solid var(--border);display:flex;flex-direction:column;z-index:100;transition:transform .3s; }
  body.light-mode .nav-item.active {
  background: var(--accent);
  color: #ffffff;
}
  .sidebar-logo { padding:28px 24px 20px;border-bottom:1px solid var(--border); }
  .sidebar-logo h1 { font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:2px;color:var(--accent);line-height:1; }
  .sidebar-logo span { color:var(--muted);font-size:.7rem;letter-spacing:3px;text-transform:uppercase;display:block;margin-top:2px; }
  .nav-section { padding:20px 16px 8px;color:var(--muted);font-size:.65rem;letter-spacing:2px;text-transform:uppercase; }
  .nav-item { display:flex;align-items:center;gap:12px;padding:11px 16px;margin:2px 8px;border-radius:8px;color:var(--muted);cursor:pointer;font-size:.875rem;font-weight:500;transition:all .2s;text-decoration:none;border:1px solid transparent; }
  .nav-item:hover { background:var(--surface2);color:var(--text); }
  .nav-item.active { background:var(--accent);color:#0a0a0c;border-color:var(--accent); }
  .nav-item.active i { color:#0a0a0c; }
  .nav-item i { width:18px;text-align:center; }
  .sidebar-bottom { margin-top:auto;padding:16px;border-top:1px solid var(--border); }
  .admin-chip { display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--surface2);border-radius:10px;cursor:pointer; }
  .admin-avatar { width:34px;height:34px;border-radius:50%;background:var(--accent);display:grid;place-items:center;font-weight:700;font-size:.8rem;color:#000;flex-shrink:0; }
  .admin-chip .name { font-size:.82rem;font-weight:600; }
  .admin-chip .role { font-size:.7rem;color:var(--muted); }

  /* ── Main ─────────────────────────────────────────── */
  .main { margin-left:var(--sidebar-w);min-height:100vh; }
  .topbar { display:flex;align-items:center;gap:16px;padding:20px 32px;border-bottom:1px solid var(--border);background:var(--bg);position:sticky;top:0;z-index:50; }
  .topbar-title { font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;flex:1; }
  .topbar-search { position:relative; }
  .topbar-search input { background:var(--surface2);border:1px solid var(--border);color:var(--text);padding:8px 16px 8px 38px;border-radius:8px;font-size:.85rem;width:220px;outline:none;transition:border-color .2s;font-family:'DM Sans',sans-serif; }
  .topbar-search input:focus { border-color:var(--accent); }
  .topbar-search i { position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.85rem; }
  .topbar-actions { display:flex;gap:8px;align-items:center; }
  .icon-btn { width:38px;height:38px;background:var(--surface2);border:1px solid var(--border);border-radius:8px;display:grid;place-items:center;cursor:pointer;color:var(--muted);font-size:.9rem;transition:all .2s;position:relative; }
  .icon-btn:hover { color:var(--text);border-color:var(--muted); }
  .badge-dot { width:7px;height:7px;background:var(--accent2);border-radius:50%;position:absolute;top:7px;right:7px;border:1.5px solid var(--bg); }
  .content { padding:28px 32px; }

  /* ── Stat Cards ───────────────────────────────────── */
  .stat-card { background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:22px 24px;position:relative;overflow:hidden;transition:transform .2s,border-color .2s;cursor:default; }
  .stat-card:hover { transform:translateY(-2px);border-color:var(--accent); }
  .stat-card::before { content:'';position:absolute;top:-30px;right:-20px;width:90px;height:90px;border-radius:50%;opacity:.05; }
  .stat-card.c1::before{background:var(--accent);} .stat-card.c2::before{background:#4fc3f7;} .stat-card.c3::before{background:#ff4757;} .stat-card.c4::before{background:#a78bfa;}
  .stat-label { font-size:.72rem;text-transform:uppercase;letter-spacing:2px;color:var(--muted);margin-bottom:10px; }
  .stat-value { font-family:'Bebas Neue',sans-serif;font-size:2.6rem;letter-spacing:1px;line-height:1; }
  .stat-sub { font-size:.78rem;color:var(--muted);margin-top:6px; }
  .stat-sub .up{color:#4ade80;} .stat-sub .dn{color:var(--accent2);}
  .stat-icon { position:absolute;top:20px;right:20px;width:40px;height:40px;border-radius:10px;display:grid;place-items:center;font-size:1.1rem; }
  .stat-card.c1 .stat-icon{background:rgba(232,255,71,.12);color:var(--accent);}
  .stat-card.c2 .stat-icon{background:rgba(79,195,247,.12);color:#4fc3f7;}
  .stat-card.c3 .stat-icon{background:rgba(255,71,87,.12);color:var(--accent2);}
  .stat-card.c4 .stat-icon{background:rgba(167,139,250,.12);color:#a78bfa;}

  /* ── Misc ─────────────────────────────────────────── */
  .section-head { display:flex;align-items:center;justify-content:space-between;margin-bottom:18px; }
  .section-head h2 { font-family:'Bebas Neue',sans-serif;font-size:1.25rem;letter-spacing:1px; }
  .btn-outline-accent { background:transparent;border:1px solid var(--border);color:var(--muted);padding:6px 14px;border-radius:7px;font-size:.78rem;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .2s; }
  .btn-outline-accent:hover { border-color:var(--accent);color:var(--accent); }
  .btn-accent { background:var(--accent);border:none;color:#000;padding:8px 18px;border-radius:8px;font-size:.82rem;font-family:'DM Sans',sans-serif;font-weight:600;cursor:pointer;transition:opacity .2s; }
  .btn-accent:hover { opacity:.85; }
  .table-card { background:var(--surface);border:1px solid var(--border);border-radius:14px;overflow:hidden; }
  .table-card table { width:100%;border-collapse:collapse; }
  .table-card thead th { padding:14px 20px;font-size:.7rem;text-transform:uppercase;letter-spacing:1.5px;color:var(--muted);font-weight:600;border-bottom:1px solid var(--border);background:var(--surface2); }
  .table-card tbody td { padding:14px 20px;font-size:.84rem;border-bottom:1px solid var(--border);color:var(--text);vertical-align:middle; }
  .table-card tbody tr:last-child td { border-bottom:none; }
  .table-card tbody tr { transition:background .15s;cursor:pointer; }
  .table-card tbody tr:hover { background:var(--surface2); }
  .badge-status { padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600; }
  .badge-active{background:rgba(74,222,128,.12);color:#4ade80;}
  .badge-expired{background:rgba(255,71,87,.12);color:var(--accent2);}
  .badge-trial{background:rgba(232,255,71,.12);color:var(--accent);}
  .badge-pending{background:rgba(251,191,36,.12);color:#fbbf24;}
  .mem-avatar { width:32px;height:32px;border-radius:50%;display:inline-grid;place-items:center;font-size:.72rem;font-weight:700;color:#000;margin-right:10px;flex-shrink:0; }
  .chart-card { background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:22px 24px; }
  .chart-bars { display:flex;align-items:flex-end;gap:6px;height:120px;padding-top:12px; }
  .bar-wrap { flex:1;display:flex;flex-direction:column;align-items:center;gap:6px; }
  .bar { width:100%;border-radius:4px 4px 0 0;background:var(--surface2);transition:background .2s;position:relative;min-height:6px; }
  .bar-label { font-size:.65rem;color:var(--muted); }
  .prog-row { margin-bottom:14px; }
  .prog-label { display:flex;justify-content:space-between;font-size:.8rem;margin-bottom:6px; }
  .prog-bar-bg { background:var(--surface2);border-radius:4px;height:6px;overflow:hidden; }
  .prog-bar-fill { height:100%;border-radius:4px; }
  .mini-metric { text-align:center; }
  .mini-metric .val { font-family:'Bebas Neue',sans-serif;font-size:1.8rem; }
  .mini-metric .lbl { font-size:.7rem;color:var(--muted);text-transform:uppercase;letter-spacing:1.5px; }
  .class-row { display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid var(--border); }
  .class-row:last-child { border-bottom:none; }
  .class-time { font-family:'Bebas Neue',sans-serif;font-size:1rem;letter-spacing:1px;color:var(--accent);min-width:56px; }
  .class-name { font-size:.85rem;font-weight:600; }
  .class-trainer { font-size:.75rem;color:var(--muted); }
  .class-spots { margin-left:auto;font-size:.75rem;color:var(--muted);white-space:nowrap; }
  .class-spots span { color:var(--text);font-weight:600; }
  .payment-row { display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid var(--border); }
  .payment-row:last-child { border-bottom:none; }
  .pay-icon { width:36px;height:36px;border-radius:9px;background:rgba(232,255,71,.1);display:grid;place-items:center;color:var(--accent);font-size:.9rem;flex-shrink:0; }
  .pay-name { font-size:.84rem;font-weight:500; }
  .pay-plan { font-size:.73rem;color:var(--muted); }
  .pay-amount { margin-left:auto;font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:#4ade80; }
  ::-webkit-scrollbar{width:4px;height:4px;} ::-webkit-scrollbar-track{background:transparent;} ::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px;}
  .modal-content{background:var(--surface);border:1px solid var(--border);color:var(--text);border-radius:14px;}
  .modal-header{border-bottom:1px solid var(--border);} .modal-footer{border-top:1px solid var(--border);}
  .form-control,.form-select{background:var(--surface2);border:1px solid var(--border);color:var(--text);font-family:'DM Sans',sans-serif;border-radius:8px;}
  .form-control:focus,.form-select:focus{background:var(--surface2);border-color:var(--accent);box-shadow:0 0 0 2px rgba(232,255,71,.15);color:var(--text);}
  .form-select option{background:var(--surface2);}
  .form-label{font-size:.8rem;color:var(--muted);font-weight:500;margin-bottom:6px;}
  .tab-nav{display:flex;gap:4px;background:var(--surface2);padding:4px;border-radius:9px;margin-bottom:24px;}
  .tab-btn{flex:1;text-align:center;padding:8px 12px;border-radius:7px;cursor:pointer;font-size:.82rem;font-weight:500;color:var(--muted);transition:all .2s;border:none;background:transparent;font-family:'DM Sans',sans-serif;}
  .tab-btn.active{background:var(--surface);color:var(--text);}
 .pump-house {
            font-size: 5rem;            /* large to show details, scale as you like */
            font-weight: 800;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #ffd966, #fbbf24, #ffe68f, #fbbf24);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;

            /* core animation: gradient shift + glow pulse */
            animation: gradientFlow 3.5s ease infinite, softGlow 2.2s infinite alternate;

            /* optional slight transform for smoothness */
            transform: translateZ(0);
            text-rendering: optimizeLegibility;
        }

        /* moves the gradient across the text – gives fiery / metallic feel */
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* glow that changes intensity and size – pure yellow/black theme */
        @keyframes softGlow {
            from {
                text-shadow: 
                    0 0 5px #fbbf24,
                    0 0 12px #fbbf24,
                    0 0 20px #ffd96666;
            }
            to {
                text-shadow: 
                    0 0 10px #ffdf80,
                    0 0 25px #ffd966,
                    0 0 35px #fbbf24,
                    0 0 50px #fbbf2466;
            }
        }
        body.light-mode {
  --bg: #f5f6fa;
  --surface: #ffffff;
  --surface2: #f1f3f6;
  --border: #e2e5ea;
  --accent: #111111;
  --accent2: #ff4757;
  --text: #111111;
  --muted: #6b7280;

}
  @keyframes fadeIn{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
  .content>*{animation:fadeIn .4s ease both;}
  .content>*:nth-child(1){animation-delay:.05s;} .content>*:nth-child(2){animation-delay:.1s;} .content>*:nth-child(3){animation-delay:.15s;} .content>*:nth-child(4){animation-delay:.2s;}
  @media(max-width:992px){.sidebar{transform:translateX(-100%);} .sidebar.open{transform:translateX(0);} .main{margin-left:0;} .fee-alert-banner{left:0;}}
</style>
</head>
<body>

<!-- ── Sidebar ─────────────────────────────────────────────── -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-logo">
 <h1 class="pump-house">PUMP HOUSE</h1>
     <span>Gym Management</span>
  </div>
  <div class="nav-section">Main</div>
  <a class="nav-item active" onclick="showPage('dashboard')"><i class="fa fa-gauge-high"></i> Dashboard</a>
  <a class="nav-item" onclick="showPage('members')"><i class="fa fa-users"></i> Members</a>
  <!-- <a class="nav-item" onclick="showPage('classes')"><i class="fa fa-calendar-days"></i> Classes</a> -->
  <!-- <a class="nav-item" onclick="showPage('trainers')"><i class="fa fa-person-running"></i> Trainers</a> -->
  <div class="nav-section">Finance</div>
  <a class="nav-item" onclick="showPage('payments')"><i class="fa fa-credit-card"></i> Payments</a>
  <a class="nav-item" onclick="showPage('memberships')"><i class="fa fa-id-card"></i> Memberships</a>
  <div class="nav-section">System</div>
  <a class="nav-item" onclick="showPage('reports')"><i class="fa fa-chart-line"></i> Reports</a>
  <a class="nav-item" onclick="showPage('settings')"><i class="fa fa-gear"></i> Settings</a>
  <div class="sidebar-bottom">
    <div class="admin-chip">
      <div class="admin-avatar">JD</div>
      <div><div class="name">John Dean</div><div class="role">Super Admin</div></div>
    </div>
  </div>
</div>

<!-- ── Main ──────────────────────────────────────────────────── -->
<div class="main">
  <div class="topbar">
    <button class="icon-btn d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')"><i class="fa fa-bars"></i></button>
    <div class="topbar-title" id="page-title">Dashboard</div>
    <div class="topbar-search"><i class="fa fa-magnifying-glass"></i><input type="text" placeholder="Search members, classes..."></div>
    <div class="topbar-actions">
      <div class="icon-btn"><i class="fa fa-bell"></i><div class="badge-dot"></div></div>
<div class="icon-btn" id="themeToggle">
  <i class="fa fa-moon"></i>
</div>    </div>
  </div>

  <!-- DASHBOARD -->
  <div id="page-dashboard" class="content">
    <div class="row g-3 mb-4">
      <div class="col-sm-6 col-xl-4"><div class="stat-card c1"><div class="stat-icon"><i class="fa fa-users"></i></div><div class="stat-label">Active Members</div><div class="stat-value">1,284</div><div class="stat-sub"><span class="up">↑ 12%</span> vs last month</div></div></div>
      <div class="col-sm-6 col-xl-4"><div class="stat-card c2"><div class="stat-icon"><i class="fa fa-dollar-sign"></i></div><div class="stat-label">Monthly Revenue</div><div class="stat-value">$48,290</div><div class="stat-sub"><span class="up">↑ 8.3%</span> vs last month</div></div></div>
      <div class="col-sm-6 col-xl-4"><div class="stat-card c3"><div class="stat-icon"><i class="fa fa-calendar-xmark"></i></div><div class="stat-label">Expired Plans</div><div class="stat-value">67</div><div class="stat-sub"><span class="dn">↑ 4</span> this week</div></div></div>
      <!-- <div class="col-sm-6 col-xl-3"><div class="stat-card c4"><div class="stat-icon"><i class="fa fa-dumbbell"></i></div><div class="stat-label">Classes Today</div><div class="stat-value">14</div><div class="stat-sub"><span class="up">87%</span> average fill rate</div></div></div> -->
    </div>
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <div class="chart-card">
          <div class="section-head"><h2>Revenue Overview</h2><div class="tab-nav" style="margin:0;padding:3px;"><button class="tab-btn active" style="flex:none;padding:5px 12px;">Monthly</button><button class="tab-btn" style="flex:none;padding:5px 12px;">Weekly</button></div></div>
          <div class="chart-bars" id="revenue-chart"></div>
          <div style="display:flex;gap:16px;margin-top:8px;padding-top:8px;border-top:1px solid var(--border);">
            <div class="mini-metric"><div class="val" style="font-size:1.2rem;color:var(--accent);">$48,290</div><div class="lbl">This Month</div></div>
            <div class="mini-metric"><div class="val" style="font-size:1.2rem;">$44,611</div><div class="lbl">Last Month</div></div>
            <div class="mini-metric"><div class="val" style="font-size:1.2rem;color:#4ade80;">+8.3%</div><div class="lbl">Growth</div></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="chart-card h-100">
          <div class="section-head"><h2>Plan Distribution</h2></div>
          <div class="prog-row"><div class="prog-label"><span>Annual</span><span>48%</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:48%;background:var(--accent);"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Monthly</span><span>33%</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:33%;background:#4fc3f7;"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Quarterly</span><span>14%</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:14%;background:#a78bfa;"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Trial</span><span>5%</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:5%;background:#fbbf24;"></div></div></div>
          <div class="row g-2 mt-2">
            <div class="col-6"><div class="mini-metric" style="background:var(--surface2);padding:10px;border-radius:8px;"><div class="val">89%</div><div class="lbl">Retention</div></div></div>
            <div class="col-6"><div class="mini-metric" style="background:var(--surface2);padding:10px;border-radius:8px;"><div class="val">142</div><div class="lbl">New This Mo.</div></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-3 mb-4">
      <div class="col-lg-12">
        <div class="section-head"><h2>Recent Members</h2><button class="btn-accent" onclick="showPage('members')">View All</button></div>
        <div class="table-card"><table><thead><tr><th>Member</th><th>Plan</th><th>Joined</th><th>Status</th></tr></thead><tbody>
          <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#e8ff47;">AK</div>Alex Kim</div></td><td>Annual</td><td>Feb 18</td><td><span class="badge-status badge-active">Active</span></td></tr>
          <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#4fc3f7;">SR</div>Sara Reed</div></td><td>Monthly</td><td>Feb 16</td><td><span class="badge-status badge-active">Active</span></td></tr>
          <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#a78bfa;">MO</div>Mike Osei</div></td><td>Trial</td><td>Feb 15</td><td><span class="badge-status badge-trial">Trial</span></td></tr>
          <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#fb923c;">JP</div>Jane Park</div></td><td>Quarterly</td><td>Feb 10</td><td><span class="badge-status badge-expired">Expired</span></td></tr>
          <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#4ade80;">LC</div>Leo Chen</div></td><td>Annual</td><td>Feb 08</td><td><span class="badge-status badge-active">Active</span></td></tr>
        </tbody></table></div>
      </div>
      <!-- <div class="col-lg-5">
        <div class="section-head"><h2>Today's Classes</h2><button class="btn-outline-accent">Full Schedule</button></div>
        <div class="chart-card">
          <div class="class-row"><div class="class-time">06:00</div><div><div class="class-name">Morning HIIT</div><div class="class-trainer">Sarah Mills</div></div><div class="class-spots"><span>18</span>/20</div></div>
          <div class="class-row"><div class="class-time">08:30</div><div><div class="class-name">Yoga Flow</div><div class="class-trainer">Diana Cruz</div></div><div class="class-spots"><span>12</span>/15</div></div>
          <div class="class-row"><div class="class-time">11:00</div><div><div class="class-name">Strength & Tone</div><div class="class-trainer">Marcus Lee</div></div><div class="class-spots"><span>8</span>/25</div></div>
          <div class="class-row"><div class="class-time">17:30</div><div><div class="class-name">Spin Cycle</div><div class="class-trainer">Amy Torres</div></div><div class="class-spots"><span>20</span>/20</div></div>
          <div class="class-row"><div class="class-time">19:00</div><div><div class="class-name">Boxing Bootcamp</div><div class="class-trainer">Jake Russo</div></div><div class="class-spots"><span>14</span>/20</div></div>
        </div>
      </div> -->
    </div>
    <div class="row g-3">
      <div class="col-lg-5">
        <div class="section-head"><h2>Recent Payments</h2><button class="btn-outline-accent" onclick="showPage('payments')">View All</button></div>
        <div class="chart-card">
          <div class="payment-row"><div class="pay-icon"><i class="fa fa-check"></i></div><div><div class="pay-name">Alex Kim</div><div class="pay-plan">Annual Plan</div></div><div class="pay-amount">$599</div></div>
          <div class="payment-row"><div class="pay-icon"><i class="fa fa-check"></i></div><div><div class="pay-name">Sara Reed</div><div class="pay-plan">Monthly Plan</div></div><div class="pay-amount">$59</div></div>
          <div class="payment-row"><div class="pay-icon" style="background:rgba(255,71,87,.1);color:var(--accent2);"><i class="fa fa-xmark"></i></div><div><div class="pay-name">Jane Park</div><div class="pay-plan">Quarterly Plan</div></div><div class="pay-amount" style="color:var(--accent2);">$149</div></div>
          <div class="payment-row"><div class="pay-icon"><i class="fa fa-check"></i></div><div><div class="pay-name">Leo Chen</div><div class="pay-plan">Annual Plan</div></div><div class="pay-amount">$599</div></div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="section-head"><h2>Attendance (This Week)</h2></div>
        <div class="chart-card"><div class="chart-bars" id="attend-chart"></div></div>
      </div>
    </div>
  </div>

  <!-- MEMBERS -->
  <div id="page-members" class="content" style="display:none;">
    <div class="section-head mb-3">
      <div><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">All Members</h2><div style="font-size:.8rem;color:var(--muted);">1,284 total members</div></div>
      <div style="display:flex;gap:8px;">
        <select class="form-select form-select-sm" style="width:140px;"><option>All Plans</option><option>Annual</option><option>Monthly</option><option>Quarterly</option><option>Trial</option></select>
        <button class="btn-accent" data-bs-toggle="modal" data-bs-target="#addMemberModal"><i class="fa fa-plus me-1"></i> Add Member</button>
      </div>
    </div>

    <!-- Inline Fee Due Alert — rendered by JS -->
    <div id="fee-inline-alert"></div>

    <div class="table-card"><table><thead><tr><th>Member</th><th>Email</th><th>Plan</th><th>Fee Day</th><th>Expiry</th><th>Check-ins</th><th>Status</th><th>Actions</th></tr></thead><tbody id="members-table-body"></tbody></table></div>
  </div>

  <!-- PAYMENTS -->
  <div id="page-payments" class="content" style="display:none;">
    <div class="section-head mb-3"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">Payments</h2><button class="btn-accent"><i class="fa fa-download me-1"></i> Export CSV</button></div>
    <div class="row g-3 mb-4">
      <div class="col-sm-4"><div class="stat-card c1"><div class="stat-label">Total Collected</div><div class="stat-value">$48,290</div></div></div>
      <div class="col-sm-4"><div class="stat-card c3"><div class="stat-label">Outstanding</div><div class="stat-value">$3,410</div></div></div>
      <div class="col-sm-4"><div class="stat-card c4"><div class="stat-label">Transactions</div><div class="stat-value">412</div></div></div>
    </div>
    <div class="table-card"><table><thead><tr><th>Member</th><th>Plan</th><th>Amount</th><th>Date</th><th>Method</th><th>Status</th></tr></thead><tbody>
      <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#e8ff47;">AK</div>Alex Kim</div></td><td>Annual</td><td style="color:#4ade80;font-weight:600;">$599</td><td>Feb 18, 2026</td><td>Card</td><td><span class="badge-status badge-active">Paid</span></td></tr>
      <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#4fc3f7;">SR</div>Sara Reed</div></td><td>Monthly</td><td style="color:#4ade80;font-weight:600;">$59</td><td>Feb 16, 2026</td><td>Cash</td><td><span class="badge-status badge-active">Paid</span></td></tr>
      <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#fb923c;">JP</div>Jane Park</div></td><td>Quarterly</td><td style="color:var(--accent2);font-weight:600;">$149</td><td>Feb 10, 2026</td><td>Card</td><td><span class="badge-status badge-expired">Failed</span></td></tr>
      <tr><td><div style="display:flex;align-items:center;"><div class="mem-avatar" style="background:#4ade80;">LC</div>Leo Chen</div></td><td>Annual</td><td style="color:#4ade80;font-weight:600;">$599</td><td>Feb 08, 2026</td><td>Transfer</td><td><span class="badge-status badge-active">Paid</span></td></tr>
    </tbody></table></div>
  </div>

  <!-- CLASSES -->
  <div id="page-classes" class="content" style="display:none;">
    <div class="section-head mb-3"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">Classes</h2><button class="btn-accent" data-bs-toggle="modal" data-bs-target="#addClassModal"><i class="fa fa-plus me-1"></i> Add Class</button></div>
    <div class="row g-3" id="classes-container"></div>
  </div>

  <!-- TRAINERS -->
  <!-- <div id="page-trainers" class="content" style="display:none;">
    <div class="section-head mb-3"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">Trainers</h2><button class="btn-accent"><i class="fa fa-plus me-1"></i> Add Trainer</button></div>
    <div class="row g-3" id="trainers-container"></div>
  </div> -->

  <!-- MEMBERSHIPS -->
  <div id="page-memberships" class="content" style="display:none;">
    <div class="section-head mb-4"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">Membership Plans</h2><button class="btn-accent"><i class="fa fa-plus me-1"></i> New Plan</button></div>
    <div class="row g-4">
      <div class="col-md-3"><div class="chart-card" style="text-align:center;padding:30px 20px;"><div style="font-size:.8rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">Trial</div><div style="font-family:'Bebas Neue',sans-serif;font-size:3rem;color:var(--accent);">FREE</div><div style="font-size:.78rem;color:var(--muted);margin-bottom:20px;">7-day access</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Gym access</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>1 class/day</div><div style="font-size:.82rem;margin-bottom:8px;color:var(--muted);"><i class="fa fa-xmark me-2" style="color:var(--accent2);"></i>Personal trainer</div><div style="margin-top:16px;font-size:.78rem;color:var(--muted);">142 active</div></div></div>
      <div class="col-md-3"><div class="chart-card" style="text-align:center;padding:30px 20px;"><div style="font-size:.8rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">Monthly</div><div style="font-family:'Bebas Neue',sans-serif;font-size:3rem;">$59<span style="font-size:1rem;">/mo</span></div><div style="font-size:.78rem;color:var(--muted);margin-bottom:20px;">Billed monthly</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited access</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>All classes</div><div style="font-size:.82rem;margin-bottom:8px;color:var(--muted);"><i class="fa fa-xmark me-2" style="color:var(--accent2);"></i>Personal trainer</div><div style="margin-top:16px;font-size:.78rem;color:var(--muted);">422 active</div></div></div>
      <div class="col-md-3"><div class="chart-card" style="border:2px solid var(--accent);text-align:center;padding:30px 20px;position:relative;"><div style="position:absolute;top:-12px;left:50%;transform:translateX(-50%);background:var(--accent);color:#000;font-size:.65rem;font-weight:700;padding:3px 12px;border-radius:20px;letter-spacing:1px;">POPULAR</div><div style="font-size:.8rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">Quarterly</div><div style="font-family:'Bebas Neue',sans-serif;font-size:3rem;color:var(--accent);">$149<span style="font-size:1rem;">/qtr</span></div><div style="font-size:.78rem;color:var(--muted);margin-bottom:20px;">Save 16%</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited access</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>All classes</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>2 PT sessions</div><div style="margin-top:16px;font-size:.78rem;color:var(--muted);">180 active</div></div></div>
      <div class="col-md-3"><div class="chart-card" style="text-align:center;padding:30px 20px;"><div style="font-size:.8rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">Annual</div><div style="font-family:'Bebas Neue',sans-serif;font-size:3rem;">$599<span style="font-size:1rem;">/yr</span></div><div style="font-size:.78rem;color:var(--muted);margin-bottom:20px;">Save 30%</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited access</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>All classes</div><div style="font-size:.82rem;margin-bottom:8px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited PT</div><div style="margin-top:16px;font-size:.78rem;color:var(--muted);">540 active</div></div></div>
    </div>
  </div>

  <!-- REPORTS -->
  <div id="page-reports" class="content" style="display:none;">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;margin-bottom:20px;">Reports</h2>
    <div class="row g-3">
      <div class="col-md-6"><div class="chart-card"><div class="section-head"><h2>Monthly Sign-ups</h2></div><div class="chart-bars" id="signup-chart"></div></div></div>
      <div class="col-md-6"><div class="chart-card"><div class="section-head"><h2>Revenue by Plan</h2></div><div style="margin-top:10px;"><div class="prog-row"><div class="prog-label"><span>Annual ($599)</span><span>$29,351</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:72%;background:var(--accent);"></div></div></div><div class="prog-row"><div class="prog-label"><span>Monthly ($59)</span><span>$11,682</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:45%;background:#4fc3f7;"></div></div></div><div class="prog-row"><div class="prog-label"><span>Quarterly ($149)</span><span>$7,257</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:28%;background:#a78bfa;"></div></div></div></div></div></div>
    </div>
  </div>

  <!-- SETTINGS -->
  <div id="page-settings" class="content" style="display:none;">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;margin-bottom:24px;">Settings</h2>
    <div class="row g-4">
      <div class="col-md-6"><div class="chart-card"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:1px;margin-bottom:20px;">Gym Details</h2><div class="mb-3"><label class="form-label">Gym Name</label><input type="text" class="form-control" value="IronCore Fitness"></div><div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" value="admin@ironcore.gym"></div><div class="mb-3"><label class="form-label">Phone</label><input type="text" class="form-control" value="+1 (555) 123-4567"></div><div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" value="123 Fitness Ave, New York"></div><button class="btn-accent">Save Changes</button></div></div>
      <div class="col-md-6"><div class="chart-card"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:1px;margin-bottom:20px;">Opening Hours</h2><div class="mb-3"><label class="form-label">Weekdays</label><div class="row g-2"><div class="col"><input type="time" class="form-control" value="05:00"></div><div class="col"><input type="time" class="form-control" value="22:00"></div></div></div><div class="mb-3"><label class="form-label">Saturday</label><div class="row g-2"><div class="col"><input type="time" class="form-control" value="07:00"></div><div class="col"><input type="time" class="form-control" value="20:00"></div></div></div><div class="mb-3"><label class="form-label">Sunday</label><div class="row g-2"><div class="col"><input type="time" class="form-control" value="08:00"></div><div class="col"><input type="time" class="form-control" value="18:00"></div></div></div><button class="btn-accent">Save Hours</button></div></div>
    </div>
  </div>
</div>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title" style="font-family:'Bebas Neue',sans-serif;letter-spacing:1px;">Add New Member</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="row g-3">
      <div class="col-6"><label class="form-label">Full Name</label><input type="text" class="form-control" placeholder="John"></div>
      <div class="col-6"><label class="form-label">Roll Number</label><input type="text" class="form-control" placeholder="1,2,3...."></div>
      <div class="col-12"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="john@email.com"></div>
      <div class="col-6"><label class="form-label">Phone</label><input type="text" class="form-control" placeholder="+1 (555) ..."></div>
      <div class="col-6"><label class="form-label">Plan</label><select class="form-select"><option>Trial</option><option>Monthly</option><option>Quarterly</option><option>Annual</option></select></div>
      <div class="col-6"><label class="form-label">Fee Day of Month</label><input type="number" class="form-control" placeholder="e.g. 21" min="1" max="31"></div>
      <div class="col-6"><label class="form-label">Gender</label><select class="form-select"><option>Male</option><option>Female</option><option>Other</option></select></div>
    </div></div>
    <div class="modal-footer"><button class="btn-outline-accent" data-bs-dismiss="modal">Cancel</button><button class="btn-accent" data-bs-dismiss="modal">Add Member</button></div>
  </div></div>
</div>

<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title" style="font-family:'Bebas Neue',sans-serif;letter-spacing:1px;">Add New Class</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
    <!-- <div class="modal-body"><div class="row g-3">
      <div class="col-12"><label class="form-label">Class Name</label><input type="text" class="form-control" placeholder="e.g. Morning HIIT"></div>
      <div class="col-6"><label class="form-label">Trainer</label><input type="text" class="form-control" placeholder="Trainer name"></div>
      <div class="col-6"><label class="form-label">Capacity</label><input type="number" class="form-control" placeholder="20"></div>
      <div class="col-6"><label class="form-label">Time</label><input type="time" class="form-control" value="07:00"></div>
      <div class="col-6"><label class="form-label">Duration (min)</label><input type="number" class="form-control" placeholder="60"></div>
    </div></div> -->
    <div class="modal-footer"><button class="btn-outline-accent" data-bs-dismiss="modal">Cancel</button><button class="btn-accent" data-bs-dismiss="modal">Add Class</button></div>
  </div></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
// ── Data ──────────────────────────────────────────────────────────────────────
const today    = new Date();
const todayDay = today.getDate(); // e.g. 21

// Members — feeDay = day of month their fee is due
// For this demo, we set 5 members to todayDay so the banner ALWAYS fires
const members = [
  { initials:'AK', color:'#e8ff47', name:'Alex Kim',   email:'alex@email.com',  plan:'Annual',    feeDay:todayDay, feePlan:'Annual – $599',    expiry:'Feb 2027', checkins:48, status:'active'  },
  { initials:'SR', color:'#4fc3f7', name:'Sara Reed',  email:'sara@email.com',  plan:'Monthly',   feeDay:todayDay, feePlan:'Monthly – $59',    expiry:'Mar 2026', checkins:22, status:'active'  },
  { initials:'MO', color:'#a78bfa', name:'Mike Osei',  email:'mike@email.com',  plan:'Trial',     feeDay:todayDay, feePlan:'Trial (Expiring)', expiry:'Feb 28',   checkins:3,  status:'trial'   },
  { initials:'JP', color:'#fb923c', name:'Jane Park',  email:'jane@email.com',  plan:'Quarterly', feeDay:10,       feePlan:'Quarterly – $149', expiry:'Feb 10',   checkins:31, status:'expired' },
  { initials:'LC', color:'#4ade80', name:'Leo Chen',   email:'leo@email.com',   plan:'Annual',    feeDay:8,        feePlan:'Annual – $599',    expiry:'Feb 2027', checkins:61, status:'active'  },
  { initials:'TW', color:'#f472b6', name:'Tara White', email:'tara@email.com',  plan:'Monthly',   feeDay:todayDay, feePlan:'Monthly – $59',    expiry:'Mar 2026', checkins:14, status:'active'  },
  { initials:'RS', color:'#fb923c', name:'Ryan Singh', email:'ryan@email.com',  plan:'Annual',    feeDay:15,       feePlan:'Annual – $599',    expiry:'Jan 2027', checkins:55, status:'active'  },
  { initials:'KP', color:'#60a5fa', name:'Kim Patel',  email:'kim@email.com',   plan:'Quarterly', feeDay:todayDay, feePlan:'Quarterly – $149', expiry:'Apr 2026', checkins:29, status:'active'  },
];

const classesData = [
  {name:'Morning HIIT',    trainer:'Sarah Mills', time:'06:00', capacity:20,enrolled:18,days:'Mon-Sat',   color:'#e8ff47'},
  {name:'Yoga Flow',       trainer:'Diana Cruz',  time:'08:30', capacity:15,enrolled:12,days:'Daily',     color:'#4fc3f7'},
  {name:'Strength & Tone', trainer:'Marcus Lee',  time:'11:00', capacity:25,enrolled:8, days:'Mon/Wed/Fri',color:'#a78bfa'},
  {name:'Spin Cycle',      trainer:'Amy Torres',  time:'17:30', capacity:20,enrolled:20,days:'Tue/Thu/Sat',color:'#fb923c'},
  {name:'Boxing Bootcamp', trainer:'Jake Russo',  time:'19:00', capacity:20,enrolled:14,days:'Mon/Wed',   color:'#f472b6'},
  {name:'Pilates Core',    trainer:'Luna Reyes',  time:'09:00', capacity:12,enrolled:10,days:'Tue/Thu',   color:'#4ade80'},
];

// const trainersData = [
//   {initials:'SM',color:'#e8ff47',name:'Sarah Mills', specialty:'HIIT & Cardio',       classes:3,rating:4.9,members:87},
//   {initials:'DC',color:'#4fc3f7',name:'Diana Cruz',  specialty:'Yoga & Wellness',      classes:2,rating:4.8,members:62},
//   {initials:'ML',color:'#a78bfa',name:'Marcus Lee',  specialty:'Strength Training',    classes:4,rating:4.7,members:95},
//   {initials:'AT',color:'#fb923c',name:'Amy Torres',  specialty:'Cycling & Cardio',     classes:3,rating:4.9,members:74},
//   {initials:'JR',color:'#f472b6',name:'Jake Russo',  specialty:'Boxing & Combat',      classes:2,rating:4.6,members:51},
//   {initials:'LR',color:'#4ade80',name:'Luna Reyes',  specialty:'Pilates & Flexibility',classes:2,rating:4.8,members:43},
// ];

// ── Page Navigation ───────────────────────────────────────────────────────────
const pages = ['dashboard','members','payments','classes',,'memberships','reports','settings'];
function showPage(name) {
  pages.forEach(p => { const el = document.getElementById('page-'+p); if(el) el.style.display='none'; });
  document.getElementById('page-'+name).style.display = '';
  document.getElementById('page-title').textContent = name.charAt(0).toUpperCase()+name.slice(1);
  document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(el => {
    if(el.textContent.trim().toLowerCase().includes(name.toLowerCase().slice(0,4))) el.classList.add('active');
  });
  if(name==='members') renderMembersTable();
  if(name==='classes') renderClasses();
  // if(name==='trainers') renderTrainers();
  if(name==='reports') setTimeout(()=>renderChart('signup-chart',[42,58,67,71,88,95,102,89,76,112,138,142],['Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb'],'#a78bfa'),100);
}

// ── Fee Due — Inline Panel (Members page only) ────────────────────────────────
function renderFeeAlert() {
  const due = members.filter(m => m.feeDay === todayDay);
  const container = document.getElementById('fee-inline-alert');
  if (!container) return;
  if (!due.length) { container.innerHTML = ''; return; }

  const dateStr = today.toLocaleDateString('en-US', { weekday:'long', month:'long', day:'numeric' });
  container.innerHTML = `
    <div class="fee-inline-panel">
      <div class="fee-inline-header">
        <div class="fee-inline-dot"></div>
        <i class="fa fa-triangle-exclamation" style="color:#ff6b6b;font-size:1rem;"></i>
        <div class="fee-inline-title">
          Fee Collection Day — <span>${due.length} member${due.length>1?'s':''} due today</span>
          <div style="font-size:.73rem;font-weight:400;color:#fca5a5;margin-top:2px;">${dateStr} · Collect payments below</div>
        </div>
        <div class="fee-inline-badge">${due.length} Pending</div>
      </div>
      <div class="fee-inline-chips">
        ${due.map(m => `<div class="fee-inline-chip">
          <div class="fee-inline-chip-av" style="background:${m.color};">${m.initials}</div>
          ${m.name} <span style="opacity:.65;margin-left:2px;">· ${m.feePlan}</span>
        </div>`).join('')}
      </div>
    </div>`;
}

// ── Members Table ─────────────────────────────────────────────────────────────
function renderMembersTable() {
  renderFeeAlert();
  document.getElementById('members-table-body').innerHTML = members.map(m => {
    const isDue = m.feeDay === todayDay;
    return `<tr class="${isDue ? 'fee-due-row' : ''}">
      <td><div style="display:flex;align-items:center;">
        <div class="mem-avatar" style="background:${m.color};">${m.initials}</div>${m.name}
        ${isDue ? '<span class="fee-due-tag"><i class="fa fa-circle-exclamation"></i> FEE DUE</span>' : ''}
      </div></td>
      <td style="color:var(--muted);font-size:.82rem;">${m.email}</td>
      <td>${m.plan}</td>
      <td style="${isDue ? 'color:#ff6b6b;font-weight:700;animation:feePulseText 1.2s ease-in-out infinite;' : 'color:var(--muted);'}">
        Day ${m.feeDay}${isDue ? ' ← TODAY' : ''}
      </td>
      <td style="font-size:.82rem;">${m.expiry}</td>
      <td><span style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;">${m.checkins}</span></td>
      <td><span class="badge-status badge-${m.status}">${m.status.charAt(0).toUpperCase()+m.status.slice(1)}</span></td>
      <td>
        <button class="btn-outline-accent" style="padding:4px 10px;font-size:.72rem;margin-right:4px;">Edit</button>
        ${isDue
          ? '<button class="btn-accent" style="padding:4px 10px;font-size:.72rem;background:#ff2d44;">Collect</button>'
          : '<button class="btn-outline-accent" style="padding:4px 10px;font-size:.72rem;color:var(--accent2);border-color:rgba(255,71,87,.3);">Delete</button>'
        }
      </td>
    </tr>`;
  }).join('');
}

// ── Classes ───────────────────────────────────────────────────────────────────
function renderClasses() {
  document.getElementById('classes-container').innerHTML = classesData.map(c => `
    <div class="col-md-6 col-xl-4">
      <div class="chart-card" style="border-top:3px solid ${c.color};">
        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:12px;">
          <div><div style="font-weight:700;font-size:.95rem;">${c.name}</div><div style="font-size:.75rem;color:var(--muted);">${c.trainer}</div></div>
          <span style="font-family:'Bebas Neue',sans-serif;font-size:1rem;color:${c.color};">${c.time}</span>
        </div>
        <div style="margin-bottom:10px;">
          <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px;"><span style="color:var(--muted);">Enrolled</span><span>${c.enrolled}/${c.capacity}</span></div>
          <div class="prog-bar-bg"><div class="prog-bar-fill" style="width:${Math.round(c.enrolled/c.capacity*100)}%;background:${c.color};"></div></div>
        </div>
        <div style="font-size:.73rem;color:var(--muted);">${c.days}</div>
      </div>
    </div>`).join('');
}

// ── Trainers ──────────────────────────────────────────────────────────────────
// function renderTrainers() {
//   document.getElementById('trainers-container').innerHTML = trainersData.map(t => `
//     <div class="col-md-6 col-xl-4">
//       <div class="chart-card" style="display:flex;flex-direction:column;gap:12px;">
//         <div style="display:flex;align-items:center;gap:14px;">
//           <div class="admin-avatar" style="width:48px;height:48px;font-size:1rem;background:${t.color};">${t.initials}</div>
//           <div><div style="font-weight:700;">${t.name}</div><div style="font-size:.75rem;color:var(--muted);">${t.specialty}</div></div>
//           <div style="margin-left:auto;font-family:'Bebas Neue',sans-serif;color:var(--accent);">★ ${t.rating}</div>
//         </div>
//         <div style="display:flex;gap:16px;">
//           <div class="mini-metric"><div class="val" style="font-size:1.4rem;">${t.classes}</div><div class="lbl">Classes</div></div>
//           <div class="mini-metric"><div class="val" style="font-size:1.4rem;">${t.members}</div><div class="lbl">Members</div></div>
//         </div>
//         <button class="btn-outline-accent" style="width:100%;text-align:center;">View Profile</button>
//       </div>
//     </div>`).join('');
// }

// ── Charts ────────────────────────────────────────────────────────────────────
const months    = ['Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb'];
const revenueData = [32000,34500,29800,38000,41200,39600,43100,45800,42000,44611,46200,48290];
const attendData  = [120,145,160,132,178,201,188];
const weekDays    = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

function renderChart(id, data, labels, color) {
  const el = document.getElementById(id); if(!el) return;
  const max = Math.max(...data);
  el.innerHTML = data.map((v,i) => {
    const h = Math.max(8, Math.round((v/max)*100));
    const isCurrent = i === data.length-1;
    return `<div class="bar-wrap"><div class="bar" style="height:${h}px;background:${isCurrent?color:'var(--surface2)'};"></div><div class="bar-label">${labels[i]}</div></div>`;
  }).join('');
}
const themeToggle = document.getElementById("themeToggle");
const themeIcon = themeToggle.querySelector("i");

// Load saved theme
if (localStorage.getItem("theme") === "light") {
  document.body.classList.add("light-mode");
  themeIcon.classList.remove("fa-moon");
  themeIcon.classList.add("fa-sun");
}

themeToggle.addEventListener("click", () => {
  document.body.classList.toggle("light-mode");

  if (document.body.classList.contains("light-mode")) {
    localStorage.setItem("theme", "light");
    themeIcon.classList.remove("fa-moon");
    themeIcon.classList.add("fa-sun");
  } else {
    localStorage.setItem("theme", "dark");
    themeIcon.classList.remove("fa-sun");
    themeIcon.classList.add("fa-moon");
  }
});

// ── Init ──────────────────────────────────────────────────────────────────────
renderChart('revenue-chart', revenueData, months, 'var(--accent)');
renderChart('attend-chart',  attendData,  weekDays, '#4fc3f7');
</script>
</body>
</html> 