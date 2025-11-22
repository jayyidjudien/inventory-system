<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Welcome — Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg-1:#071027;
            --bg-2:#08122a;
            --accent-1:#7c3aed;
            --accent-2:#06b6d4;
            --muted: rgba(255,255,255,0.75);
            --panel: rgba(2,6,23,0.6);
            --panel-strong: rgba(2,6,23,0.75);
        }
        html,body{height:100%;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;}
        body{
            margin:0;
            color:#fff;
            background:
                radial-gradient(1200px 600px at 10% 10%, rgba(124,58,237,0.08), transparent 8%),
                radial-gradient(1000px 500px at 90% 90%, rgba(6,182,212,0.04), transparent 8%),
                linear-gradient(180deg,var(--bg-1),var(--bg-2));
            -webkit-font-smoothing:antialiased;
        }

        .navbar { background: transparent; }
        .brand { font-weight:700; letter-spacing:0.2px; color:#fff; text-shadow: 0 2px 8px rgba(2,6,23,0.6); }

        .hero {
            padding:6rem 0;
            position:relative;
            overflow:hidden;
        }

        /* reduce shape prominence */
        .shape { opacity:.08; filter: blur(40px); }

        /* Panel behind left content to improve readability */
        .left-panel {
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));
            border: 1px solid rgba(255,255,255,0.04);
            padding: 2rem;
            border-radius: 12px;
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 30px rgba(2,6,23,0.55);
        }

        /* Animated gradient headline with stronger contrast & shadow */
        .headline{
            font-size:2.25rem;
            line-height:1.05;
            font-weight:800;
            background: linear-gradient(90deg,var(--accent-1), #9f7aea, var(--accent-2));
            background-size:200% 100%;
            -webkit-background-clip:text;
            background-clip:text;
            color:transparent;
            animation: slideGradient 6s linear infinite;
            margin-bottom:0.5rem;
            text-shadow: 0 6px 30px rgba(14,20,40,0.55);
        }
        @keyframes slideGradient{
            0%{background-position:0% 50%;}
            50%{background-position:100% 50%;}
            100%{background-position:0% 50%;}
        }

        /* moving subheadline (soft marquee) with readable pill background */
        .subhead-wrap{ overflow:hidden; }
        .subhead {
            display:inline-block;
            color:var(--muted);
            background: rgba(255,255,255,0.03);
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            transform:translateX(0);
            animation: moveText 14s linear infinite;
            white-space:nowrap;
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.03);
        }
        @keyframes moveText{
            0%{transform:translateX(0%);}
            50%{transform:translateX(-25%);}
            100%{transform:translateX(0%);}
        }

        .card-ghost{
            background: var(--panel);
            border: 1px solid rgba(255,255,255,0.04);
            backdrop-filter: blur(6px);
            color:#fff;
            border-radius:10px;
        }

        .btn-primary {
            background: linear-gradient(90deg,var(--accent-1),var(--accent-2));
            border: none;
            box-shadow: 0 8px 26px rgba(12,24,60,0.45);
            font-weight:600;
        }
        .btn-outline {
            color: #dbeafe;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.02);
            font-weight:600;
        }

        .features .card-ghost { transition: transform .35s ease, box-shadow .35s ease; }
        .features .card-ghost:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(2,6,23,0.6); }

        footer { background:transparent; color:rgba(255,255,255,0.7); padding:2rem 0; }
        @media (min-width:992px){ .headline{font-size:3rem;} }
        /* improve text readability */
        .lead-contrast { color: rgba(255,255,255,0.88); font-size:1.05rem; line-height:1.6; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand brand" href="#">Inventory System</a>
        <div class="d-flex">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </div>
</nav>

<header class="hero">
    <div class="shape s1" aria-hidden="true"></div>
    <div class="shape s2" aria-hidden="true"></div>

    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <div class="left-panel">
                    <h1 class="headline">PT. Solusi Inventori — Kendalikan Stok, Percepat Bisnis</h1>

                    <div class="mb-3 subhead-wrap" style="max-width:760px;">
                        <div class="subhead">Management stok otomatis • Checkout cepat • Laporan real‑time • Integrasi cloud</div>
                    </div>

                    <p class="lead-contrast mb-4">
                        Sistem inventori modern untuk usaha retail, distributor, dan gudang. Mudah digunakan oleh admin dan kasir/gudang — aman, cepat, dan dapat diskalakan.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login', ['role' => 'admin']) }}" class="btn btn-primary btn-lg">Login Admin</a>
                        <a href="{{ route('login', ['role' => 'warehouse']) }}" class="btn btn-outline btn-lg">Login Kasir / Gudang</a>
                    </div>

                    <div class="mt-4" style="color:rgba(255,255,255,0.68); font-size:0.95rem;">
                        Butuh demo? <a href="mailto:info@solusi-inventori.example" class="text-white text-decoration-underline">Hubungi kami</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-ghost p-4 shadow-sm">
                    <div class="row g-3 align-items-center">
                        <div class="col-5 text-center">
                            <img src="https://via.placeholder.com/360x240?text=Inventory+Dashboard" class="img-fluid rounded" alt="illustration">
                        </div>
                        <div class="col-7">
                            <h5 class="mb-1" style="color:rgba(255,255,255,0.94); font-weight:700;">Ringkasan Sistem</h5>
                            <p class="small" style="color:rgba(255,255,255,0.75); margin-bottom:0.6rem;">Dashboard intuitif, notifikasi level minimum, dan laporan yang mudah diekspor.</p>

                            <ul class="list-unstyled small" style="color:rgba(255,255,255,0.72); margin-bottom:0;">
                                <li>• Manajemen produk & kategori</li>
                                <li>• Transaksi check-in / check-out</li>
                                <li>• Laporan per periode & export CSV</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="features mt-4 row g-3">
                    <div class="col-md-4">
                        <div class="card card-ghost p-3">
                            <div class="h5 mb-1">📦 Stok</div>
                            <div class="small" style="color:rgba(255,255,255,0.74);">Pantau stok real-time</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-ghost p-3">
                            <div class="h5 mb-1">🧾 Transaksi</div>
                            <div class="small" style="color:rgba(255,255,255,0.74);">Proses cepat untuk kasir</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-ghost p-3">
                            <div class="h5 mb-1">📊 Laporan</div>
                            <div class="small" style="color:rgba(255,255,255,0.74);">Eksport & analisa</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<footer>
    <div class="container text-center">
        © {{ date('Y') }} PT. Solusi Inventori — Semua hak cipta dilindungi.
    </div>
</footer>

</body>
</html>