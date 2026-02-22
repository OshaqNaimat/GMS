<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "./Bootstrap.php"?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<style>
/* ─── CSS Variables ─── */
:root {
  --accent:   #F5C518;
  --accent2:  #ff4757;
  --bg:       #0d0d0d;
  --surface:  #141414;
  --surface2: #1c1c1c;
  --surface3: #242424;
  --border:   rgba(255,255,255,0.07);
  --text:     #e8e8e8;
  --muted:    #666;
  --sidebar-w: 240px;
}
body.light {
  --bg:       #f2f2f2;
  --surface:  #ffffff;
  --surface2: #f7f7f7;
  --surface3: #ececec;
  --border:   rgba(0,0,0,0.08);
  --text:     #111;
  --muted:    #888;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Barlow',sans-serif;background:var(--bg);color:var(--text);display:flex;min-height:100vh;transition:background .3s,color .3s;}

/* ─── Sidebar ─── */
.sidebar{
  width:var(--sidebar-w);min-width:var(--sidebar-w);
  background:var(--surface);border-right:1px solid var(--border);
  display:flex;flex-direction:column;
  position:fixed;top:0;left:0;bottom:0;z-index:200;
  transition:transform .3s,background .3s;overflow-y:auto;

}
.sidebar-logo{padding:24px 20px 16px;border-bottom:1px solid var(--border);}
.pump-house{font-family:'Bebas Neue',sans-serif;font-size:26px;letter-spacing:3px;color:var(--accent);line-height:1;}
.sidebar-logo span{font-size:10px;letter-spacing:3px;color:var(--muted);text-transform:uppercase;}

.nav-section{font-size:10px;letter-spacing:3px;color:var(--muted);text-transform:uppercase;padding:20px 20px 6px;}
.nav-item{
  display:flex;align-items:center;gap:12px;
  padding:11px 20px;font-size:13.5px;font-weight:500;
  color:var(--muted);cursor:pointer;text-decoration:none;
  border-left:3px solid transparent;transition:all .2s;
}
.nav-item:hover{color:var(--text);background:var(--surface2);}
.nav-item.active{color:var(--accent);background:rgba(245,197,24,.07);border-left-color:var(--accent);}
.nav-item i{width:16px;text-align:center;font-size:14px;}

.sidebar-bottom{margin-top:auto;padding:16px 20px;border-top:1px solid var(--border);}
.member-chip{display:flex;align-items:center;gap:10px;}
.member-avatar-sm{
  width:34px;height:34px;border-radius:50%;
  background:var(--accent);color:#000;
  font-weight:700;font-size:12px;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.member-chip .name{font-size:13px;font-weight:600;}
.member-chip .role{font-size:11px;color:var(--muted);}

/* ─── Main ─── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}

/* ─── Topbar ─── */
.topbar{
  height:60px;background:var(--surface);border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:12px;
  padding:0 24px;position:sticky;top:0;z-index:100;transition:background .3s;
}
.topbar-title{font-family:'Bebas Neue',sans-serif;font-size:20px;letter-spacing:1px;flex:1;}
.topbar-search{
  display:flex;align-items:center;gap:8px;
  background:var(--surface2);border:1px solid var(--border);
  border-radius:8px;padding:6px 12px;
}
.topbar-search input{background:none;border:none;outline:none;font-size:13px;color:var(--text);width:180px;}
.topbar-search input::placeholder{color:var(--muted);}
.topbar-search i{color:var(--muted);font-size:13px;}
.topbar-actions{display:flex;align-items:center;gap:8px;}
.icon-btn{
  width:36px;height:36px;border-radius:8px;
  background:var(--surface2);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;position:relative;color:var(--muted);
  transition:all .2s;font-size:14px;
}
.icon-btn:hover{color:var(--accent);border-color:rgba(245,197,24,.3);}
.badge-dot{position:absolute;top:7px;right:7px;width:7px;height:7px;border-radius:50%;background:var(--accent);border:2px solid var(--surface);}

/* ─── Content ─── */
.content{padding:24px;animation:fadeUp .35s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

/* ─── Stat Cards ─── */
.stat-card{
  background:var(--surface);border:1px solid var(--border);
  border-radius:12px;padding:20px;display:flex;flex-direction:column;gap:6px;
  transition:background .3s;
}
.stat-card.c1{background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(245,197,24,.04));border-color:rgba(245,197,24,.2);}
.stat-card.c2{background:linear-gradient(135deg,rgba(79,195,247,.12),rgba(79,195,247,.04));border-color:rgba(79,195,247,.2);}
.stat-card.c3{background:linear-gradient(135deg,rgba(255,71,87,.1),rgba(255,71,87,.03));border-color:rgba(255,71,87,.2);}
.stat-card.c4{background:linear-gradient(135deg,rgba(74,222,128,.1),rgba(74,222,128,.03));border-color:rgba(74,222,128,.2);}
.stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;margin-bottom:4px;}
.c1 .stat-icon{background:rgba(245,197,24,.15);color:var(--accent);}
.c2 .stat-icon{background:rgba(79,195,247,.15);color:#4fc3f7;}
.c3 .stat-icon{background:rgba(255,71,87,.15);color:var(--accent2);}
.c4 .stat-icon{background:rgba(74,222,128,.15);color:#4ade80;}
.stat-label{font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);}
.stat-value{font-family:'Bebas Neue',sans-serif;font-size:2rem;line-height:1;}
.stat-sub{font-size:11.5px;color:var(--muted);}

/* ─── Chart Card ─── */
.chart-card{background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:20px;transition:background .3s;}
.section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
.section-head h2{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:1px;}

/* ─── Bar Charts ─── */
.chart-bars{display:flex;align-items:flex-end;gap:8px;height:120px;}
.bar-wrap{flex:1;display:flex;flex-direction:column;align-items:center;gap:4px;}
.bar{width:100%;border-radius:4px 4px 0 0;background:var(--accent);opacity:.85;transition:opacity .2s;}
.bar:hover{opacity:1;}
.bar-label{font-size:10px;color:var(--muted);}

/* ─── Progress bars ─── */
.prog-row{margin-bottom:14px;}
.prog-label{display:flex;justify-content:space-between;font-size:12px;color:var(--muted);margin-bottom:5px;}
.prog-bar-bg{height:6px;background:var(--surface2);border-radius:4px;overflow:hidden;}
.prog-bar-fill{height:100%;border-radius:4px;transition:width .6s;}

/* ─── Table ─── */
.table-card{background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
table{width:100%;border-collapse:collapse;}
thead tr{background:var(--surface2);}
th{padding:12px 16px;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);font-weight:600;text-align:left;}
td{padding:13px 16px;font-size:13.5px;border-top:1px solid var(--border);}
tbody tr:hover{background:var(--surface2);}

/* ─── Badges ─── */
.badge-status{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;letter-spacing:.5px;}
.badge-active{background:rgba(74,222,128,.15);color:#4ade80;}
.badge-expired{background:rgba(255,71,87,.12);color:#ff4757;}
.badge-trial{background:rgba(245,197,24,.15);color:var(--accent);}
.badge-pending{background:rgba(79,195,247,.12);color:#4fc3f7;}

/* ─── Buttons ─── */
.btn-accent{background:var(--accent);color:#000;border:none;border-radius:8px;padding:7px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.btn-accent:hover{background:#ffd94a;transform:translateY(-1px);}
.btn-outline-accent{background:transparent;color:var(--accent);border:1px solid rgba(245,197,24,.4);border-radius:8px;padding:7px 16px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.btn-outline-accent:hover{background:rgba(245,197,24,.08);}

/* ─── Mini Metric ─── */
.mini-metric .val{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;}
.mini-metric .lbl{font-size:11px;color:var(--muted);}

/* ─── Tab Nav ─── */
.tab-nav{display:flex;gap:4px;background:var(--surface2);border-radius:8px;padding:4px;}
.tab-btn{background:none;border:none;border-radius:6px;padding:6px 14px;font-size:12px;font-weight:600;color:var(--muted);cursor:pointer;transition:all .2s;}
.tab-btn.active{background:var(--accent);color:#000;}

/* ─── Member Hero Card ─── */
.hero-card{
  background:var(--surface);border:1px solid var(--border);border-radius:16px;
  padding:28px;position:relative;overflow:hidden;
}
.hero-card::before{
  content:'';position:absolute;top:-40px;right:-40px;
  width:200px;height:200px;border-radius:50%;
  background:radial-gradient(circle,rgba(245,197,24,.12) 0%,transparent 70%);
  pointer-events:none;
}
.hero-card::after{
  content:'PUMP HOUSE';
  font-family:'Bebas Neue',sans-serif;
  font-size:80px;letter-spacing:4px;
  color:rgba(245,197,24,.04);
  position:absolute;bottom:-10px;right:10px;
  pointer-events:none;line-height:1;
}
.member-big-avatar{
  width:68px;height:68px;border-radius:50%;
  background:var(--accent);color:#000;
  font-family:'Bebas Neue',sans-serif;font-size:26px;
  display:flex;align-items:center;justify-content:center;
  border:3px solid rgba(245,197,24,.3);
  flex-shrink:0;
}
.member-name{font-family:'Bebas Neue',sans-serif;font-size:1.8rem;letter-spacing:1px;line-height:1;}
.member-plan-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(245,197,24,.12);border:1px solid rgba(245,197,24,.25);
  color:var(--accent);border-radius:20px;padding:4px 12px;
  font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
}
.expiry-pill{
  display:inline-flex;align-items:center;gap:6px;
  background:var(--surface2);border:1px solid var(--border);
  color:var(--muted);border-radius:20px;padding:4px 12px;font-size:11.5px;
}

/* ─── Circular Progress ─── */
.circle-wrap{display:flex;flex-direction:column;align-items:center;gap:6px;}
.circle{position:relative;width:80px;height:80px;}
.circle svg{transform:rotate(-90deg);}
.circle-bg{fill:none;stroke:var(--surface2);stroke-width:6;}
.circle-fill{fill:none;stroke-width:6;stroke-linecap:round;transition:stroke-dashoffset .8s ease;}
.circle-val{
  position:absolute;inset:0;display:flex;align-items:center;justify-content:center;
  font-family:'Bebas Neue',sans-serif;font-size:18px;
}
.circle-lbl{font-size:11px;color:var(--muted);text-align:center;letter-spacing:1px;text-transform:uppercase;}

/* ─── Schedule ─── */
.schedule-row{
  display:flex;align-items:center;gap:14px;
  padding:12px 0;border-bottom:1px solid var(--border);
}
.schedule-row:last-child{border-bottom:none;}
.sched-day{
  min-width:46px;height:46px;border-radius:10px;
  background:var(--surface2);border:1px solid var(--border);
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  font-size:10px;color:var(--muted);text-transform:uppercase;
  letter-spacing:1px;
}
.sched-day.today{background:rgba(245,197,24,.12);border-color:rgba(245,197,24,.3);color:var(--accent);}
.sched-day .dd{font-family:'Bebas Neue',sans-serif;font-size:18px;line-height:1;color:var(--text);}
.sched-day.today .dd{color:var(--accent);}
.sched-info .sn{font-size:13.5px;font-weight:600;}
.sched-info .st{font-size:11.5px;color:var(--muted);}
.sched-tag{
  margin-left:auto;font-size:11px;padding:3px 10px;border-radius:20px;
  background:rgba(245,197,24,.1);color:var(--accent);font-weight:600;white-space:nowrap;
}
.sched-tag.done{background:rgba(74,222,128,.1);color:#4ade80;}
.sched-tag.rest{background:var(--surface2);color:var(--muted);}

/* ─── Payment rows ─── */
.pay-row{display:flex;align-items:center;gap:12px;padding:11px 0;border-bottom:1px solid var(--border);}
.pay-row:last-child{border-bottom:none;}
.pay-icon{width:34px;height:34px;border-radius:8px;background:rgba(74,222,128,.1);color:#4ade80;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.pay-info .pn{font-size:13px;font-weight:600;}
.pay-info .pd{font-size:11px;color:var(--muted);}
.pay-amt{margin-left:auto;font-family:'Bebas Neue',sans-serif;font-size:1.2rem;color:#4ade80;}

/* ─── Announcement card ─── */
.announce-card{
  border-radius:10px;padding:14px;margin-bottom:10px;
  border-left:3px solid var(--accent);background:rgba(245,197,24,.05);
}
.announce-card.info{border-left-color:#4fc3f7;background:rgba(79,195,247,.05);}
.announce-card.alert{border-left-color:#ff4757;background:rgba(255,71,87,.05);}
.announce-title{font-size:13px;font-weight:700;margin-bottom:3px;}
.announce-text{font-size:12px;color:var(--muted);line-height:1.5;}
.announce-date{font-size:10px;color:var(--muted);margin-top:5px;letter-spacing:.5px;}

/* ─── Profile form ─── */
.form-control,.form-select{
  background:var(--surface3)!important;border:1px solid var(--border)!important;
  color:var(--text)!important;border-radius:8px!important;font-size:13px!important;
  transition:border-color .2s!important;
}
.form-control:focus,.form-select:focus{border-color:rgba(245,197,24,.5)!important;box-shadow:0 0 0 3px rgba(245,197,24,.08)!important;}
.form-label{font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);margin-bottom:5px;}
.form-control::placeholder{color:var(--muted)!important;}
::-webkit-scrollbar {
    display: none;
}

/* ─── Responsive ─── */
@media(max-width:991px){
  .sidebar{transform:translateX(-100%);}
  .sidebar.open{transform:translateX(0);}
  .main{margin-left:0;}
  .topbar-search{display:none;}
}
</style>
</head>
<body>

<!-- ── Sidebar ─────────────────────────────────────────────── -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <h1 class="pump-house">PUMP HOUSE</h1>
    <span>Member Portal</span>
  </div>

  <div class="nav-section">My Space</div>
  <a class="nav-item active" onclick="showPage('dashboard')"><i class="fa fa-gauge-high"></i> Dashboard</a>
  <a class="nav-item" onclick="showPage('attendance')"><i class="fa fa-clipboard-check"></i> My Attendance</a>
  <!-- <a class="nav-item" onclick="showPage('schedule')"><i class="fa fa-calendar-days"></i> Schedule</a> -->

  <div class="nav-section">Account</div>
  <a class="nav-item" onclick="showPage('payments')"><i class="fa fa-credit-card"></i> Payments</a>
  <!-- <a class="nav-item" onclick="showPage('membership')"><i class="fa fa-id-card"></i> My Membership</a> -->

  <div class="nav-section">More</div>
  <!-- <a class="nav-item" onclick="showPage('announcements')"><i class="fa fa-bell"></i> Announcements <span style="background:var(--accent);color:#000;font-size:9px;font-weight:700;padding:1px 6px;border-radius:10px;margin-left:4px;">3</span></a> -->
  <a class="nav-item" onclick="showPage('profile')"><i class="fa fa-user"></i> My Profile</a>

  <div class="sidebar-bottom">
    <div class="member-chip">
      <div class="member-avatar-sm">AK</div>
      <div>
        <div class="name">Alex Kim</div>
        <div class="role">Annual Member</div>
      </div>
    </div>
  </div>
</div>

<!-- ── Main ─────────────────────────────────────────────────── -->
<div class="main">
  <div class="topbar">
    <button class="icon-btn d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')">
      <i class="fa fa-bars"></i>
    </button>
    <div class="topbar-title" id="page-title">Dashboard</div>
    <div class="topbar-search">
      <i class="fa fa-magnifying-glass"></i>
      <input type="text" placeholder="Search...">
    </div>
    <div class="topbar-actions">
      <!-- <div class="icon-btn" onclick="showPage('announcements')"><i class="fa fa-bell"></i><div class="badge-dot"></div></div> -->
      <div class="icon-btn" id="themeToggle" onclick="toggleTheme()" title="Toggle Theme">
        <i class="fa fa-moon" id="themeIcon"></i>
      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       DASHBOARD
  ══════════════════════════════════════════ -->
  <div id="page-dashboard" class="content">

    <!-- Hero Member Card -->
    <div class="hero-card mb-4">
      <div style="display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
        <div class="member-big-avatar">AK</div>
        <div style="flex:1;">
          <div style="font-size:11px;letter-spacing:3px;color:var(--muted);text-transform:uppercase;margin-bottom:4px;">Welcome back</div>
          <div class="member-name">Alex Kim</div>
          <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:8px;">
            <span class="member-plan-badge"><i class="fa fa-crown" style="font-size:9px;"></i> Annual Plan</span>
            <span class="expiry-pill"><i class="fa fa-calendar" style="font-size:11px;"></i> Expires Feb 18, 2027</span>
          </div>
        </div>
        <div style="text-align:right;" class="d-none d-md-block">
          <div style="font-size:10px;letter-spacing:2px;color:var(--muted);text-transform:uppercase;margin-bottom:4px;">Member Since</div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:1.6rem;color:var(--accent);">Feb 2025</div>
          <div style="font-size:11px;color:var(--muted);">Roll #0042</div>
        </div>
      </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="stat-card c1">
          <div class="stat-icon"><i class="fa fa-fire"></i></div>
          <div class="stat-label">This Month</div>
          <div class="stat-value">22</div>
          <div class="stat-sub">Check-ins so far</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card c4">
          <div class="stat-icon"><i class="fa fa-circle-check"></i></div>
          <div class="stat-label">Attendance Rate</div>
          <div class="stat-value">88%</div>
          <div class="stat-sub"><span style="color:#4ade80;">↑ 5%</span> vs last month</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card c2">
          <div class="stat-icon"><i class="fa fa-calendar-days"></i></div>
          <div class="stat-label">Days Left</div>
          <div class="stat-value">361</div>
          <div class="stat-sub">Annual plan active</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card c3">
          <div class="stat-icon"><i class="fa fa-dollar-sign"></i></div>
          <div class="stat-label">Next Payment</div>
          <div class="stat-value">$599</div>
          <div class="stat-sub">Due Feb 18, 2027</div>
        </div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <div class="chart-card">
          <div class="section-head">
            <h2>My Attendance (Last 6 Months)</h2>
            <div class="tab-nav" style="margin:0;padding:3px;">
              <button class="tab-btn active" style="flex:none;padding:5px 12px;" onclick="switchAttTab(this,'monthly')">Monthly</button>
              <button class="tab-btn" style="flex:none;padding:5px 12px;" onclick="switchAttTab(this,'weekly')">Weekly</button>
            </div>
          </div>
          <div class="chart-bars" id="member-att-chart"></div>
          <div style="display:flex;gap:16px;margin-top:8px;padding-top:8px;border-top:1px solid var(--border);">
            <div class="mini-metric"><div class="val" style="color:var(--accent);">22</div><div class="lbl">This Month</div></div>
            <div class="mini-metric"><div class="val">19</div><div class="lbl">Last Month</div></div>
            <div class="mini-metric"><div class="val" style="color:#4ade80;">+16%</div><div class="lbl">Growth</div></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="chart-card h-100">
          <div class="section-head"><h2>Monthly Goals</h2></div>
          <div style="display:flex;justify-content:space-around;padding:10px 0 16px;">
            <div class="circle-wrap">
              <div class="circle">
                <svg width="80" height="80" viewBox="0 0 80 80">
                  <circle class="circle-bg" cx="40" cy="40" r="34"/>
                  <circle class="circle-fill" cx="40" cy="40" r="34"
                    stroke="var(--accent)"
                    stroke-dasharray="213.6"
                    stroke-dashoffset="25.6"/>
                </svg>
                <div class="circle-val" style="color:var(--accent);">88%</div>
              </div>
              <div class="circle-lbl">Attendance</div>
            </div>
            <div class="circle-wrap">
              <div class="circle">
                <svg width="80" height="80" viewBox="0 0 80 80">
                  <circle class="circle-bg" cx="40" cy="40" r="34"/>
                  <circle class="circle-fill" cx="40" cy="40" r="34"
                    stroke="#4ade80"
                    stroke-dasharray="213.6"
                    stroke-dashoffset="64"/>
                </svg>
                <div class="circle-val" style="color:#4ade80;">70%</div>
              </div>
              <div class="circle-lbl">Workouts</div>
            </div>
            <div class="circle-wrap">
              <div class="circle">
                <svg width="80" height="80" viewBox="0 0 80 80">
                  <circle class="circle-bg" cx="40" cy="40" r="34"/>
                  <circle class="circle-fill" cx="40" cy="40" r="34"
                    stroke="#4fc3f7"
                    stroke-dasharray="213.6"
                    stroke-dashoffset="106.8"/>
                </svg>
                <div class="circle-val" style="color:#4fc3f7;">50%</div>
              </div>
              <div class="circle-lbl">Cardio</div>
            </div>
          </div>
          <div class="prog-row"><div class="prog-label"><span>Check-in Goal</span><span>22/25</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:88%;background:var(--accent);"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Workout Goal</span><span>14/20</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:70%;background:#4ade80;"></div></div></div>
        </div>
      </div>
    </div>

    <!-- Schedule + Recent Payments -->
    <div class="row g-3">
      <div class="col-lg-7">
        <div class="section-head"><h2>This Week's Schedule</h2><button class="btn-outline-accent" onclick="showPage('schedule')">Full Schedule</button></div>
        <div class="chart-card" id="dash-schedule"></div>
      </div>
      <div class="col-lg-5">
        <div class="section-head"><h2>Recent Payments</h2><button class="btn-outline-accent" onclick="showPage('payments')">View All</button></div>
        <div class="chart-card">
          <div class="pay-row"><div class="pay-icon"><i class="fa fa-check"></i></div><div class="pay-info"><div class="pn">Annual Plan</div><div class="pd">Feb 18, 2026</div></div><div class="pay-amt">$599</div></div>
          <div class="pay-row"><div class="pay-icon"><i class="fa fa-check"></i></div><div class="pay-info"><div class="pn">Annual Plan</div><div class="pd">Feb 18, 2025</div></div><div class="pay-amt">$599</div></div>
          <div class="pay-row" style="border:none;"><div class="pay-icon" style="background:rgba(245,197,24,.1);color:var(--accent);"><i class="fa fa-clock"></i></div><div class="pay-info"><div class="pn">Annual Plan</div><div class="pd">Due Feb 18, 2027</div></div><div class="pay-amt" style="color:var(--accent);">$599</div></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       MY ATTENDANCE
  ══════════════════════════════════════════ -->
  <div id="page-attendance" class="content" style="display:none;">
    <div class="section-head mb-4">
      <div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">My Attendance</h2>
        <div style="font-size:.8rem;color:var(--muted);">February 2026</div>
      </div>
      <div style="display:flex;gap:8px;">
        <input type="month" class="form-control form-control-sm" value="2026-02" style="width:160px;">
        <button class="btn-accent"><i class="fa fa-download me-1"></i>Export</button>
      </div>
    </div>

    <!-- Stats -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3"><div class="stat-card c1"><div class="stat-icon"><i class="fa fa-calendar"></i></div><div class="stat-label">Working Days</div><div class="stat-value">25</div></div></div>
      <div class="col-6 col-md-3"><div class="stat-card c4"><div class="stat-icon"><i class="fa fa-circle-check"></i></div><div class="stat-label">Present</div><div class="stat-value">22</div></div></div>
      <div class="col-6 col-md-3"><div class="stat-card c3"><div class="stat-icon"><i class="fa fa-circle-xmark"></i></div><div class="stat-label">Absent</div><div class="stat-value">3</div></div></div>
      <div class="col-6 col-md-3"><div class="stat-card" style="background:linear-gradient(135deg,rgba(167,139,250,.12),rgba(167,139,250,.04));border-color:rgba(167,139,250,.2);"><div class="stat-icon" style="background:rgba(167,139,250,.15);color:#a78bfa;"><i class="fa fa-percent"></i></div><div class="stat-label">Rate</div><div class="stat-value" style="color:#a78bfa;">88%</div></div></div>
    </div>

    <!-- Monthly attendance grid -->
    <div class="chart-card mb-4">
      <div class="section-head"><h2>February 2026 — Attendance Calendar</h2></div>
      <div id="att-calendar" style="display:grid;grid-template-columns:repeat(7,1fr);gap:6px;"></div>
      <div style="display:flex;gap:16px;margin-top:16px;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);"><div style="width:12px;height:12px;border-radius:3px;background:rgba(74,222,128,.3);"></div>Present</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);"><div style="width:12px;height:12px;border-radius:3px;background:rgba(255,71,87,.25);"></div>Absent</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);"><div style="width:12px;height:12px;border-radius:3px;background:var(--surface2);"></div>No Session</div>
      </div>
    </div>

    <!-- Attendance log table -->
    <div class="section-head mb-3"><h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:1px;">Attendance Log</h2></div>
    <div class="table-card">
      <table><thead><tr><th>Date</th><th>Day</th><th>Check-in Time</th><th>Check-out Time</th><th>Duration</th><th>Status</th></tr></thead>
      <tbody id="att-log-body"></tbody></table>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       SCHEDULE
  ══════════════════════════════════════════ -->
  <!-- <div id="page-schedule" class="content" style="display:none;">
    <div class="section-head mb-4">
      <div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">My Schedule</h2>
        <div style="font-size:.8rem;color:var(--muted);">Week of Feb 17 – Feb 23, 2026</div>
      </div>
      <button class="btn-accent"><i class="fa fa-plus me-1"></i>Log Workout</button>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-8">
        <div class="chart-card">
          <div class="section-head"><h2>This Week</h2></div>
          <div id="full-schedule"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="chart-card">
          <div class="section-head"><h2>Weekly Summary</h2></div>
          <div class="prog-row"><div class="prog-label"><span>Strength</span><span>3 sessions</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:75%;background:var(--accent);"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Cardio</span><span>2 sessions</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:50%;background:#4fc3f7;"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Rest Days</span><span>2 days</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:28%;background:#a78bfa;"></div></div></div>
          <div style="margin-top:20px;padding:16px;background:var(--surface2);border-radius:10px;text-align:center;">
            <div style="font-family:'Bebas Neue',sans-serif;font-size:2.5rem;color:var(--accent);">5</div>
            <div style="font-size:11px;letter-spacing:2px;color:var(--muted);text-transform:uppercase;">Sessions This Week</div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- ══════════════════════════════════════════
       PAYMENTS
  ══════════════════════════════════════════ -->
  <div id="page-payments" class="content" style="display:none;">
    <div class="section-head mb-4">
      <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">My Payments</h2>
      <!-- <button class="btn-outline-accent"><i class="fa fa-download me-1"></i>Download Receipt</button> -->
    </div>
    <!-- <div class="row g-3 mb-4">
      <div class="col-md-4"><div class="stat-card c1"><div class="stat-icon"><i class="fa fa-dollar-sign"></i></div><div class="stat-label">Total Paid</div><div class="stat-value">$1,198</div><div class="stat-sub">Lifetime payments</div></div></div>
      <div class="col-md-4"><div class="stat-card c4"><div class="stat-icon"><i class="fa fa-circle-check"></i></div><div class="stat-label">Status</div><div class="stat-value">Clear</div><div class="stat-sub">No dues pending</div></div></div>
      <div class="col-md-4"><div class="stat-card c2"><div class="stat-icon"><i class="fa fa-clock"></i></div><div class="stat-label">Next Due</div><div class="stat-value">Feb '27</div><div class="stat-sub">$599 annual renewal</div></div></div>
    </div> -->
    <div class="table-card">
      <table><thead><tr><th>Invoice</th><th>Plan</th><th>Amount</th><th>Date</th><th>Method</th><th>Status</th></tr></thead>
      <tbody>
        <tr><td style="color:var(--muted);font-size:.85rem;">#INV-0042</td><td>Annual Plan</td><td style="color:#4ade80;font-weight:600;">$599</td><td>Feb 18, 2026</td><td>Card</td><td><span class="badge-status badge-active">Paid</span></td></tr>
        <tr><td style="color:var(--muted);font-size:.85rem;">#INV-0021</td><td>Annual Plan</td><td style="color:#4ade80;font-weight:600;">$599</td><td>Feb 18, 2025</td><td>Card</td><td><span class="badge-status badge-active">Paid</span></td></tr>
        <tr><td style="color:var(--muted);font-size:.85rem;">#INV-0060</td><td>Annual Plan</td><td style="color:var(--accent);font-weight:600;">$599</td><td>Feb 18, 2027</td><td>—</td><td><span class="badge-status badge-pending">Upcoming</span></td></tr>
      </tbody></table>
    </div>
  </div>

  <!-- ══════════════════════════════════════════
       MY MEMBERSHIP
  ══════════════════════════════════════════ -->
  <!-- <div id="page-membership" class="content" style="display:none;">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;margin-bottom:24px;">My Membership</h2>
    <div class="row g-4">
      <!-- Current plan -->
      <!-- <div class="col-md-5">
        <div class="chart-card" style="border:2px solid var(--accent);position:relative;">
          <div style="position:absolute;top:-12px;left:20px;background:var(--accent);color:#000;font-size:.65rem;font-weight:700;padding:3px 12px;border-radius:20px;letter-spacing:1px;">CURRENT PLAN</div>
          <div style="text-align:center;padding:20px 0;">
            <div style="font-size:.8rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">Annual</div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:4rem;color:var(--accent);line-height:1;">$599<span style="font-size:1.2rem;">/yr</span></div>
            <div style="font-size:.78rem;color:var(--muted);margin-bottom:20px;">Save 30% vs monthly</div>
            <div style="text-align:left;max-width:220px;margin:0 auto;">
              <div style="font-size:.85rem;margin-bottom:10px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited gym access</div>
              <div style="font-size:.85rem;margin-bottom:10px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>All classes included</div>
              <div style="font-size:.85rem;margin-bottom:10px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Unlimited PT sessions</div>
              <div style="font-size:.85rem;margin-bottom:10px;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Locker access</div>
              <div style="font-size:.85rem;"><i class="fa fa-check me-2" style="color:#4ade80;"></i>Priority booking</div>
            </div>
          </div>
          <div style="border-top:1px solid var(--border);padding-top:14px;margin-top:10px;display:flex;justify-content:space-between;align-items:center;">
            <div><div style="font-size:11px;color:var(--muted);">Expires</div><div style="font-weight:600;">Feb 18, 2027</div></div>
            <span class="badge-status badge-active">Active</span>
          </div>
        </div>
      </div> -->
      <!-- Upgrade options -->
      <!-- <div class="col-md-7">
        <div class="chart-card">
          <div class="section-head"><h2>Membership Benefits</h2></div>
          <div class="prog-row"><div class="prog-label"><span>Check-ins Used</span><span>22 / Unlimited</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:100%;background:var(--accent);"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>PT Sessions Used</span><span>3 / Unlimited</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:30%;background:#4ade80;"></div></div></div>
          <div class="prog-row"><div class="prog-label"><span>Classes Attended</span><span>8 / Unlimited</span></div><div class="prog-bar-bg"><div class="prog-bar-fill" style="width:100%;background:#4fc3f7;"></div></div></div>

          <div style="background:var(--surface2);border-radius:10px;padding:16px;margin-top:10px;">
            <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:10px;">Membership Timeline</div>
            <div style="display:flex;align-items:center;gap:0;margin-bottom:6px;">
              <div style="width:10px;height:10px;border-radius:50%;background:var(--accent);flex-shrink:0;"></div>
              <div style="flex:1;height:2px;background:linear-gradient(90deg,var(--accent),rgba(245,197,24,.2));"></div>
              <div style="width:10px;height:10px;border-radius:50%;background:var(--surface3);border:2px solid var(--border);flex-shrink:0;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;">
              <div style="font-size:11px;color:var(--muted);">Started<br><span style="color:var(--text);font-weight:600;">Feb 18, 2026</span></div>
              <div style="font-size:11px;color:var(--muted);text-align:right;">Renews<br><span style="color:var(--text);font-weight:600;">Feb 18, 2027</span></div>
            </div>
          </div>
          <button class="btn-accent w-100 mt-3">Renew Membership</button>
        </div>
      </div> -->
    </div>
  <!-- </div> --> 

  <!-- ══════════════════════════════════════════
       ANNOUNCEMENTS
  ══════════════════════════════════════════ -->
  <!-- <div id="page-announcements" class="content" style="display:none;">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;margin-bottom:24px;">Announcements</h2>
    <div class="row g-3">
      <div class="col-md-8">
        <div class="announce-card">
          <div class="announce-title">🏋️ New Equipment Arrived!</div>
          <div class="announce-text">We've added 6 new Olympic barbells and 10 new cable machines to the gym floor. These are now available in Zone B. Come check them out!</div>
          <div class="announce-date">FEB 20, 2026</div>
        </div>
        <div class="announce-card info">
          <div class="announce-title">🕐 Updated Timings – Ramadan Schedule</div>
          <div class="announce-text">Starting March 1st, gym hours will be adjusted to 8AM–2PM and 8PM–12AM. Regular timings resume after Eid. Please plan your sessions accordingly.</div>
          <div class="announce-date">FEB 18, 2026</div>
        </div>
        <div class="announce-card alert">
          <div class="announce-title">⚠️ Maintenance – Sauna Closed</div>
          <div class="announce-text">The sauna area will be closed for maintenance from Feb 22–25. We apologize for the inconvenience. All other facilities remain fully operational.</div>
          <div class="announce-date">FEB 15, 2026</div>
        </div>
        <div class="announce-card">
          <div class="announce-title">🏆 Member of the Month – January</div>
          <div class="announce-text">Congratulations to Leo Chen for achieving the highest check-in count in January with 28 sessions! Keep up the amazing work.</div>
          <div class="announce-date">FEB 01, 2026</div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="chart-card">
          <div class="section-head"><h2>Gym Hours</h2></div>
          <div style="font-size:13px;">
            <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border);"><span style="color:var(--muted);">Mon – Fri</span><span style="font-weight:600;">5:00 AM – 10:00 PM</span></div>
            <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border);"><span style="color:var(--muted);">Saturday</span><span style="font-weight:600;">7:00 AM – 8:00 PM</span></div>
            <div style="display:flex;justify-content:space-between;padding:8px 0;"><span style="color:var(--muted);">Sunday</span><span style="font-weight:600;">8:00 AM – 6:00 PM</span></div>
          </div>
          <div style="margin-top:16px;padding:12px;background:rgba(74,222,128,.07);border:1px solid rgba(74,222,128,.2);border-radius:8px;">
            <div style="font-size:11px;font-weight:700;color:#4ade80;margin-bottom:4px;">GYM IS OPEN NOW</div>
            <div style="font-size:12px;color:var(--muted);">Closes at 10:00 PM today</div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- ══════════════════════════════════════════
       MY PROFILE
  ══════════════════════════════════════════ -->
  <div id="page-profile" class="content" style="display:none;">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;margin-bottom:24px;">My Profile</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="chart-card" style="text-align:center;">
          <div style="width:90px;height:90px;border-radius:50%;background:var(--accent);color:#000;font-family:'Bebas Neue',sans-serif;font-size:32px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:3px solid rgba(245,197,24,.3);">AK</div>
          <div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:1px;">Alex Kim</div>
          <div style="font-size:12px;color:var(--muted);margin-top:4px;">Roll #0042</div>
          <span class="member-plan-badge" style="margin-top:10px;display:inline-flex;"><i class="fa fa-crown" style="font-size:9px;"></i> Annual Member</span>
          <div style="margin-top:20px;display:flex;justify-content:space-around;">
            <div style="text-align:center;"><div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--accent);">22</div><div style="font-size:10px;color:var(--muted);letter-spacing:1px;text-transform:uppercase;">Check-ins</div></div>
            <div style="text-align:center;"><div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--accent);">88%</div><div style="font-size:10px;color:var(--muted);letter-spacing:1px;text-transform:uppercase;">Rate</div></div>
            <div style="text-align:center;"><div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--accent);">1yr</div><div style="font-size:10px;color:var(--muted);letter-spacing:1px;text-transform:uppercase;">Member</div></div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="chart-card">
          <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:1px;margin-bottom:20px;">Personal Information</h2>
          <div class="row g-3">
            <div class="col-6"><label class="form-label">First Name</label><input type="text" class="form-control" value="Alex"></div>
            <div class="col-6"><label class="form-label">Last Name</label><input type="text" class="form-control" value="Kim"></div>
            <div class="col-12"><label class="form-label">Email</label><input type="email" class="form-control" value="alex@email.com"></div>
            <div class="col-6"><label class="form-label">Phone</label><input type="text" class="form-control" value="+92 300 1234567"></div>
            <div class="col-6"><label class="form-label">Gender</label><select class="form-select"><option selected>Male</option><option>Female</option><option>Other</option></select></div>
            <div class="col-12"><label class="form-label">Address</label><input type="text" class="form-control" value="123 Street, Rawalpindi"></div>
          </div>
          <button class="btn-accent mt-3">Save Changes</button>
        </div>
        <div class="chart-card mt-3">
          <h2 style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:1px;margin-bottom:20px;">Change Password</h2>
          <div class="row g-3">
            <div class="col-12"><label class="form-label">Current Password</label><input type="password" class="form-control" placeholder="••••••••"></div>
            <div class="col-6"><label class="form-label">New Password</label><input type="password" class="form-control" placeholder="••••••••"></div>
            <div class="col-6"><label class="form-label">Confirm Password</label><input type="password" class="form-control" placeholder="••••••••"></div>
          </div>
          <button class="btn-outline-accent mt-3">Update Password</button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
/* ══════════════════════════════════════════
   DATA
══════════════════════════════════════════ */
const scheduleData = [
  { day:'Mon', date:17, type:'Strength',  time:'6:00 AM', tag:'done',   tagLabel:'Done' },
  { day:'Tue', date:18, type:'Cardio',    time:'7:00 AM', tag:'done',   tagLabel:'Done' },
  { day:'Wed', date:19, type:'Rest Day',  time:'—',       tag:'rest',   tagLabel:'Rest' },
  { day:'Thu', date:20, type:'Strength',  time:'6:00 AM', tag:'done',   tagLabel:'Done' },
  { day:'Fri', date:21, type:'HIIT',      time:'6:30 AM', tag:'today',  tagLabel:'Today' },
  { day:'Sat', date:22, type:'Strength',  time:'8:00 AM', tag:'',       tagLabel:'Upcoming' },
  { day:'Sun', date:23, type:'Rest Day',  time:'—',       tag:'rest',   tagLabel:'Rest' },
];

const attLog = [
  { date:'Feb 21', day:'Friday',    cin:'6:34 AM', cout:'8:10 AM', dur:'1h 36m', status:'present' },
  { date:'Feb 20', day:'Thursday',  cin:'6:28 AM', cout:'8:05 AM', dur:'1h 37m', status:'present' },
  { date:'Feb 19', day:'Wednesday', cin:'—',       cout:'—',       dur:'—',      status:'absent'  },
  { date:'Feb 18', day:'Tuesday',   cin:'7:02 AM', cout:'8:30 AM', dur:'1h 28m', status:'present' },
  { date:'Feb 17', day:'Monday',    cin:'6:15 AM', cout:'7:58 AM', dur:'1h 43m', status:'present' },
  { date:'Feb 15', day:'Saturday',  cin:'8:10 AM', cout:'9:45 AM', dur:'1h 35m', status:'present' },
  { date:'Feb 13', day:'Thursday',  cin:'6:40 AM', cout:'8:00 AM', dur:'1h 20m', status:'present' },
  { date:'Feb 12', day:'Wednesday', cin:'—',       cout:'—',       dur:'—',      status:'absent'  },
  { date:'Feb 10', day:'Monday',    cin:'6:20 AM', cout:'7:55 AM', dur:'1h 35m', status:'present' },
];

/* ══════════════════════════════════════════
   PAGE NAVIGATION
══════════════════════════════════════════ */
function showPage(page) {
  document.querySelectorAll('.content').forEach(c => c.style.display = 'none');
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));

  const el = document.getElementById('page-' + page);
  if (el) { el.style.display = 'block'; el.style.animation = 'none'; void el.offsetWidth; el.style.animation = ''; }

  document.querySelectorAll('.nav-item').forEach(n => {
    if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + page + "'")) n.classList.add('active');
  });

  const titles = {
    dashboard:'Dashboard', attendance:'My Attendance', schedule:'Schedule',
    payments:'My Payments', membership:'My Membership', announcements:'Announcements', profile:'My Profile'
  };
  document.getElementById('page-title').textContent = titles[page] || page;

  if (page === 'dashboard')   { buildDashCharts(); buildDashSchedule(); }
  if (page === 'attendance')  { buildAttCalendar(); buildAttLog(); }
  if (page === 'schedule')    { buildFullSchedule(); }

  document.getElementById('sidebar').classList.remove('open');
}

/* ══════════════════════════════════════════
   THEME
══════════════════════════════════════════ */
function toggleTheme() {
  document.body.classList.toggle('light');
  document.getElementById('themeIcon').className =
    document.body.classList.contains('light') ? 'fa fa-sun' : 'fa fa-moon';
}

/* ══════════════════════════════════════════
   BAR CHART
══════════════════════════════════════════ */
function buildBar(id, data, color) {
  const el = document.getElementById(id);
  if (!el) return;
  const max = Math.max(...data.map(d => d.v));
  el.innerHTML = data.map(d => `
    <div class="bar-wrap">
      <div class="bar" style="height:${Math.round((d.v/max)*100)}%;background:${color||'var(--accent)'};"></div>
      <div class="bar-label">${d.l}</div>
    </div>`).join('');
}

let attTabMode = 'monthly';
function buildDashCharts() {
  const monthly = [{l:'Sep',v:16},{l:'Oct',v:18},{l:'Nov',v:14},{l:'Dec',v:20},{l:'Jan',v:19},{l:'Feb',v:22}];
  const weekly  = [{l:'Mon',v:1},{l:'Tue',v:1},{l:'Wed',v:0},{l:'Thu',v:1},{l:'Fri',v:1},{l:'Sat',v:1},{l:'Sun',v:0}];
  buildBar('member-att-chart', attTabMode === 'monthly' ? monthly : weekly);
}
function switchAttTab(btn, mode) {
  document.querySelectorAll('.tab-nav .tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  attTabMode = mode;
  buildDashCharts();
}

/* ══════════════════════════════════════════
   DASHBOARD SCHEDULE (mini)
══════════════════════════════════════════ */
function buildDashSchedule() {
  const el = document.getElementById('dash-schedule');
  if (!el) return;
  el.innerHTML = scheduleData.map(s => `
    <div class="schedule-row">
      <div class="sched-day ${s.tag==='today'?'today':''}">
        <div>${s.day}</div>
        <div class="dd">${s.date}</div>
      </div>
      <div class="sched-info">
        <div class="sn">${s.type}</div>
        <div class="st">${s.time}</div>
      </div>
      <span class="sched-tag ${s.tag}">${s.tagLabel}</span>
    </div>`).join('');
}

/* ══════════════════════════════════════════
   FULL SCHEDULE PAGE
══════════════════════════════════════════ */
function buildFullSchedule() {
  const el = document.getElementById('full-schedule');
  if (!el) return;
  el.innerHTML = scheduleData.map(s => `
    <div class="schedule-row">
      <div class="sched-day ${s.tag==='today'?'today':''}">
        <div>${s.day}</div>
        <div class="dd">${s.date}</div>
      </div>
      <div class="sched-info" style="flex:1;">
        <div class="sn">${s.type}</div>
        <div class="st">${s.time !== '—' ? '<i class="fa fa-clock" style="font-size:10px;"></i> ' + s.time : 'Rest Day'}</div>
      </div>
      <span class="sched-tag ${s.tag}">${s.tagLabel}</span>
    </div>`).join('');
}

/* ══════════════════════════════════════════
   ATTENDANCE CALENDAR
══════════════════════════════════════════ */
function buildAttCalendar() {
  const el = document.getElementById('att-calendar');
  if (!el) return;

  // Feb 2026 starts on Sunday
  const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  // Day headers
  let html = days.map(d => `<div style="text-align:center;font-size:10px;letter-spacing:1px;color:var(--muted);padding:4px 0;">${d}</div>`).join('');

  // Feb 1 2026 = Sunday (0)
  const present = [2,3,4,6,9,10,11,13,16,17,18,20,23,24,25,27];
  const absent  = [5,12,19,26];

  for (let d = 1; d <= 28; d++) {
    const isPresent = present.includes(d);
    const isAbsent  = absent.includes(d);
    const isToday   = d === 22;
    let bg = 'var(--surface2)'; let color = 'var(--muted)'; let border = 'var(--border)';
    if (isPresent) { bg='rgba(74,222,128,.18)'; color='#4ade80'; border='rgba(74,222,128,.3)'; }
    if (isAbsent)  { bg='rgba(255,71,87,.15)'; color='#ff4757'; border='rgba(255,71,87,.25)'; }
    if (isToday)   { border='var(--accent)'; }
    html += `<div style="
      aspect-ratio:1;display:flex;flex-direction:column;align-items:center;justify-content:center;
      border-radius:8px;background:${bg};border:1px solid ${border};color:${color};
      font-size:13px;font-weight:600;position:relative;cursor:default;
    ">
      ${d}
      ${isPresent ? '<i class="fa fa-check" style="font-size:8px;position:absolute;bottom:4px;"></i>' : ''}
      ${isAbsent  ? '<i class="fa fa-xmark" style="font-size:8px;position:absolute;bottom:4px;"></i>' : ''}
      ${isToday   ? '<div style="position:absolute;top:3px;right:4px;width:5px;height:5px;border-radius:50%;background:var(--accent);"></div>' : ''}
    </div>`;
  }
  el.innerHTML = html;
}

/* ══════════════════════════════════════════
   ATTENDANCE LOG TABLE
══════════════════════════════════════════ */
function buildAttLog() {
  const tbody = document.getElementById('att-log-body');
  if (!tbody) return;
  tbody.innerHTML = attLog.map(r => `
    <tr>
      <td style="font-weight:600;">${r.date}</td>
      <td style="color:var(--muted);">${r.day}</td>
      <td>${r.cin}</td>
      <td>${r.cout}</td>
      <td style="font-weight:600;color:var(--accent);">${r.dur}</td>
      <td><span class="badge-status ${r.status==='present'?'badge-active':'badge-expired'}">${r.status==='present'?'Present':'Absent'}</span></td>
    </tr>`).join('');
}

/* ══════════════════════════════════════════
   INIT
══════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  buildDashCharts();
  buildDashSchedule();
});
</script>
</body>
</html>