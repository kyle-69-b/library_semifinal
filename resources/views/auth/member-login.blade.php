<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Member Sign In — LibryKyle</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root {
    --navy:    #0d1b2a;
    --navy2:   #162336;
    --navy3:   #1f3044;
    --gold:    #c9a84c;
    --gold2:   #e8c97a;
    --teal:    #2a9d8f;
    --teal2:   #3dbdad;
    --text:    #e8e4da;
    --text2:   #a8a49c;
    --text3:   #6e6b65;
    --border:  rgba(201,168,76,0.16);
    --border2: rgba(255,255,255,0.08);
    --tborder: rgba(42,157,143,0.22);
    --danger:  #d9534f;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Outfit', sans-serif;
    background: var(--navy);
    color: var(--text);
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 480px;
  }

  /* ── LEFT PANEL ── */
  .left-panel {
    position: relative; padding: 48px 56px;
    display: flex; flex-direction: column; justify-content: space-between;
    overflow: hidden; border-right: 1px solid var(--border2);
  }
  .left-panel::before {
    content: ''; position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(42,157,143,0.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(42,157,143,0.04) 1px, transparent 1px);
    background-size: 48px 48px;
  }
  .left-panel::after {
    content: ''; position: absolute; bottom: -10%; right: -10%;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(42,157,143,0.09) 0%, transparent 65%);
    pointer-events: none;
  }
  .left-content { position: relative; z-index: 1; }

  .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 80px; }
  .brand-link { text-decoration: none; display: flex; align-items: center; gap: 12px; }
  .brand-icon {
    width: 40px; height: 40px; background: var(--gold); border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: var(--navy); font-size: 17px;
  }
  .brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px; font-weight: 700; color: var(--text);
  }
  .brand-name span { color: var(--gold); }

  /* Member badge on left panel */
  .member-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(42,157,143,0.12);
    border: 1px solid var(--tborder);
    color: var(--teal2); font-size: 11px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    padding: 6px 14px; border-radius: 100px;
    margin-bottom: 24px; width: fit-content;
  }
  .member-badge::before {
    content: ''; width: 6px; height: 6px;
    background: var(--teal2); border-radius: 50%;
  }

  .left-headline {
    font-family: 'Cormorant Garamond', serif;
    font-size: 50px; font-weight: 700;
    line-height: 1.1; color: var(--text); margin-bottom: 24px;
  }
  .left-headline em { font-style: italic; color: var(--teal2); }
  .left-sub {
    font-size: 15px; font-weight: 300; color: var(--text2);
    line-height: 1.7; max-width: 420px; margin-bottom: 48px;
  }

  .member-perks { display: flex; flex-direction: column; gap: 14px; }
  .perk-item {
    display: flex; align-items: center; gap: 14px;
    font-size: 14px; color: var(--text2);
  }
  .perk-dot {
    width: 28px; height: 28px;
    border: 1px solid var(--tborder); border-radius: 6px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    color: var(--teal2); font-size: 12px;
  }

  /* Switch to admin link */
  .switch-box {
    margin-top: 40px; padding: 16px 18px;
    background: rgba(201,168,76,0.06);
    border: 1px solid var(--border); border-radius: 10px;
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
  }
  .switch-box-text { font-size: 13px; color: var(--text2); line-height: 1.4; }
  .switch-box-text strong { color: var(--text); display: block; font-size: 13px; margin-bottom: 2px; }
  .switch-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--gold); color: var(--navy);
    font-size: 12px; font-weight: 600; padding: 8px 16px;
    border-radius: 6px; text-decoration: none; white-space: nowrap;
    transition: background 0.2s;
  }
  .switch-btn:hover { background: var(--gold2); }

  .left-footer { position: relative; z-index: 1; }
  .left-footer-links { display: flex; gap: 20px; margin-bottom: 10px; }
  .left-footer-links a {
    font-size: 12px; color: var(--text3); text-decoration: none; transition: color 0.2s;
  }
  .left-footer-links a:hover { color: var(--teal2); }
  .left-footer p { font-size: 12px; color: var(--text3); }

  /* ── RIGHT PANEL ── */
  .right-panel {
    background: var(--navy2);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    padding: 56px 48px;
  }
  .form-wrapper { width: 100%; max-width: 360px; }

  /* Member accent top bar on right panel */
  .right-panel-accent {
    width: 100%; height: 3px;
    background: linear-gradient(90deg, var(--teal), var(--teal2));
    position: absolute; top: 0; left: 0;
    border-radius: 0 0 0 0;
  }
  .right-panel { position: relative; }

  .back-link {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: var(--text2); text-decoration: none;
    margin-bottom: 36px; transition: color 0.2s; width: fit-content;
  }
  .back-link:hover { color: var(--teal2); }

  .form-header { margin-bottom: 32px; }
  .form-header h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px; font-weight: 700; color: var(--text); margin-bottom: 6px;
  }
  .form-header p { font-size: 14px; color: var(--text2); }

  .role-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(42,157,143,0.1); border: 1px solid var(--tborder);
    color: var(--teal2); font-size: 11px; font-weight: 600;
    letter-spacing: 0.1em; text-transform: uppercase;
    padding: 4px 10px; border-radius: 100px; margin-bottom: 14px;
  }

  .alert-error {
    display: flex; align-items: center; gap: 10px;
    background: rgba(217,83,79,0.1); border: 1px solid rgba(217,83,79,0.3);
    color: var(--danger); border-radius: 8px;
    padding: 11px 14px; font-size: 13px; margin-bottom: 22px;
  }

  .form-group { margin-bottom: 20px; }
  .form-label {
    display: block; font-size: 11px; font-weight: 600; color: var(--text2);
    letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 8px;
  }
  .input-wrap { position: relative; }
  .input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: var(--text3); font-size: 14px; pointer-events: none;
  }
  .form-control {
    width: 100%; background: var(--navy3); border: 1px solid var(--border2);
    color: var(--text); padding: 11px 14px 11px 40px; border-radius: 8px;
    font-size: 14px; font-family: 'Outfit', sans-serif; transition: border-color 0.2s;
  }
  .form-control::placeholder { color: var(--text3); }
  .form-control:focus { outline: none; border-color: var(--teal); }

  .form-row {
    display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px;
  }
  .remember-label {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: var(--text2); cursor: pointer;
  }
  .remember-label input[type="checkbox"] {
    width: 16px; height: 16px;
    accent-color: var(--teal); cursor: pointer;
  }
  .forgot-link {
    font-size: 13px; color: var(--teal2); text-decoration: none; transition: color 0.2s;
  }
  .forgot-link:hover { color: var(--teal); }

  .btn-submit {
    width: 100%; background: var(--teal); color: #fff; border: none;
    padding: 13px 20px; border-radius: 8px;
    font-size: 14px; font-weight: 600; font-family: 'Outfit', sans-serif;
    cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: background 0.2s, transform 0.15s; letter-spacing: 0.04em;
  }
  .btn-submit:hover { background: var(--teal2); transform: translateY(-1px); }
  .btn-submit:active { transform: translateY(0); }

  /* Demo box */
  .demo-box {
    margin-top: 24px; border: 1px solid var(--border);
    border-radius: 10px; overflow: hidden;
  }
  .demo-box-header {
    background: rgba(201,168,76,0.08); padding: 10px 16px;
    display: flex; align-items: center; gap: 8px;
    font-size: 11px; font-weight: 600; color: var(--gold);
    letter-spacing: 0.1em; text-transform: uppercase;
  }
  .demo-rows { padding: 14px 16px; display: flex; flex-direction: column; gap: 10px; }
  .demo-row { display: flex; align-items: center; justify-content: space-between; font-size: 13px; }
  .demo-row-label { display: flex; align-items: center; gap: 8px; color: var(--text2); }
  .demo-row-label i { color: var(--text3); font-size: 12px; width: 14px; }
  .demo-code {
    font-family: 'Outfit', monospace; background: var(--navy3);
    color: var(--gold2); padding: 3px 10px; border-radius: 5px;
    font-size: 12px; border: 1px solid var(--border);
  }

  /* Member demo box — teal variant */
  .demo-box.member-demo { border-color: var(--tborder); }
  .demo-box.member-demo .demo-box-header {
    background: rgba(42,157,143,0.08); color: var(--teal2);
  }
  .demo-box.member-demo .demo-code { color: var(--teal2); border-color: var(--tborder); }

  .demo-separator {
    display: flex; align-items: center; gap: 10px; margin: 14px 0 0;
  }
  .demo-sep-line { flex: 1; height: 1px; background: var(--border); }
  .demo-sep-label { font-size: 10px; color: var(--text3); letter-spacing: 0.08em; text-transform: uppercase; }

  .form-footer { margin-top: 24px; text-align: center; font-size: 12px; color: var(--text3); }

  @media (max-width: 860px) {
    body { grid-template-columns: 1fr; }
    .left-panel { display: none; }
    .right-panel { min-height: 100vh; padding: 40px 24px; }
  }
