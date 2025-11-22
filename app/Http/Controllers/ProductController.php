<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        
       $data = $request->validated();

         // Generate barcode otomatis
        $data['barcode'] = 'PRD-' . strtoupper(Str::random(8));

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $generator = new BarcodeGeneratorHTML();
        $barcodeHtml = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);
        return view('products.show', compact('product', 'barcodeHtml'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

   public function update(StoreProductRequest $request, Product $product)
{
    // $request->validated() hanya akan mengambil data yang lolos validasi rules()
    // Karena di form update tidak ada 'kode_product', maka field itu tidak akan di-update (aman).
    
    $product->update($request->validated());

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}