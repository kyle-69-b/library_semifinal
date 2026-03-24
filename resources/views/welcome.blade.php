<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome — LibryKyle</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root {
    --navy:   #0d1b2a;
    --navy2:  #162336;
    --navy3:  #1f3044;
    --gold:   #c9a84c;
    --gold2:  #e8c97a;
    --text:   #e8e4da;
    --text2:  #a8a49c;
    --border: rgba(201,168,76,0.18);
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Outfit', sans-serif;
    background: var(--navy);
    color: var(--text);
    min-height: 100vh;
    overflow-x: hidden;
  }
  body::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
      linear-gradient(rgba(201,168,76,0.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(201,168,76,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none; z-index: 0;
  }
  body::after {
    content: '';
    position: fixed; top: -20%; left: -10%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 65%);
    pointer-events: none; z-index: 0;
  }
  .page { position: relative; z-index: 1; }

  /* ── NAV ── */
  nav {
    display: flex; align-items: center; justify-content: space-between;
    padding: 22px 64px;
    border-bottom: 1px solid var(--border);
    backdrop-filter: blur(8px);
    position: sticky; top: 0; z-index: 100;
    background: rgba(13,27,42,0.88);
  }
  .nav-logo {
    display: flex; align-items: center; gap: 12px;
    text-decoration: none;
  }
  .nav-logo-icon {
    width: 38px; height: 38px;
    background: var(--gold); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: var(--navy); font-size: 16px;
  }
  .nav-logo-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px; font-weight: 700; color: var(--text);
  }
  .nav-logo-text span { color: var(--gold); }
  .nav-links { display: flex; align-items: center; gap: 4px; }
  .nav-link {
    font-size: 13px; font-weight: 400; color: var(--text2);
    text-decoration: none; padding: 7px 14px; border-radius: 6px;
    transition: color 0.2s, background 0.2s;
    display: flex; align-items: center; gap: 7px;
    background: none; border: none; cursor: pointer;
    font-family: 'Outfit', sans-serif;
  }
  .nav-link i { font-size: 12px; }
  .nav-link:hover { color: var(--text); background: rgba(255,255,255,0.05); }
  .nav-divider { width: 1px; height: 18px; background: rgba(255,255,255,0.1); margin: 0 8px; }
  .nav-cta {
    background: var(--gold) !important; color: var(--navy) !important;
    font-weight: 600 !important; padding: 9px 22px !important;
  }
  .nav-cta:hover { background: var(--gold2) !important; color: var(--navy) !important; }

  /* ── HERO ── */
  .hero {
    display: flex; flex-direction: column;
    align-items: center; text-align: center;
    padding: 110px 64px 100px;
    max-width: 900px; margin: 0 auto;
  }
  .hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(201,168,76,0.1); border: 1px solid var(--border);
    color: var(--gold); font-size: 11px; font-weight: 600;
    letter-spacing: 0.14em; text-transform: uppercase;
    padding: 6px 16px; border-radius: 100px; margin-bottom: 32px;
  }
  .hero-eyebrow::before {
    content: ''; width: 6px; height: 6px;
    background: var(--gold); border-radius: 50%;
  }
  .hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 72px; font-weight: 700;
    line-height: 1.08; color: var(--text); margin-bottom: 24px;
  }
  .hero h1 em { font-style: italic; color: var(--gold); }
  .hero p {
    font-size: 16px; font-weight: 300; color: var(--text2);
    line-height: 1.75; max-width: 560px; margin: 0 auto 44px;
  }
  .hero-actions { display: flex; align-items: center; gap: 16px; }
  .btn-primary {
    display: inline-flex; align-items: center; gap: 10px;
    background: var(--gold); color: var(--navy);
    font-weight: 600; font-size: 15px;
    padding: 14px 32px; border-radius: 8px; text-decoration: none;
    transition: background 0.2s, transform 0.2s;
  }
  .btn-primary:hover { background: var(--gold2); transform: translateY(-1px); }
  .btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    color: var(--text2); font-size: 14px; text-decoration: none;
    border: 1px solid rgba(255,255,255,0.12);
    padding: 14px 28px; border-radius: 8px;
    transition: border-color 0.2s, color 0.2s;
  }
  .btn-ghost:hover { border-color: var(--gold); color: var(--gold); }

  /* ── STATS ── */
  .stats-strip {
    display: flex; max-width: 900px; margin: 0 auto 80px;
    border: 1px solid var(--border); border-radius: 14px;
    overflow: hidden; background: var(--navy2);
  }
  .stat-item {
    flex: 1; padding: 30px 20px; text-align: center;
    border-right: 1px solid var(--border);
  }
  .stat-item:last-child { border-right: none; }
  .stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px; font-weight: 700;
    color: var(--gold); line-height: 1; margin-bottom: 6px;
  }
  .stat-lbl { font-size: 12px; color: var(--text2); letter-spacing: 0.06em; }

  /* ── DIVIDER ── */
  .divider {
    display: flex; align-items: center; gap: 20px;
    padding: 0 64px; margin-bottom: 56px;
  }
  .divider-line { flex: 1; height: 1px; background: var(--border); }
  .divider-label {
    font-size: 11px; font-weight: 500; color: var(--text2);
    letter-spacing: 0.12em; text-transform: uppercase;
  }

  /* ── FEATURES ── */
  .features-section { padding: 0 64px 80px; }
  .features-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 20px; max-width: 1100px; margin: 0 auto;
  }
  .feature-card {
    background: var(--navy2);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px; padding: 32px 26px;
    position: relative; overflow: hidden;
    transition: border-color 0.3s, transform 0.3s;
    text-decoration: none; display: block;
  }
  .feature-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: var(--gold); opacity: 0; transition: opacity 0.3s;
  }
  .feature-card:hover { border-color: var(--border); transform: translateY(-4px); }
  .feature-card:hover::before { opacity: 1; }
  .feature-icon {
    width: 48px; height: 48px;
    background: rgba(201,168,76,0.1); border: 1px solid var(--border);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: var(--gold); margin-bottom: 20px;
  }
  .feature-card h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 600; color: var(--text); margin-bottom: 10px;
  }
  .feature-card p {
    font-size: 13px; font-weight: 300; color: var(--text2); line-height: 1.65;
  }
  .feature-card-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 12px; color: var(--gold);
    margin-top: 16px; font-weight: 500; letter-spacing: 0.04em;
  }

  /* ── MODULES QUICK ACCESS ── */
  .modules-section { padding: 0 64px 100px; }
  .modules-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 14px; max-width: 1100px; margin: 0 auto;
  }
  .module-card {
    background: var(--navy2);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 10px; padding: 18px 22px;
    text-decoration: none;
    display: flex; align-items: center; gap: 14px;
    transition: border-color 0.2s, background 0.2s;
  }
  .module-card:hover { border-color: var(--border); background: var(--navy3); }
  .module-card-icon {
    width: 40px; height: 40px;
    background: rgba(201,168,76,0.08); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 15px; flex-shrink: 0;
  }
  .module-card-label { font-size: 13px; font-weight: 500; color: var(--text); }
  .module-card-sub { font-size: 11px; color: var(--text2); margin-top: 2px; }
  .module-card-arrow { margin-left: auto; color: var(--text2); font-size: 11px; }

  /* ── FOOTER ── */
  footer {
    border-top: 1px solid var(--border); padding: 28px 64px;
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(13,27,42,0.7);
  }
  .footer-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 700; color: var(--gold);
  }
  .footer-links { display: flex; gap: 24px; }
  .footer-links a {
    font-size: 12px; color: var(--text2); text-decoration: none; transition: color 0.2s;
  }
  .footer-links a:hover { color: var(--gold); }
  footer p { font-size: 12px; color: var(--text2); }

  @media (max-width: 1024px) {
    nav { padding: 18px 24px; }
    .hero { padding: 70px 24px 80px; }
    .hero h1 { font-size: 44px; }
    .features-grid { grid-template-columns: 1fr 1fr; }
    .modules-grid { grid-template-columns: 1fr 1fr; }
    .features-section, .modules-section { padding: 0 24px 60px; }
    .divider { padding: 0 24px; }
    footer { padding: 24px; flex-direction: column; gap: 12px; text-align: center; }
    .footer-links { flex-wrap: wrap; justify-content: center; }
  }
