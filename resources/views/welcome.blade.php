<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Library Management System</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 30px;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .btn-login {
            background: white;
            color: #667eea !important;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600 !important;
        }

        .hero {
            text-align: center;
            padding: 80px 0;
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 18px;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card i {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            opacity: 0.8;
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: #667eea;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            margin-top: 80px;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/" class="logo">
                <i class="fas fa-book-open"></i> LibraryMS
            </a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            </div>
        </nav>

        <div class="hero">
            <h1>Modern Library Management<br>System for the Digital Age</h1>
            <p>Streamline your library operations with our comprehensive management solution. Track books, manage members, handle loans, and generate reports with ease.</p>
            <a href="{{ route('login') }}" class="cta-button">
                <i class="fas fa-sign-in-alt"></i> Get Started
            </a>
        </div>

        <div class="features" id="features">
            <div class="feature-card">
                <i class="fas fa-book"></i>
                <h3>Book Management</h3>
                <p>Easily manage your entire book inventory with categories, authors, and real-time availability tracking.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Member Management</h3>
                <p>Keep track of all library members, their borrowing history, and membership status.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-hand-holding-heart"></i>
                <h3>Loan Tracking</h3>
                <p>Monitor active loans, due dates, and automatic fine calculation for overdue items.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chart-bar"></i>
                <h3>Reports & Analytics</h3>
                <p>Generate comprehensive reports and PDF exports of library statistics and activities.</p>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Library Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
