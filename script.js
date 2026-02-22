const today = new Date();
const todayDay = today.getDate();
const members = [
  {
    initials: "AK",
    color: "#e8ff47",
    name: "Alex Kim",
    email: "alex@email.com",
    plan: "Annual",
    feeDay: todayDay,
    feePlan: "Annual – $599",
    expiry: "Feb 2027",
    checkins: 48,
    status: "active",
  },
  {
    initials: "SR",
    color: "#4fc3f7",
    name: "Sara Reed",
    email: "sara@email.com",
    plan: "Monthly",
    feeDay: todayDay,
    feePlan: "Monthly – $59",
    expiry: "Mar 2026",
    checkins: 22,
    status: "active",
  },
  {
    initials: "MO",
    color: "#a78bfa",
    name: "Mike Osei",
    email: "mike@email.com",
    plan: "Trial",
    feeDay: todayDay,
    feePlan: "Trial (Expiring)",
    expiry: "Feb 28",
    checkins: 3,
    status: "trial",
  },
  {
    initials: "JP",
    color: "#fb923c",
    name: "Jane Park",
    email: "jane@email.com",
    plan: "Quarterly",
    feeDay: 10,
    feePlan: "Quarterly – $149",
    expiry: "Feb 10",
    checkins: 31,
    status: "expired",
  },
  {
    initials: "LC",
    color: "#4ade80",
    name: "Leo Chen",
    email: "leo@email.com",
    plan: "Annual",
    feeDay: 8,
    feePlan: "Annual – $599",
    expiry: "Feb 2027",
    checkins: 61,
    status: "active",
  },
  {
    initials: "TW",
    color: "#f472b6",
    name: "Tara White",
    email: "tara@email.com",
    plan: "Monthly",
    feeDay: todayDay,
    feePlan: "Monthly – $59",
    expiry: "Mar 2026",
    checkins: 14,
    status: "active",
  },
  {
    initials: "RS",
    color: "#fb923c",
    name: "Ryan Singh",
    email: "ryan@email.com",
    plan: "Annual",
    feeDay: 15,
    feePlan: "Annual – $599",
    expiry: "Jan 2027",
    checkins: 55,
    status: "active",
  },
  {
    initials: "KP",
    color: "#60a5fa",
    name: "Kim Patel",
    email: "kim@email.com",
    plan: "Quarterly",
    feeDay: todayDay,
    feePlan: "Quarterly – $149",
    expiry: "Apr 2026",
    checkins: 29,
    status: "active",
  },
];