</style>
</head>
<body>
<div class="page">

  {{-- ============================= NAVBAR ============================= --}}
  <nav>
    <a href="{{ route('home') }}" class="nav-logo">
      <div class="nav-logo-icon"><i class="fas fa-book-open"></i></div>
      <span class="nav-logo-text">Libry<span>Kyle</span></span>
    </a>

    <div class="nav-links">
      <a href="{{ route('home') }}#features" class="nav-link">
        <i class="fas fa-star"></i> Features
      </a>
      <a href="{{ route('home') }}#modules" class="nav-link">
        <i class="fas fa-cubes"></i> Modules
      </a>

      <div class="nav-divider"></div>

      @auth
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="fas fa-gauge-high"></i> Dashboard
        </a>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
          @csrf
          <button type="submit" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="nav-link nav-cta">
          <i class="fas fa-arrow-right-to-bracket"></i> Sign In
        </a>
      @endauth
    </div>
  </nav>

  {{-- ============================= HERO ============================= --}}
  <div class="hero">
    <div class="hero-eyebrow">Library Management System</div>
    <h1>Your library,<br><em>brilliantly</em> managed.</h1>
    <p>A comprehensive platform for librarians — track collections, manage memberships, process loans, manage fines, and generate reports with professional precision.</p>
    <div class="hero-actions">
      <a href="{{ route('login') }}" class="btn-primary">
        <i class="fas fa-arrow-right-to-bracket"></i> Get Started
      </a>
      <a href="{{ route('home') }}#features" class="btn-ghost">
        <i class="fas fa-circle-play"></i> Learn More
      </a>
    </div>
  </div>

  {{-- ============================= STATS ============================= --}}
  <div class="stats-strip">
    <div class="stat-item">
      <div class="stat-num">6+</div>
      <div class="stat-lbl">Modules</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">4</div>
      <div class="stat-lbl">PDF Reports</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">∞</div>
      <div class="stat-lbl">Books Tracked</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">24/7</div>
      <div class="stat-lbl">Availability</div>
    </div>
  </div>

  {{-- ============================= FEATURES ============================= --}}
  <div class="divider" id="features">
    <div class="divider-line"></div>
    <div class="divider-label">Platform Features</div>
    <div class="divider-line"></div>
  </div>

  <section class="features-section">
    <div class="features-grid">

      <a href="{{ route('login') }}" class="feature-card">
        <div class="feature-icon"><i class="fas fa-book"></i></div>
        <h3>Book Catalog</h3>
        <p>Manage your full inventory with categories, authors, ISBN tracking, and real-time copy availability.</p>
        <span class="feature-card-link"><i class="fas fa-arrow-right"></i> Manage Books</span>
      </a>

      <a href="{{ route('login') }}" class="feature-card">
        <div class="feature-icon"><i class="fas fa-users"></i></div>
        <h3>Member Registry</h3>
        <p>Register students, faculty, and staff. Track membership status, borrowing history, and account standing.</p>
        <span class="feature-card-link"><i class="fas fa-arrow-right"></i> Manage Members</span>
      </a>

      <a href="{{ route('login') }}" class="feature-card">
        <div class="feature-icon"><i class="fas fa-handshake"></i></div>
        <h3>Loan Tracking</h3>
        <p>Process borrowings and returns with automatic due-date monitoring, overdue marking, and status updates.</p>
        <span class="feature-card-link"><i class="fas fa-arrow-right"></i> Manage Loans</span>
      </a>

      <a href="{{ route('login') }}" class="feature-card">
        <div class="feature-icon"><i class="fas fa-file-pdf"></i></div>
        <h3>PDF Reports</h3>
        <p>Generate and download professional reports for books, loans, members, and fines — all in one click.</p>
        <span class="feature-card-link"><i class="fas fa-arrow-right"></i> View Reports</span>
      </a>

    </div>
  </section>

  {{-- ============================= MODULES ============================= --}}
  <div class="divider" id="modules">
    <div class="divider-line"></div>
    <div class="divider-label">System Modules</div>
    <div class="divider-line"></div>
  </div>

  <section class="modules-section">
    <div class="modules-grid">

      <a href="{{ route('dashboard') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-gauge-high"></i></div>
        <div>
          <div class="module-card-label">Dashboard</div>
          <div class="module-card-sub">Overview &amp; system statistics</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('categories.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-tag"></i></div>
        <div>
          <div class="module-card-label">Categories</div>
          <div class="module-card-sub">Organize book categories</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('books.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-book"></i></div>
        <div>
          <div class="module-card-label">Books</div>
          <div class="module-card-sub">Catalog &amp; inventory management</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('members.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-users"></i></div>
        <div>
          <div class="module-card-label">Members</div>
          <div class="module-card-sub">Registration &amp; member profiles</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('loans.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-handshake"></i></div>
        <div>
          <div class="module-card-label">Loans</div>
          <div class="module-card-sub">Borrow &amp; return tracking</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('fines.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-peso-sign"></i></div>
        <div>
          <div class="module-card-label">Fines</div>
          <div class="module-card-sub">Overdue penalty management</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('reports.index') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-chart-bar"></i></div>
        <div>
          <div class="module-card-label">Reports</div>
          <div class="module-card-sub">Books, loans, members &amp; fines</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('reports.books') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-file-pdf"></i></div>
        <div>
          <div class="module-card-label">Book Report</div>
          <div class="module-card-sub">Download PDF book report</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

      <a href="{{ route('reports.loans') }}" class="module-card">
        <div class="module-card-icon"><i class="fas fa-file-lines"></i></div>
        <div>
          <div class="module-card-label">Loan Report</div>
          <div class="module-card-sub">Download PDF loan report</div>
        </div>
        <i class="fas fa-chevron-right module-card-arrow"></i>
      </a>

    </div>
  </section>

  {{-- ============================= FOOTER ============================= --}}
  <footer>
    <div class="footer-logo">LibryKyle</div>
    <div class="footer-links">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('home') }}#features">Features</a>
      <a href="{{ route('home') }}#modules">Modules</a>
      <a href="{{ route('login') }}">Sign In</a>
    </div>
    <p>&copy; {{ date('Y') }} LibryKyle. All rights reserved.</p>
  </footer>

</div>
</body>
</html>