</style>
</head>
<body>

  {{-- ===== LEFT PANEL ===== --}}
  <div class="left-panel">
    <div class="left-content">

      <div class="brand">
        <a href="{{ route('home') }}" class="brand-link">
          <div class="brand-icon"><i class="fas fa-book-open"></i></div>
          <div class="brand-name">Libry<span>Kyle</span></div>
        </a>
      </div>

      <div class="member-badge">Member Portal</div>

      <div class="left-headline">
        Your reading<br>journey,<br><em>at a glance.</em>
      </div>
      <div class="left-sub">
        Access your personal library account — view your active loans, check due dates, see your borrowing history, and monitor any outstanding fines.
      </div>

      <div class="member-perks">
        <div class="perk-item">
          <div class="perk-dot"><i class="fas fa-book-open"></i></div>
          View your active borrowed books
        </div>
        <div class="perk-item">
          <div class="perk-dot"><i class="fas fa-calendar-check"></i></div>
          Track due dates and avoid fines
        </div>
        <div class="perk-item">
          <div class="perk-dot"><i class="fas fa-clock-rotate-left"></i></div>
          Browse your full borrowing history
        </div>
        <div class="perk-item">
          <div class="perk-dot"><i class="fas fa-peso-sign"></i></div>
          Check and settle outstanding fines
        </div>
      </div>

      {{-- Switch to admin --}}
      <div class="switch-box">
        <div class="switch-box-text">
          <strong>Are you a librarian?</strong>
          Sign in to the admin panel instead.
        </div>
        <a href="{{ route('login') }}" class="switch-btn">
          <i class="fas fa-shield-halved"></i> Admin Login
        </a>
      </div>

    </div>

    <div class="left-footer">
      <div class="left-footer-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('home') }}#features">Features</a>
        <a href="{{ route('login') }}">Admin Login</a>
      </div>
      <p>&copy; {{ date('Y') }} LibryKyle. All rights reserved.</p>
    </div>
  </div>

  {{-- ===== RIGHT PANEL ===== --}}
  <div class="right-panel">
    <div class="right-panel-accent"></div>
    <div class="form-wrapper">

      <a href="{{ route('home') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
      </a>

      <div class="form-header">
        <div class="role-tag"><i class="fas fa-user"></i> Member Access</div>
        <h2>Member Sign In</h2>
        <p>Access your personal library account</p>
      </div>

      @if($errors->any())
      <div class="alert-error">
        <i class="fas fa-circle-exclamation"></i>
        {{ $errors->first() }}
      </div>
      @endif

      <form method="POST" action="{{ route('member.login.submit') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <div class="input-wrap">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" name="email" class="form-control"
                   placeholder="your@email.com"
                   value="{{ old('email') }}" required autofocus>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <div class="input-wrap">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="password" class="form-control"
                   placeholder="••••••••" required>
          </div>
        </div>

        <div class="form-row">
          <label class="remember-label">
            <input type="checkbox" name="remember">
            <span>Keep me signed in</span>
          </label>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fas fa-arrow-right-to-bracket"></i>
          Sign In as Member
        </button>
      </form>

      {{-- Admin Demo Credentials --}}
      <div class="demo-box" style="margin-top:24px;">
        <div class="demo-box-header">
          <i class="fas fa-circle-info"></i>
          Demo Credentials
        </div>
        <div class="demo-rows">
          <div class="demo-row">
            <div class="demo-row-label"><i class="fas fa-envelope"></i> Email</div>
            <div class="demo-code">admin@library.com</div>
          </div>
          <div class="demo-row">
            <div class="demo-row-label"><i class="fas fa-lock"></i> Password</div>
            <div class="demo-code">password</div>
          </div>
        </div>

        {{-- Member Credentials below --}}
        <div class="demo-separator" style="padding: 0 16px;">
          <div class="demo-sep-line"></div>
          <div class="demo-sep-label">Member Credentials</div>
          <div class="demo-sep-line"></div>
        </div>
        <div class="demo-rows" style="padding-top:10px;">
          <div class="demo-row">
            <div class="demo-row-label"><i class="fas fa-envelope"></i> Email</div>
            <div class="demo-code" style="color:var(--teal2); border-color:var(--tborder);">member1@example.com</div>
          </div>
          <div class="demo-row">
            <div class="demo-row-label"><i class="fas fa-lock"></i> Password</div>
            <div class="demo-code" style="color:var(--teal2); border-color:var(--tborder);">member123</div>
          </div>
        </div>
      </div>

      <div class="form-footer">
        Protected by LibryKyle authentication
      </div>

    </div>
  </div>

</body>
</html>
