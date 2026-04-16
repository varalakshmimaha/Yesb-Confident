<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Yesb Confident</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{--primary:#0A2342;--primary-light:#1a3a6b;--accent:#E8A020;--red:#C0392B;--white:#fff;--border:#e2e5ea;--transition:all .3s ease}
    body{font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);padding:20px}
    .login-card{background:var(--white);border-radius:20px;padding:48px 40px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.2);text-align:center}
    .login-logo{width:60px;height:60px;border-radius:14px;background:var(--primary);display:flex;align-items:center;justify-content:center;margin:0 auto 20px}
    .login-logo svg{width:100%;height:100%}
    .login-card h1{font-family:'Playfair Display',serif;font-size:26px;font-weight:800;color:var(--primary);margin-bottom:4px}
    .login-sub{font-size:13px;color:#777;margin-bottom:30px}
    .login-field{text-align:left;margin-bottom:16px}
    .login-field label{font-size:12px;font-weight:700;color:var(--primary);letter-spacing:.5px;text-transform:uppercase;display:block;margin-bottom:6px}
    .login-field input{width:100%;padding:13px 16px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:var(--transition)}
    .login-field input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(232,160,32,.12)}
    .login-error{background:#fdecea;color:var(--red);font-size:13px;padding:10px 14px;border-radius:8px;margin-bottom:14px;text-align:left}
    .login-error i{margin-right:6px}
    .btn-login{width:100%;padding:14px;border:none;border-radius:12px;background:linear-gradient(135deg,var(--accent),#f0b840);color:var(--primary);font-size:15px;font-weight:700;cursor:pointer;transition:var(--transition);box-shadow:0 4px 14px rgba(232,160,32,.3)}
    .btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(232,160,32,.4)}
    .back-link{display:inline-block;margin-top:20px;font-size:13px;color:#777;text-decoration:none;transition:var(--transition)}
    .back-link:hover{color:var(--accent)}
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-logo">
      <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="60" height="60" rx="14" fill="#0A2342"/>
        <path d="M10 43 L21 17 L30 36 L39 17 L50 43" stroke="#E8A020" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="30" cy="15" r="3.5" fill="#E8A020"/>
        <path d="M17 47 L43 47" stroke="#E8A020" stroke-width="2.5" stroke-linecap="round" opacity=".5"/>
      </svg>
    </div>
    <h1>Admin Panel</h1>
    <div class="login-sub">Yesb Confident — E-Commerce & Advertising</div>

    @if($errors->has('login'))
      <div class="login-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('login') }}</div>
    @endif

    <form action="{{ route('admin.authenticate') }}" method="POST">
      @csrf
      <div class="login-field">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" value="{{ old('username') }}" required>
      </div>
      <div class="login-field">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i>&nbsp; Sign In</button>
    </form>
    <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i>&nbsp; Back to Website</a>
  </div>
</body>
</html>
