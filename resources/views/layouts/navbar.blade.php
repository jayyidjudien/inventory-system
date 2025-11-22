
<nav class="navbar navbar-expand-lg navbar-dark" style="background:linear-gradient(90deg,#071027,#0b1220);box-shadow:0 6px 20px rgba(2,6,23,0.6);">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:linear-gradient(90deg,#7c3aed,#06b6d4);margin-right:.6rem;"></span>
      <span class="fw-bold">Inventory System</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="invDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Inventory</a>
          <ul class="dropdown-menu" aria-labelledby="invDropdown">
            <li><a class="dropdown-item" href="{{ route('inventory.checkin') }}">Check-in</a></li>
            <li><a class="dropdown-item" href="{{ route('inventory.checkout') }}">Check-out</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Laporan</a></li>
      </ul>

      <div class="d-flex align-items-center gap-2">
        @auth
          <div class="text-white text-truncate me-2" style="max-width:160px;">
            <small class="text-muted d-block">Signed in as</small>
            <strong style="font-size:.95rem">{{ Auth::user()->name }}</strong>
          </div>

          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
        @endauth
      </div>
    </div>
  </div>
</nav>