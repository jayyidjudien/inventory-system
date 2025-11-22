<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Create New Product</h1>
       <form action="{{ route('products.store') }}" method="POST">
        @csrf
        
        {{-- TAMBAHKAN INPUT INI --}}
        <div class="mb-3">
            <label for="kode_product" class="form-label">Kode Product</label>
            <input type="text" class="form-control" id="kode_product" name="kode_product" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        {{-- PERBAIKI NAME MENJADI STOCK --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stock (Quantity)</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
    </div>
    @endsection
</body>
</html>