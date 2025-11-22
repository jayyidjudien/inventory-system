<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Products</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
      :root{
        --accent-1:#1e3a8a; /* navy */
        --accent-2:#2563eb; /* biru */
        --accent-3:#0f172a; /* hitam */
        --muted: rgba(255,255,255,0.80);
        --muted-2: rgba(255,255,255,0.65);
      }

      body {
        font-family: 'Inter', sans-serif;
        background:#0f172a;
        color:#e2e8f0;
      }

      .card-sm{
        max-width:600px;
        margin:2rem auto;
        padding:1.5rem;
        border-radius:14px;
        background: linear-gradient(135deg, var(--accent-1), var(--accent-2), var(--accent-3));
        border:1px solid rgba(255,255,255,0.08);
        box-shadow:0 8px 20px rgba(0,0,0,0.6);
        transition:transform .15s ease, box-shadow .15s ease;
        color:#fff;
      }
      .card-sm:hover{
        transform:translateY(-4px);
        box-shadow:0 12px 28px rgba(0,0,0,0.7);
      }

      .card-sm h1{font-size:1.5rem;margin-bottom:1rem;color:#fff}
      label{color:var(--muted)}
      .form-control{background:#0f172a;color:#fff;border:1px solid rgba(255,255,255,0.2)}
      .form-control:focus{background:#1e293b;color:#fff}
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="card-sm">
            <h1>Checkout Products</h1>
            <form action="{{ route('inventory.checkout') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="product_id">Select Product</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                </div>
                <button type="submit" class="btn btn-light fw-bold">Checkout</button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>