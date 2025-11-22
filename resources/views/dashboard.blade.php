<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard — Inventory System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  @stack('head')
  <style>
    :root{
      --accent-1:#7c3aed; --accent-2:#06b6d4;
      --muted: rgba(255,255,255,0.80);
      --muted-2: rgba(255,255,255,0.65);
      --panel: rgba(255,255,255,0.03);
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #0f172a;
      color: #e2e8f0;
    }

    .topbar {
      display:flex;justify-content:space-between;align-items:center;
      padding:1rem 1.5rem;
      background:linear-gradient(90deg,#1e293b,#0f172a);
      border-bottom:1px solid rgba(255,255,255,0.08);
      box-shadow:0 4px 12px rgba(0,0,0,0.4);
      border-radius:0 0 12px 12px;
      margin-bottom:1.5rem;
    }
    .brand{display:flex;align-items:center;gap:.75rem;font-weight:700;color:#fff}
    .logo-dot{width:12px;height:12px;border-radius:50%;background:var(--accent-1)}

    .dash-wrap{max-width:1100px;margin:0 auto;padding:1.25rem}
    .cards{display:flex;gap:1rem;flex-wrap:wrap}
    .card-sm{
      flex:1;min-width:200px;padding:1.25rem;border-radius:14px;
      background: linear-gradient(180deg, #1e293b, #0f172a);
      border:1px solid rgba(255,255,255,0.06);
      box-shadow:0 8px 20px rgba(0,0,0,0.5);
      transition:transform .15s ease, box-shadow .15s ease;
    }
    .card-sm:hover{transform:translateY(-4px);box-shadow:0 12px 24px rgba(0,0,0,0.6)}
    .card-sm .label{color:var(--muted);font-size:.95rem;font-weight:600}
    .card-sm .value{font-size:1.8rem;font-weight:800;margin-top:.25rem;color:#fff}

    .quick {display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.6rem}
    .quick a{
      display:inline-flex;align-items:center;gap:.5rem;padding:.55rem 1rem;border-radius:10px;
      color:#fff;font-weight:600;text-decoration:none;
      background: linear-gradient(90deg,var(--accent-1),var(--accent-2));
      box-shadow: 0 6px 16px rgba(12,24,60,0.35);
      border:1px solid rgba(255,255,255,0.06);
      transition: transform .12s ease, opacity .12s;
    }
    .quick a.secondary{
      background: linear-gradient(90deg,#334155,#0b1220);
      color:#e6eefb;border:1px solid rgba(255,255,255,0.04);
    }
    .quick a:hover{ transform:translateY(-3px); opacity:0.95 }

    table.table td, table.table th{vertical-align:middle;color:#e2e8f0}
    table.table thead th{
      color:#f1f5f9;font-weight:700;
      border-bottom:1px solid rgba(255,255,255,0.08);
    }
    table.table tbody tr:nth-child(even){background-color:rgba(255,255,255,0.02)}

    .muted{color:var(--muted-2)}
    .muted-strong{color:var(--muted)}
    .subtitle{color:var(--muted-2)}

    @media(max-width:900px){
      .cards{gap:.8rem}
      .topbar{flex-direction:column;align-items:flex-start;gap:1rem}
    }
  </style>
</head>
<body>
  <div class="container app-shell">
    <div class="topbar">
      <div class="brand">
        <span class="logo-dot" aria-hidden="true"></span>
        <div>
          <div>Inventory System</div>
          <div class="small-muted">Ringkasan & aktivitas</div>
        </div>
      </div>

      <div class="d-flex align-items-center gap-3">
        <div class="text-end me-2">
          <div class="small-muted">Hi, <strong>{{ $user->name ?? auth()->user()->name ?? 'User' }}</strong></div>
          <div class="small-muted">{{ auth()->user()->email ?? '' }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
      </div>
    </div>

    <!-- isi dashboard -->

<div class="dash-wrap">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h4 class="mb-0">Dashboard</h4>
      <div class="subtitle">Ikhtisar cepat sistem inventori</div>
    </div>
    <div class="text-end">
      <div class="muted-strong">Hi, <strong>{{ $user->name ?? auth()->user()->name ?? 'User' }}</strong></div>
      <div class="muted">{{ auth()->user()->email ?? '' }}</div>
    </div>
  </div>

  <div class="cards mb-3">
    <div class="card-sm">
      <div class="label">Total Produk</div>
      <div class="value">{{ number_format($totalProducts ?? 0) }}</div>
    </div>

    <div class="card-sm">
      <div class="label">Total Nilai Persediaan</div>
      <div class="value">Rp {{ number_format($totalValue ?? 0, 0, ',', '.') }}</div>
    </div>

    <div class="card-sm">
        <div class="label">Total Stok</div>
        <div class="value">{{ number_format($totalStock ?? 0) }}</div>
    </div>
    
    <div class="card-sm">
      <div class="label">Total Pengguna</div>
      <div class="value">{{ number_format($totalUsers ?? 0) }}</div>
    </div>
</div>

  <div class="card-sm mb-3">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <div class="label">Menu Cepat</div>
        <div class="quick">
          <a href="{{ route('products.index') }}">Daftar Produk</a>
          <a href="{{ route('inventory.checkin') }}" class="secondary">Check-in</a>
          <a href="{{ route('inventory.checkout') }}" class="secondary">Check-out</a>
          <a href="{{ route('reports.index') }}" class="secondary">Laporan</a>
        </div>
      </div>
      <div class="muted">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</div>
    </div>
  </div>

  <div class="card-sm recent">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div class="label">Pergerakan Produk Terbaru</div>
      <div class="muted small">Menampilkan 10 terbaru</div>
    </div>

    @if(!empty($recentActivities) && count($recentActivities))
      <div class="table-responsive">
        <table class="table table-dark table-sm mb-0">
          <thead>
            <tr>
              <th>Waktu</th>
              <th>Aksi</th>
              <th>Produk</th>
              <th class="text-end">Qty</th>
            </tr>
          </thead>
          <tbody>
            @foreach(collect($recentActivities)->take(10) as $act)
              <tr>
                <td class="muted" style="min-width:140px;">{{ isset($act->created_at) ? \Carbon\Carbon::parse($act->created_at)->format('d M Y H:i') : '-' }}</td>
                <td class="muted-strong">{{ $act->action ?? $act->type ?? '-' }}</td>
                <td class="muted">{{ $act->product_name ?? $act->nama ?? ($act->product ?? '-') }}</td>
                <td class="text-end muted-strong">{{ $act->qty ?? $act->quantity ?? '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="muted">Belum ada pergerakan produk.</div>
    @endif
  </div>
</div>

<div class="text-center small-muted mt-4">© {{ date('Y') }} PT. Solusi Inventori</div>
</div>

  @stack('scripts')
</body>
</html>