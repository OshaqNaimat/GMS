<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "./Bootstrap.php"?>
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
<script src="./script.js"></script>

</body>
</html> 