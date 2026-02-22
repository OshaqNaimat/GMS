<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pump House – Gym Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --gold: #F5C518;
      --gold-light: #FFD94A;
      --gold-dark: #C9A012;
      --black: #0A0A0A;
      --dark: #111111;
      --dark2: #1A1A1A;
      --dark3: #222222;
      --gray: #888;
      --text: #E8E8E8;
      --tab-inactive: #444;
      --label-color: #666;
      --link-color: #555;
      --or-color: #333;
      --stat-label-color: #555;
      --brand-desc-color: #888;
      --grid-color: rgba(245,197,24,0.04);
      --glow1: rgba(245,197,24,0.10);
      --glow2: rgba(245,197,24,0.06);
      --input-border: rgba(255,255,255,0.08);
      --input-placeholder: #444;
      --or-line: rgba(255,255,255,0.06);
    }

    /* ─── Light Theme ─── */
    body.light-theme {
      --black: #F0F0F0;
      --dark: #E5E5E5;
      --dark2: #FFFFFF;
      --dark3: #F5F5F5;
      --text: #1A1A1A;
      --gray: #555;
      --tab-inactive: #999;
      --label-color: #888;
      --link-color: #777;
      --or-color: #aaa;
      --stat-label-color: #888;
      --brand-desc-color: #555;
      --grid-color: rgba(245,197,24,0.06);
      --glow1: rgba(245,197,24,0.15);
      --glow2: rgba(245,197,24,0.08);
      --input-border: rgba(0,0,0,0.12);
      --input-placeholder: #bbb;
      --or-line: rgba(0,0,0,0.08);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Barlow', sans-serif;
      background-color: var(--black);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
      transition: background-color 0.4s, color 0.4s;
    }

    /* ─── Theme Toggle ─── */
    .theme-toggle {
      position: fixed;
      top: 20px; right: 24px;
      z-index: 100;
      background: var(--dark2);
      border: 1px solid rgba(245,197,24,0.25);
      border-radius: 50px;
      width: 52px; height: 28px;
      cursor: pointer;
      display: flex; align-items: center;
      padding: 3px;
      transition: background 0.3s, border-color 0.3s;
      box-shadow: 0 2px 12px rgba(0,0,0,0.3);
    }
    .theme-toggle:hover {
      border-color: var(--gold);
      box-shadow: 0 2px 16px rgba(245,197,24,0.2);
    }
    .toggle-knob {
      width: 22px; height: 22px;
      border-radius: 50%;
      background: var(--gold);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px;
      transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), background 0.3s;
      transform: translateX(0);
      box-shadow: 0 1px 6px rgba(0,0,0,0.3);
    }
    body.light-theme .toggle-knob {
      transform: translateX(24px);
    }

    /* brand-name light */
    body.light-theme .brand-name { color: var(--dark); }
    body.light-theme .brand-name span { color: var(--gold-dark); }
    body.light-theme .tab-bar { border-bottom-color: rgba(0,0,0,0.1); }

    /* ─── Background ─── */
    .bg-wrapper {
      position: fixed; inset: 0; z-index: 0;
      background:
        radial-gradient(ellipse 60% 50% at 80% 20%, var(--glow1) 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 10% 80%, var(--glow2) 0%, transparent 50%),
        var(--black);
      transition: background 0.4s;
    }

    .bg-grid {
      position: fixed; inset: 0; z-index: 0;
      background-image:
        linear-gradient(var(--grid-color) 1px, transparent 1px),
        linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
      background-size: 50px 50px;
    }

    /* ─── Left Branding Panel ─── */
    .brand-panel {
      position: relative; z-index: 1;
      display: flex; flex-direction: column; justify-content: center; align-items: flex-start;
      padding:  50px;
      min-height: 110vh;
    }

    .brand-tag {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 11px;
      letter-spacing: 5px;
      color: var(--gold);
      margin-bottom: 20px;
      display: flex; align-items: center; gap: 12px;
    }
    .brand-tag::before {
      content: ''; display: block;
      width: 30px; height: 1px; background: var(--gold);
    }

    .brand-name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(72px, 8vw, 110px);
      line-height: 0.88;
      color: #fff;
      letter-spacing: 2px;  
    }
    .brand-name span {
      color: var(--gold);
      display: block;
    }

    .brand-sub {
      font-size: 13px;
      letter-spacing: 4px;
      color: var(--gray);
      margin-top: 18px;
      text-transform: uppercase;
    }

    .brand-divider {
      width: 60px; height: 3px;
      background: linear-gradient(90deg, var(--gold), transparent);
      margin: 35px 0;
    }

    .brand-desc {
      font-size: 15px;
      color: var(--brand-desc-color);
      line-height: 1.7;
      max-width: 380px;
      font-weight: 300;
    }

    .stat-row {
      display: flex; gap: 40px; margin-top: 50px;
    }
    .stat { text-align: left; }
    .stat-num {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 42px;
      color: var(--gold);
      line-height: 1;
    }
    .stat-label {
      font-size: 11px;
      letter-spacing: 2px;
      color: var(--stat-label-color);
      text-transform: uppercase;
    }

    /* barbell decoration */
    .barbell {
      position: absolute;
      bottom: 40px; left: 50px;
      display: flex; align-items: center; gap: 0; opacity: 0.07;
    }
    .bb-plate { width: 12px; height: 42px; background: var(--gold); border-radius: 2px; }
    .bb-plate.lg { height: 58px; width: 14px; }
    .bb-bar { width: 100px; height: 6px; background: var(--gold); }

    /* ─── Auth Panel ─── */
    .auth-panel {
      position: relative; z-index: 1;
      display: flex; align-items: center; justify-content: center;
      min-height: 100vh;
      padding: 40px 20px;
    }

    .auth-card {
      background: var(--dark2);
      border: 1px solid rgba(245,197,24,0.15);
      border-radius: 4px;
      padding: 48px 44px;
      width: 100%;
      max-width: 460px;
      box-shadow: 0 0 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(245,197,24,0.05);
      position: relative;
      overflow: hidden;
      transition: background 0.4s, box-shadow 0.4s;
    }

    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    /* ─── Tabs ─── */
    .tab-bar {
      display: flex; gap: 0;
      border-bottom: 1px solid rgba(255,255,255,0.07);
      margin-bottom: 36px;
    }

    .tab-btn {
      background: none; border: none;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 18px;
      letter-spacing: 2px;
      color: var(--tab-inactive);
      padding: 0 0 14px;
      margin-right: 28px;
      cursor: pointer;
      position: relative;
      transition: color 0.25s;
    }
    .tab-btn.active {
      color: var(--gold);
    }
    .tab-btn.active::after {
      content: '';
      position: absolute;
      bottom: -1px; left: 0; right: 0;
      height: 2px;
      background: var(--gold);
    }

    /* ─── Forms ─── */
    .form-section { display: none; }
    .form-section.active { display: block; }

    .form-group { margin-bottom: 20px; }

    .form-label {
      display: block;
      font-size: 11px;
      letter-spacing: 2px;
      color: var(--label-color);
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .form-control, .form-select {
      background: var(--dark3) !important;
      border: 1px solid var(--input-border) !important;
      border-radius: 3px !important;
      color: var(--text) !important;
      font-family: 'Barlow', sans-serif !important;
      font-size: 14px !important;
      padding: 12px 16px !important;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.3s !important;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--gold) !important;
      box-shadow: 0 0 0 3px rgba(245,197,24,0.1) !important;
      outline: none !important;
    }
    .form-control::placeholder { color: var(--input-placeholder) !important; }

    .form-select option {
      background: var(--dark3);
      color: var(--text);
    }

    /* input icon wrapper */
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .icon {
      position: absolute;
      left: 14px; top: 50%; transform: translateY(-50%);
      color: #444; font-size: 15px; pointer-events: none;
    }
    .input-icon-wrap .form-control,
    .input-icon-wrap .form-select {
      padding-left: 42px !important;
    }

    /* role badge select */
    .role-select-wrap {
      position: relative;
    }
    .role-badge {
      position: absolute;
      right: 14px; top: 50%; transform: translateY(-50%);
      font-size: 10px;
      letter-spacing: 1.5px;
      color: var(--gold);
      pointer-events: none;
      font-weight: 600;
    }

    /* ─── Forgot / link ─── */
    .form-link {
      font-size: 12px;
      color: var(--link-color);
      text-decoration: none;
      transition: color 0.2s;
    }
    .form-link:hover { color: var(--gold); }

    .form-check-input {
      background-color: var(--dark3) !important;
      border-color: var(--input-border) !important;
    }
    .form-check-input:checked {
      background-color: var(--gold) !important;
      border-color: var(--gold) !important;
    }
    .form-check-label { font-size: 13px; color: var(--label-color); }

    /* ─── CTA Button ─── */
    .btn-pump {
      display: block; width: 100%;
      background: var(--gold);
      color: var(--black);
      border: none;
      border-radius: 3px;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 18px;
      letter-spacing: 3px;
      padding: 14px;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
      margin-top: 28px;
    }
    .btn-pump:hover {
      background: var(--gold-light);
      transform: translateY(-1px);
      box-shadow: 0 8px 25px rgba(245,197,24,0.25);
    }
    .btn-pump:active { transform: translateY(0); }

    /* ─── Divider ─── */
    .or-divider {
      display: flex; align-items: center; gap: 14px;
      margin: 24px 0 0;
      font-size: 11px;
      letter-spacing: 2px;
      color: var(--or-color);
    }
    .or-divider::before, .or-divider::after {
      content: ''; flex: 1; height: 1px; background: var(--or-line);
    }

    /* ─── Responsive ─── */
    @media (max-width: 768px) {
      .brand-panel { min-height: auto; padding: 40px 28px 20px; }
      .stat-row { gap: 24px; }
      .auth-card { padding: 36px 28px; }
    }

    /* ─── Animations ─── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .auth-card { animation: fadeUp 0.5s ease both; }
    .brand-name { animation: fadeUp 0.5s 0.1s ease both; }
    .brand-desc { animation: fadeUp 0.5s 0.2s ease both; }
    .stat-row   { animation: fadeUp 0.5s 0.3s ease both; }
  </style>
</head>
<body>

<div class="bg-wrapper"></div>
<div class="bg-grid"></div>

<!-- Theme Toggle -->
<button class="theme-toggle" onclick="toggleTheme()" title="Switch Theme" aria-label="Toggle theme">
  <div class="toggle-knob" id="themeKnob">🌙</div>
</button>

<div class="container-fluid px-0" style="min-height:100vh;">
  <div class="row g-0" style="min-height:100vh;">

    <!-- ── Left Brand Panel ── -->
    <div class="col-xl-6 col-lg-4 col-md-3 d-none d-xl-flex d-lg-flex d-md-flex align-items-center">
      <div class="brand-panel">
        <!-- <div class="brand-tag">Est. 2020 &nbsp;·&nbsp; Elite Fitness</div> -->

        <div class="brand-name m-0 p-0">
          Pump<span>House</span>
        </div>
        <div class="brand-sub">Gym Management System</div>

        <div class="brand-divider"></div>

        <p class="brand-desc">
          Your all-in-one platform for managing memberships, tracking workouts,
          scheduling sessions, and running your gym like a machine.
        </p>

        <!-- <div class="stat-row">
          <div class="stat">
            <div class="stat-num">500+</div>
            <div class="stat-label">Members</div>
          </div>
          <div class="stat">
            <div class="stat-num">24/7</div>
            <div class="stat-label">Access</div>
          </div>
          <div class="stat">
            <div class="stat-num">30+</div>
            <div class="stat-label">Programs</div>
          </div>
        </div> -->

        <!-- decorative barbell -->
        <div class="barbell">
          <div class="bb-plate lg"></div>
          <div class="bb-plate"></div>
          <div class="bb-bar"></div>
          <div class="bb-plate"></div>
          <div class="bb-plate lg"></div>
        </div>
      </div>
    </div>

    <!-- ── Right Auth Panel ── -->
    <div class="col-xl-6 col-lg-8 col-md-9 col-12">
      <div class="auth-panel">
        <div class="auth-card">

          <!-- Tabs -->
          <div class="tab-bar">
            <button class="tab-btn active" onclick="switchTab('login')">Sign In</button>
            <button class="tab-btn" onclick="switchTab('signup')">Sign Up</button>
          </div>

          <!-- ── LOGIN ── -->
          <div class="form-section active" id="login">
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <div class="input-icon-wrap">
                <span class="icon">✉</span>
                <input type="email" class="form-control" placeholder="you@pumphouse.com"/>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <div class="input-icon-wrap">
                <span class="icon">🔒</span>
                <input type="password" class="form-control" placeholder="••••••••"/>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Login As</label>
              <div class="input-icon-wrap role-select-wrap">
                <span class="icon">👤</span>
                <select class="form-select" id="loginRole" onchange="updateRoleBadge('loginRole','loginBadge')">
                  <option value="">-- Select Role --</option>
                  <option value="member">Member</option>
                  <option value="admin">Admin</option>
                </select>
                <span class="role-badge" id="loginBadge"></span>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember"/>
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a href="#" class="form-link">Forgot password?</a>
            </div>

            <button class="btn-pump">Access Dashboard</button>

            <div class="or-divider">No account?&nbsp;
              <a href="#" class="form-link" onclick="switchTab('signup');return false;">Register here</a>
            </div>
          </div>

          <!-- ── SIGNUP ── -->
          <div class="form-section" id="signup">
            <div class="row g-0">
              <div class="col-6 pe-2">
                <div class="form-group">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" placeholder="John"/>
                </div>
              </div>
              <div class="col-6 ps-2">
                <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" placeholder="Doe"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Email Address</label>
              <div class="input-icon-wrap">
                <span class="icon">✉</span>
                <input type="email" class="form-control" placeholder="you@pumphouse.com"/>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Phone Number</label>
              <div class="input-icon-wrap">
                <span class="icon">📞</span>
                <input type="tel" class="form-control" placeholder="+92 300 0000000"/>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Register As</label>
              <div class="input-icon-wrap role-select-wrap">
                <span class="icon">👤</span>
                <select class="form-select" id="signupRole" onchange="updateRoleBadge('signupRole','signupBadge')">
                  <option value="">-- Select Role --</option>
                  <option value="member">Member</option>
                  <option value="admin">Admin</option>
                </select>
                <span class="role-badge" id="signupBadge"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Password</label>
              <div class="input-icon-wrap">
                <span class="icon">🔒</span>
                <input type="password" class="form-control" placeholder="Create a strong password"/>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Confirm Password</label>
              <div class="input-icon-wrap">
                <span class="icon">🔒</span>
                <input type="password" class="form-control" placeholder="Repeat password"/>
              </div>
            </div>

            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" id="terms"/>
              <label class="form-check-label" for="terms">
                I agree to the <a href="#" class="form-link" style="color:var(--gold);">Terms &amp; Conditions</a>
              </label>
            </div>

            <button class="btn-pump">Create Account</button>

            <div class="or-divider">Already a member?&nbsp;
              <a href="#" class="form-link" onclick="switchTab('login');return false;">Sign in</a>
            </div>
          </div>
          <!-- end forms -->

        </div>
      </div>
    </div>

  </div><!-- row -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleTheme() {
    const isLight = document.body.classList.toggle('light-theme');
    document.getElementById('themeKnob').textContent = isLight ? '☀️' : '🌙';
  }

  function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach((b,i) => {
      b.classList.toggle('active', (tab==='login' && i===0)||(tab==='signup' && i===1));
    });
    document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
    document.getElementById(tab).classList.add('active');
  }

  function updateRoleBadge(selectId, badgeId) {
    const val = document.getElementById(selectId).value;
    const badge = document.getElementById(badgeId);
    if (val === 'admin') badge.textContent = '⚡ ADMIN';
    else if (val === 'member') badge.textContent = '🏋 MEMBER';
    else badge.textContent = '';
  }
  document.querySelector('#login .btn-pump').addEventListener('click', function() {
  const email = document.querySelector('#login input[type="email"]').value.trim();
  const password = document.querySelector('#login input[type="password"]').value.trim();
  const role = document.getElementById('loginRole').value;

  if (!email || !password) {
    alert('Please enter your email and password.');
    return;
  }
  if (!role) {
    alert('Please select a role.');
    return;
  }

  if (role === 'admin') {
    window.location.href = './admin-dashboard.php';
  } else {
    window.location.href = './member-dashboard.php';
  }
});
</script>
</body>
</html>