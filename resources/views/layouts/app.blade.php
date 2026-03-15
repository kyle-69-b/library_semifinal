<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management') — LibSys</title>

    <!-- Apple System Fonts -->
    <style>
        @font-face {
            font-family: 'SF Pro Display';
            src: local('-apple-system'), local('BlinkMacSystemFont'), local('Segoe UI'), local('Roboto'), local('Helvetica Neue'), local('Arial'), local('sans-serif');
            font-weight: 300 900;
            font-display: swap;
        }

        @font-face {
            font-family: 'SF Mono';
            src: local('SF Mono'), local('Menlo'), local('Monaco'), local('Consolas'), local('monospace');
            font-weight: 400;
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f7 0%, #e8e8ed 100%);
            color: #1d1d1f;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        /* Apple-style Navigation with Glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 0.75rem 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1d1d1f;
            text-decoration: none;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            font-size: 1.8rem;
            filter: drop-shadow(0 2px 4px rgba(0, 113, 227, 0.3));
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-link {
            color: #1d1d1f;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link-icon {
            font-size: 1.2rem;
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .nav-link:hover .nav-link-icon {
            opacity: 1;
            transform: scale(1.1);
        }

        .nav-link.active {
            color: #0071e3;
            background: rgba(0, 113, 227, 0.1);
        }

        .nav-link.active .nav-link-icon {
            opacity: 1;
            color: #0071e3;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #c6c6c8, #8e8e93);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background: none;
            border: none;
            color: #6e6e73;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
        }

        .logout-btn:hover .nav-link-icon {
            color: #ff3b30;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 100px auto 2rem;
            padding: 0 2rem;
        }

        /* Premium Apple-style Cards */
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1d1d1f;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header-icon {
            font-size: 1.4rem;
            background: linear-gradient(135deg, #0071e3, #40a8ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 4px rgba(0, 113, 227, 0.2));
        }

        /* Premium Buttons */
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.2, 0, 0, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #1d1d1f;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(0, 113, 227, 0.3);
            transform: scale(1.02);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0071e3, #0077ed);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 113, 227, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0077ed, #0080ff);
            box-shadow: 0 6px 16px rgba(0, 113, 227, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #34c759, #30d158);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(52, 199, 89, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff3b30, #ff453a);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(255, 59, 48, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ff9f0a, #ffb340);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(255, 159, 10, 0.3);
        }

        .btn-icon {
            font-size: 1.1rem;
        }

        /* Premium Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th {
            text-align: left;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.02);
            color: #1d1d1f;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            color: #1d1d1f;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Premium Badges */
        .badge {
            padding: 0.35rem 0.85rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .badge-success {
            background: rgba(52, 199, 89, 0.15);
            color: #1e7b4c;
            border-color: rgba(52, 199, 89, 0.3);
        }

        .badge-warning {
            background: rgba(255, 159, 10, 0.15);
            color: #b44e00;
            border-color: rgba(255, 159, 10, 0.3);
        }

        .badge-danger {
            background: rgba(255, 59, 48, 0.15);
            color: #bc1c1c;
            border-color: rgba(255, 59, 48, 0.3);
        }

        .badge-info {
            background: rgba(0, 113, 227, 0.15);
            color: #0051b3;
            border-color: rgba(0, 113, 227, 0.3);
        }

        /* Premium Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1d1d1f;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .form-control:focus {
            outline: none;
            border-color: #0071e3;
            box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Premium Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 14px;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .alert-success {
            background: rgba(52, 199, 89, 0.15);
            color: #1e7b4c;
            border-left: 4px solid #34c759;
        }

        .alert-error {
            background: rgba(255, 59, 48, 0.15);
            color: #bc1c1c;
            border-left: 4px solid #ff3b30;
        }

        /* Premium Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
            pointer-events: none;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.8rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: white;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            position: relative;
            z-index: 1;
        }

        /* Premium Pagination */
        .pagination {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span,
        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 0.75rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1d1d1f;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.2s ease;
            line-height: 1;
        }

        .pagination a:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: #0071e3;
            color: #0071e3;
            transform: scale(1.05);
        }

        .pagination .active span,
        .pagination .active .page-link {
            background: linear-gradient(135deg, #0071e3, #0077ed);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 113, 227, 0.3);
        }

        .pagination .disabled span,
        .pagination .disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination .pagination-previous a,
        .pagination .pagination-next a {
            gap: 0.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #86868b;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
            filter: grayscale(1);
        }

        /* Pesos Symbol */
        .pesos {
            font-weight: 700;
            color: inherit;
        }

        .pesos::before {
            content: '₱';
            margin-right: 2px;
            font-weight: 600;
            opacity: 0.9;
        }

        /* Premium Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Loading Skeleton */
        .loading-skeleton {
            background: linear-gradient(90deg, rgba(255,255,255,0.5) 25%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0.5) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('dashboard') }}" class="logo">
                <span class="logo-icon">📚</span>
                LibSys
            </a>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-link-icon">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <span class="nav-link-icon">📚</span>
                    Books
                </a>
                <a href="{{ route('members.index') }}" class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                    <span class="nav-link-icon">👥</span>
                    Members
                </a>
                <a href="{{ route('loans.index') }}" class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}">
                    <span class="nav-link-icon">📖</span>
                    Loans
                </a>
                <a href="{{ route('fines.index') }}" class="nav-link {{ request()->routeIs('fines.*') ? 'active' : '' }}">
                    <span class="nav-link-icon">⚠️</span>
                    Fines
                </a>
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <span class="nav-link-icon">📈</span>
                    Reports
                </a>

                <div class="user-menu">
                    <div class="user-avatar">
                        <span>👤</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span class="nav-link-icon">🚪</span>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                <span class="btn-icon">✅</span>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <span class="btn-icon">❌</span>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
