<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — LibSys</title>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @font-face {
            font-family: 'SF Pro Display';
            src: local('-apple-system'), local('BlinkMacSystemFont'), local('Segoe UI'), local('Roboto');
            font-weight: 300 900;
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f5f7 0%, #e8e8ed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #1d1d1f;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo i {
            font-size: 3rem;
            color: #0071e3;
            background: linear-gradient(135deg, #0071e3, #0051b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1d1d1f, #4a4a4e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 0.5rem;
            letter-spacing: -0.02em;
        }

        .logo p {
            color: #6e6e73;
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

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

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #86868b;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.8rem;
            border: 1px solid #d2d2d7;
            border-radius: 14px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #0071e3;
            box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.1);
        }

        .form-control::placeholder {
            color: #a1a1a6;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #1d1d1f;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .remember input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 1px solid #d2d2d7;
            accent-color: #0071e3;
            cursor: pointer;
        }

        .forgot-link {
            color: #0071e3;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #0051b3;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: #0071e3;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: #0077ed;
            transform: scale(1.02);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-error {
            background: #ffe9e9;
            color: #bc1c1c;
            border-left: 4px solid #ff3b30;
        }

        .demo-credentials {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f5f5f7;
            border-radius: 16px;
            text-align: center;
        }

        .demo-credentials h3 {
            color: #1d1d1f;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .demo-credentials h3 i {
            color: #ff9f0a;
        }

        .credential-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: white;
            border-radius: 10px;
            margin: 0.5rem 0;
            font-size: 0.95rem;
        }

        .credential-item i {
            color: #0071e3;
            width: 20px;
        }

        .credential-item code {
            background: #f5f5f7;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            color: #1d1d1f;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            color: #6e6e73;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fa-regular fa-building-columns"></i>
                <h1>LibSys</h1>
                <p>Library Management System</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-regular fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Enter your email"
                               value="{{ old('email') }}"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fa-regular fa-lock"></i>
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Enter your password"
                               required>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        <span>Keep me signed in</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-regular fa-arrow-right-to-bracket"></i>
                    Sign In
                </button>
            </form>

            <div class="demo-credentials">
                <h3>
                    <i class="fa-regular fa-circle-info"></i>
                    Demo Access
                </h3>
                <div class="credential-item">
                    <i class="fa-regular fa-envelope"></i>
                    <code>admin@library.com</code>
                </div>
                <div class="credential-item">
                    <i class="fa-regular fa-lock"></i>
                    <code>password</code>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} LibSys. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
