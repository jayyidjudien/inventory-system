<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Check-In</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Check In Produk')

@push('head')
<style>
  /* Put form on white card with black text (like original) */
  .inventory-card {
    background: #020024;
    background: linear-gradient(11deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 35%, rgba(48, 193, 255, 1) 100%);
    border-radius: 8px;
    padding: 1.25rem;
    box-shadow: 0 6px 18px rgba(11,18,32,0.06);
  }

  .inventory-card .form-label {
    color: #fff;
    font-weight: 600;
  }

  .inventory-card .form-control {
    background: #fff;
    color: #0b0b0b;
    border: 1px solid #d1d5db;
  }

  .inventory-card select.form-control option {
    color: #0b0b0b;
    background: #fff;
  }

  /* keep page background from layout */
  .inventory-wrap { padding: 1.5rem; max-width: 820px; margin: 0 auto; }
</style>
@endpush

@section('content')
<div class="inventory-wrap">
  <div class="inventory-card">
    <h3 class="mb-3">Check In Produk</h3>

    <form action="{{ route('inventory.checkin.store') }}" method="POST" class="w-100" novalidate>
      @csrf

      <div class="mb-3">
        <label for="product_id" class="form-label">Produk</label>
        <select name="product_id" id="product_id" class="form-control" required>
          <option value="">Pilih produk</option>
          @foreach($products as $product)
            <option value="{{ $product->id }}">
              {{ $product->nama ?? $product->name ?? $product->kode_produk }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="quantity" class="form-label">Kuantitas</label>
        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="{{ old('quantity',1) }}" required>
      </div>

      <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->toDateString()) }}" required>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Check In</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // ensure selects render properly in browsers
  document.querySelectorAll('select.form-control').forEach(s => s.style.appearance = 'auto');
});
</script>
@endpush
</body>
</html>