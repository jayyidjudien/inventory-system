<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Cek apakah sedang update data, ambil ID produk dari route
        // Route: products/{product} -> parameter namanya 'product'
        $product = $this->route('product'); 
        $productId = $product ? $product->id : null;

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer',   
            'price' => 'required|numeric',
        ];

        if ($this->isMethod('POST')) {
            // === ATURAN SAAT CREATE ===
            // Wajib diisi dan harus unik
            $rules['kode_product'] = 'required|string|unique:products,kode_product|max:255';
        } else {
            // === ATURAN SAAT UPDATE ===
            // 'sometimes': Validasi hanya jalan JIKA input 'kode_product' ada di form.
            // unique:...,$productId : Cek unik tapi abaikan (ignore) milik ID ini sendiri.
            $rules['kode_product'] = 'sometimes|required|string|max:255|unique:products,kode_product,' . $productId;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'kode_product.required' => 'Kode Product wajib diisi.',
            'kode_product.unique' => 'Kode Product sudah terdaftar.',
            'name.required' => 'Nama produk wajib diisi.',
            'stock.required' => 'Stok barang wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
        ];
    }
}