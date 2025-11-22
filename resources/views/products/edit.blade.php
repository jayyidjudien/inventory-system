@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
        <label class="form-label">Kode Produk</label>
        {{-- Disabled agar user tidak bisa sembarangan ganti kode --}}
        <input type="text" class="form-control" value="{{ $product->kode_product }}" disabled>
        {{-- Input hidden tidak diperlukan karena kita pakai 'sometimes' di validasi --}}
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock"
                   value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>
@endsection