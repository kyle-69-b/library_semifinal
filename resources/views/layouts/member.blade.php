{{-- resources/views/layouts/member.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Library') — LibryKyle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg:        #0d1b2a;
            --bg2:       #162336;
            --bg3:       #1f3044;
            --border:    rgba(255,255,255,0.08);
            --border2:   rgba(42,157,143,0.18);
            --teal:      #2a9d8f;
            --teal2:     #3dbdad;
            --gold:      #c9a84c;
            --gold2:     #e8c97a;
            --text:      #e8e4da;
            --text2:     #a8a49c;
            --danger:    #d9534f;
            --success:   #5cb85c;
            --warning:   #f0ad4e;
            --sidebar-w: 260px;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg2);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 100; overflow-y: auto;
        }

        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-logo-icon {
            width: 34px; height: 34px;
            background: var(--gold); border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            color: var(--bg); font-size: 14px; flex-shrink: 0;
        }
        .sidebar-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 700; color: var(--text);
        }
        .sidebar-logo-text span { color: var(--gold); }

        /* Member badge under logo */
        .member-portal-badge {
            margin: 0 14px 0;
            padding: 7px 14px;
            background: rgba(42,157,143,0.1);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 7px;
            font-size: 11px; font-weight: 600;
            color: var(--teal2); letter-spacing: 0.08em; text-transform: uppercase;
        }
        .member-portal-badge i { font-size: 11px; }

        .sidebar-nav { padding: 14px 0; flex: 1; }
        .nav-section {
            padding: 10px 20px 4px;
            font-size: 10px; text-transform: uppercase;
            letter-spacing: 0.12em; color: var(--text2); font-weight: 600;
        }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 20px; color: var(--text2);
            text-decoration: none; font-size: 13.5px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            margin: 1px 0;
            background: none; border-top: none; border-right: none; border-bottom: none;
            border-left: 3px solid transparent;
            width: 100%; cursor: pointer;
            font-family: 'Outfit', sans-serif;
        }
        .nav-link:hover { color: var(--teal2); background: rgba(42,157,143,0.06); }
        .nav-link.active { color: var(--teal2); background: rgba(42,157,143,0.08); border-left-color: var(--teal2); }
        .nav-link i { width: 17px; text-align: center; font-size: 13px; }

        .nav-divider { height: 1px; background: var(--border); margin: 8px 16px; }

        /* ── SIDEBAR USER ── */
        .sidebar-user {
            padding: 14px 20px; border-top: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
        }
        .user-avatar {
            width: 34px; height: 34px;
            background: var(--teal); color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 500; }
        .user-role { font-size: 11px; color: var(--teal2); }
        .logout-btn {
            margin-left: auto; color: var(--text2);
            background: none; border: none; cursor: pointer;
            font-size: 14px; transition: color 0.2s; padding: 4px;
        }
        .logout-btn:hover { color: var(--danger); }

        /* ── MAIN ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            padding: 15px 28px; border-bottom: 1px solid var(--border);
            background: var(--bg2);
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        /* Teal accent line on topbar */
        .topbar::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--teal), var(--teal2));
        }
        .topbar { position: sticky; }
        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; color: var(--text);
        }
        .topbar-right { display: flex; gap: 10px; align-items: center; }
        .topbar-date { font-size: 12px; color: var(--text2); }
        .content { padding: 26px 28px; flex: 1; }

        /* ── ALERTS ── */
        .alert {
            padding: 11px 15px; border-radius: 6px;
            margin-bottom: 18px; font-size: 13.5px; border: 1px solid;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success { background: rgba(92,184,92,0.1);  border-color: var(--success); color: var(--success); }
        .alert-error   { background: rgba(217,83,79,0.1);  border-color: var(--danger);  color: var(--danger); }
        .alert-warning { background: rgba(240,173,78,0.1); border-color: var(--warning); color: var(--warning); }

        /* ── CARDS ── */
        .card { background: var(--bg2); border: 1px solid var(--border); border-radius: 10px; padding: 22px; }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; }
        .card-title { font-family: 'Cormorant Garamond', serif; font-size: 16px; color: var(--text); }

        /* ── STATS ── */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 14px; margin-bottom: 22px; }
        .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 10px; padding: 18px; position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: var(--teal); }
        .stat-card.danger::before  { background: var(--danger); }
        .stat-card.success::before { background: var(--success); }
        .stat-card.warning::before { background: var(--warning); }
        .stat-icon { width: 38px; height: 38px; border-radius: 8px; background: rgba(42,157,143,0.1); display: flex; align-items: center; justify-content: center; color: var(--teal2); font-size: 15px; margin-bottom: 10px; }
        .stat-card.danger  .stat-icon { background: rgba(217,83,79,0.1);  color: var(--danger); }
        .stat-card.success .stat-icon { background: rgba(92,184,92,0.1);  color: var(--success); }
        .stat-card.warning .stat-icon { background: rgba(240,173,78,0.1); color: var(--warning); }
        .stat-value { font-size: 26px; font-weight: 700; color: var(--text); line-height: 1; }
        .stat-label { font-size: 11px; color: var(--text2); margin-top: 4px; }

        /* ── TABLE ── */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        th { padding: 9px 13px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text2); border-bottom: 1px solid var(--border); font-weight: 600; }
        td { padding: 11px 13px; border-bottom: 1px solid var(--border); color: var(--text); }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(42,157,143,0.02); }

        /* ── BADGES ── */
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; }
        .badge-success   { background: rgba(92,184,92,0.15);  color: var(--success); }
        .badge-danger    { background: rgba(217,83,79,0.15);  color: var(--danger); }
        .badge-warning   { background: rgba(240,173,78,0.15); color: var(--warning); }
        .badge-info      { background: rgba(42,157,143,0.15); color: var(--teal2); }
        .badge-secondary { background: rgba(158,155,147,0.15);color: var(--text2); }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; font-family: 'Outfit', sans-serif; }
        .btn-primary   { background: var(--teal); color: #fff; }
        .btn-primary:hover { background: var(--teal2); }
        .btn-secondary { background: var(--bg3); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { border-color: var(--teal2); color: var(--teal2); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }

        /* ── GRID ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        @media (max-width: 1100px) { .grid-2 { grid-template-columns: 1fr; } }
    </style>
    @stack('styles')
</head>
<body>

{{-- ============================= SIDEBAR ============================= --}}
<aside class="sidebar">

    <a href="{{ route('home') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon"><i class="fas fa-book-open"></i></div>
        <span class="sidebar-logo-text">Libry<span>Kyle</span></span>
    </a>

    <div class="member-portal-badge">
        <i class="fas fa-user"></i> Member Portal
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">My Account</div>
        <a href="{{ route('member.dashboard') }}"
           class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge-high"></i> Dashboard
        </a>
        <a href="{{ route('member.loans') }}"
           class="nav-link {{ request()->routeIs('member.loans') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> My Loans
        </a>
        <a href="{{ route('member.history') }}"
           class="nav-link {{ request()->routeIs('member.history') ? 'active' : '' }}">
            <i class="fas fa-clock-rotate-left"></i> Borrowing History
        </a>
        <a href="{{ route('member.fines') }}"
           class="nav-link {{ request()->routeIs('member.fines') ? 'active' : '' }}">
            <i class="fas fa-peso-sign"></i> My Fines
        </a>

        <div class="nav-divider"></div>

        <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-arrow-left"></i> Public Site
        </a>
    </nav>

    <div class="sidebar-user">
        <div class="user-avatar">{{ substr(Auth::guard('member')->user()->name, 0, 1) }}</div>
        <div>
            <div class="user-name">{{ Auth::guard('member')->user()->name }}</div>
            <div class="user-role">{{ ucfirst(Auth::guard('member')->user()->type) }}</div>
        </div>
        <form action="{{ route('member.logout') }}" method="POST" style="margin-left:auto;">
            @csrf
            <button type="submit" class="logout-btn" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>

</aside>

{{-- ============================= MAIN ============================= --}}
<main class="main">
    <div class="topbar">
        <div class="page-title">@yield('page-title', 'My Dashboard')</div>
        <div class="topbar-right">
            <span class="topbar-date"><i class="fas fa-clock"></i> {{ now()->format('M d, Y') }}</span>
            @yield('topbar-actions')
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</main>

@stack('scripts')
</body>
</html>
