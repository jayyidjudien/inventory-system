
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login — Inventory System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg-1:#0b1220;
      --bg-2:#071027;
      --card:#081223aa;
      --accent-1:#7c3aed;
      --accent-2:#06b6d4;
      --muted:rgba(255,255,255,0.75);
    }
    html,body{height:100%;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;}
    body{
      margin:0;
      background:
        radial-gradient(600px 300px at 10% 10%, rgba(124,58,237,0.07), transparent 10%),
        radial-gradient(500px 240px at 90% 90%, rgba(6,182,212,0.04), transparent 10%),
        linear-gradient(180deg,var(--bg-1),var(--bg-2));
      -webkit-font-smoothing:antialiased;
      color:#fff;
    }

    .center-wrap{min-height:100vh; display:flex; align-items:center; justify-content:center; padding:2rem;}
    .auth-card{
      width:100%; max-width:420px;
      background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
      border:1px solid rgba(255,255,255,0.06);
      border-radius:14px;
      padding:1.75rem;
      box-shadow: 0 10px 30px rgba(2,6,23,0.6);
      backdrop-filter: blur(6px);
    }

    .brand { font-weight:700; letter-spacing:0.3px; color:#fff; margin-bottom:0.75rem; display:flex; align-items:center; gap:.6rem; }
    .logo-dot{width:12px;height:12px;border-radius:50%; background:linear-gradient(90deg,var(--accent-1),var(--accent-2)); box-shadow:0 6px 18px rgba(12,24,60,0.35);}

    label.small-muted{font-size:.85rem;color:var(--muted);}

    .form-control {
      background: rgba(255,255,255,0.02);
      border:1px solid rgba(255,255,255,0.06);
      color:#fff;
    }
    .form-control:focus{ box-shadow: 0 8px 30px rgba(12,24,60,0.25); border-color: rgba(124,58,237,0.6); }

    .btn-primary {
      background: linear-gradient(90deg,var(--accent-1),var(--accent-2));
      border:none;
      font-weight:600;
      box-shadow: 0 8px 26px rgba(12,24,60,0.45);
    }
    .or-sep { text-align:center; margin:1rem 0; color:rgba(255,255,255,0.5); font-size:.85rem; }
    .link-ghost { color:var(--muted); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.06); }

    .help { font-size:.85rem; color:rgba(255,255,255,0.66); margin-top:.6rem; }

    .footer-note{ text-align:center; color:rgba(255,255,255,0.55); margin-top:1rem; font-size:.9rem; }

    .role-badge {
      display:inline-block; padding:.18rem .5rem; font-size:.75rem; background:rgba(255,255,255,0.03);
      border:1px solid rgba(255,255,255,0.03); border-radius:999px; color:var(--muted);
    }

    @media (max-width:420px){
      .auth-card{ padding:1rem; border-radius:12px; }
    }
  </style>
</head>
<body>
  <div class="center-wrap">
    <div class="auth-card">
      <div class="d-flex justify-content-between align-items-start mb-2">
        <div>
          <div class="brand">
            <span class="logo-dot" aria-hidden="true"></span>
            <span>Inventory System</span>
          </div>
          <div class="label small-muted">Masuk ke akun Anda</div>
        </div>
        <div class="role-badge">Kasir / Admin</div>
      </div>

      @if(session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger small">
          <ul class="mb-0">
            @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="mt-3">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label small-muted">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                 class="form-control @error('email') is-invalid @enderror" placeholder="nama@contoh.com">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
          <label for="password" class="form-label small-muted">Password</label>
          <div class="input-group">
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
            <button type="button" class="btn btn-outline-secondary" id="togglePassword" title="Tampilkan / sembunyikan">
              👁
            </button>
          </div>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label small-muted" for="remember">Remember me</label>
          </div>
          <div>
            @if(Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="link-ghost small-muted">Lupa password?</a>
            @endif
          </div>
        </div>

        <div class="d-grid mb-2">
          <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </div>

        <div class="or-sep">atau</div>

        {{-- Register Kasir only --}}
        <div class="d-grid mb-1">
          <a href="{{ Route::has('register') ? route('register', ['role' => 'warehouse']) : url('/register?role=warehouse') }}"
             class="btn btn-outline-light">Register Kasir</a>
        </div>
        <div class="help">
          Pendaftaran hanya untuk Kasir/Gudang. Akun Admin harus dibuat oleh administrator sistem.
        </div>
      </form>

      <div class="footer-note">
        © {{ date('Y') }} PT. Solusi Inventori — <span style="color:rgba(255,255,255,0.6)">All rights reserved</span>
      </div>
    </div>
  </div>

  <script>
    // Toggle password visibility (progressive enhancement)
    (function(){
      const pwd = document.getElementById('password');
      const btn = document.getElementById('togglePassword');
      if(!pwd || !btn) return;
      btn.addEventListener('click', () => {
        const t = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
        pwd.setAttribute('type', t);
      });
    })();
  </script>
</body>
</html>