const classesData = [
  {
    name: "Morning HIIT",
    trainer: "Sarah Mills",
    time: "06:00",
    capacity: 20,
    enrolled: 18,
    days: "Mon-Sat",
    color: "#e8ff47",
  },
  {
    name: "Yoga Flow",
    trainer: "Diana Cruz",
    time: "08:30",
    capacity: 15,
    enrolled: 12,
    days: "Daily",
    color: "#4fc3f7",
  },
  {
    name: "Strength & Tone",
    trainer: "Marcus Lee",
    time: "11:00",
    capacity: 25,
    enrolled: 8,
    days: "Mon/Wed/Fri",
    color: "#a78bfa",
  },
  {
    name: "Spin Cycle",
    trainer: "Amy Torres",
    time: "17:30",
    capacity: 20,
    enrolled: 20,
    days: "Tue/Thu/Sat",
    color: "#fb923c",
  },
  {
    name: "Boxing Bootcamp",
    trainer: "Jake Russo",
    time: "19:00",
    capacity: 20,
    enrolled: 14,
    days: "Mon/Wed",
    color: "#f472b6",
  },
  {
    name: "Pilates Core",
    trainer: "Luna Reyes",
    time: "09:00",
    capacity: 12,
    enrolled: 10,
    days: "Tue/Thu",
    color: "#4ade80",
  },
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
const pages = [
  "dashboard",
  "members",
  "payments",
  "classes",
  ,
  "memberships",
  "reports",
  "settings",
];
function showPage(name) {
  pages.forEach((p) => {
    const el = document.getElementById("page-" + p);
    if (el) el.style.display = "none";
  });
  document.getElementById("page-" + name).style.display = "";
  document.getElementById("page-title").textContent =
    name.charAt(0).toUpperCase() + name.slice(1);
  document
    .querySelectorAll(".nav-item")
    .forEach((el) => el.classList.remove("active"));
  document.querySelectorAll(".nav-item").forEach((el) => {
    if (
      el.textContent
        .trim()
        .toLowerCase()
        .includes(name.toLowerCase().slice(0, 4))
    )
      el.classList.add("active");
  });
  if (name === "members") renderMembersTable();
  if (name === "classes") renderClasses();
  // if(name==='trainers') renderTrainers();
  if (name === "reports")
    setTimeout(
      () =>
        renderChart(
          "signup-chart",
          [42, 58, 67, 71, 88, 95, 102, 89, 76, 112, 138, 142],
          [
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
            "Jan",
            "Feb",
          ],
          "#a78bfa",
        ),
      100,
    );
}

// ── Fee Due — Inline Panel (Members page only) ────────────────────────────────
function renderFeeAlert() {
  const due = members.filter((m) => m.feeDay === todayDay);
  const container = document.getElementById("fee-inline-alert");
  if (!container) return;
  if (!due.length) {
    container.innerHTML = "";
    return;
  }

  const dateStr = today.toLocaleDateString("en-US", {
    weekday: "long",
    month: "long",
    day: "numeric",
  });
  container.innerHTML = `
    <div class="fee-inline-panel">
      <div class="fee-inline-header">
        <div class="fee-inline-dot"></div>
        <i class="fa fa-triangle-exclamation" style="color:#ff6b6b;font-size:1rem;"></i>
        <div class="fee-inline-title">
          Fee Collection Day — <span>${due.length} member${due.length > 1 ? "s" : ""} due today</span>
          <div style="font-size:.73rem;font-weight:400;color:#fca5a5;margin-top:2px;">${dateStr} · Collect payments below</div>
        </div>
        <div class="fee-inline-badge">${due.length} Pending</div>
      </div>
      <div class="fee-inline-chips">
        ${due
          .map(
            (m) => `<div class="fee-inline-chip">
          <div class="fee-inline-chip-av" style="background:${m.color};">${m.initials}</div>
          ${m.name} <span style="opacity:.65;margin-left:2px;">· ${m.feePlan}</span>
        </div>`,
          )
          .join("")}
      </div>
    </div>`;
}

// ── Members Table ─────────────────────────────────────────────────────────────
function renderMembersTable() {
  renderFeeAlert();
  document.getElementById("members-table-body").innerHTML = members
    .map((m) => {
      const isDue = m.feeDay === todayDay;
      return `<tr class="${isDue ? "fee-due-row" : ""}">
      <td><div style="display:flex;align-items:center;">
        <div class="mem-avatar" style="background:${m.color};">${m.initials}</div>${m.name}
        ${isDue ? '<span class="fee-due-tag"><i class="fa fa-circle-exclamation"></i> FEE DUE</span>' : ""}
      </div></td>
      <td style="color:var(--muted);font-size:.82rem;">${m.email}</td>
      <td>${m.plan}</td>
      <td style="${isDue ? "color:#ff6b6b;font-weight:700;animation:feePulseText 1.2s ease-in-out infinite;" : "color:var(--muted);"}">
        Day ${m.feeDay}${isDue ? " ← TODAY" : ""}
      </td>
      <td style="font-size:.82rem;">${m.expiry}</td>
      <td><span style="font-family:'Bebas Neue',sans-serif;font-size:1.1rem;">${m.checkins}</span></td>
      <td><span class="badge-status badge-${m.status}">${m.status.charAt(0).toUpperCase() + m.status.slice(1)}</span></td>
      <td>
        <button class="btn-outline-accent" style="padding:4px 10px;font-size:.72rem;margin-right:4px;">Edit</button>
        ${
          isDue
            ? '<button class="btn-accent" style="padding:4px 10px;font-size:.72rem;background:#ff2d44;">Collect</button>'
            : '<button class="btn-outline-accent" style="padding:4px 10px;font-size:.72rem;color:var(--accent2);border-color:rgba(255,71,87,.3);">Delete</button>'
        }
      </td>
    </tr>`;
    })
    .join("");
}

// ── Classes ───────────────────────────────────────────────────────────────────
function renderClasses() {
  document.getElementById("classes-container").innerHTML = classesData
    .map(
      (c) => `
    <div class="col-md-6 col-xl-4">
      <div class="chart-card" style="border-top:3px solid ${c.color};">
        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:12px;">
          <div><div style="font-weight:700;font-size:.95rem;">${c.name}</div><div style="font-size:.75rem;color:var(--muted);">${c.trainer}</div></div>
          <span style="font-family:'Bebas Neue',sans-serif;font-size:1rem;color:${c.color};">${c.time}</span>
        </div>
        <div style="margin-bottom:10px;">
          <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:5px;"><span style="color:var(--muted);">Enrolled</span><span>${c.enrolled}/${c.capacity}</span></div>
          <div class="prog-bar-bg"><div class="prog-bar-fill" style="width:${Math.round((c.enrolled / c.capacity) * 100)}%;background:${c.color};"></div></div>
        </div>
        <div style="font-size:.73rem;color:var(--muted);">${c.days}</div>
      </div>
    </div>`,
    )
    .join("");
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
const months = [
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec",
  "Jan",
  "Feb",
];
const revenueData = [
  32000, 34500, 29800, 38000, 41200, 39600, 43100, 45800, 42000, 44611, 46200,
  48290,
];
const attendData = [120, 145, 160, 132, 178, 201, 188];
const weekDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

function renderChart(id, data, labels, color) {
  const el = document.getElementById(id);
  if (!el) return;
  const max = Math.max(...data);
  el.innerHTML = data
    .map((v, i) => {
      const h = Math.max(8, Math.round((v / max) * 100));
      const isCurrent = i === data.length - 1;
      return `<div class="bar-wrap"><div class="bar" style="height:${h}px;background:${isCurrent ? color : "var(--surface2)"};"></div><div class="bar-label">${labels[i]}</div></div>`;
    })
    .join("");
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
renderChart("revenue-chart", revenueData, months, "var(--accent)");
renderChart("attend-chart", attendData, weekDays, "#4fc3f7");
