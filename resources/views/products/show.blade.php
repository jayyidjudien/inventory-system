<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>

        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
            @can('update', $product)
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>
            @endcan
            @can('delete', $product)
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Product</button>
                </form>
            @endcan
        </div>
    </div>
    @endsection
</body>
</html>