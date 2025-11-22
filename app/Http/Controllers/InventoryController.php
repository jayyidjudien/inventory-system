<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CheckIn;
use App\Models\CheckOut;
use Illuminate\Http\Request;
use App\Models\Report;

class InventoryController extends Controller
{

    public function showCheckOutForm()
    {
    $products = Product::all();
    return view('inventory.checkout', compact('products'));
    }
    // Barang keluar (Check-Out)
    public function checkOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi stok cukup
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk check-out.');
        }

        CheckOut::create([
    'product_id'     => $product->id,
    'quantity'       => $request->quantity,
    'checked_out_by' => auth()->id(),   // ✅ isi user yang melakukan check-out
    'check_out_date' => now(),
    ]);


        // Kurangi stok
        $product->stock -= $request->quantity;
        $product->save();

        // Catat transaksi check-out
        CheckOut::create([
            'product_id'     => $product->id,
            'quantity'       => $request->quantity,
            'checked_out_by' => auth()->id(),
            'check_out_date' => now(),
        ]);

         $qty = $request->input('quantity');

        // Update stok produk
        $product->stock += $qty;
        $product->save();

        // Catat ke tabel reports
        Report::create([
            'product_id' => $product->id,
            'quantity_checked_in' => 0,
            'quantity_checked_out' =>$qty,
            'current_stock' => $product->stock,
            'date' => now()->toDateString(),
        ]);


        return redirect()
    ->route('products.index') // arahkan ke halaman form atau laporan
    ->with('success', 'Barang berhasil keluar (check-out).');
    }

    public function showCheckInForm()
    {
    // Ambil semua produk untuk ditampilkan di dropdown form
    $products = Product::all();

    // Tampilkan view form check-in
    return view('inventory.checkin', compact('products'));
    }

    // Barang masuk (Check-In)
    public function checkIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Tambah stok
        $product->stock += $request->quantity;
        $product->save();

        // Catat transaksi check-in
        CheckIn::create([
            'product_id'    => $product->id,
            'quantity'      => $request->quantity,
            'checked_in_by' => auth()->id(),
            'check_in_date' => now(),
        ]);

         $qty = $request->input('quantity');

        // Update stok produk
        $product->stock += $qty;
        $product->save();

        // Catat ke tabel reports
        Report::create([
            'product_id' => $product->id,
            'quantity_checked_in' => $qty,
            'quantity_checked_out' => 0,
            'current_stock' => $product->stock,
            'date' => now()->toDateString(),
        ]);


        return redirect()
        ->route('products.index')
        ->with('success', 'Barang berhasil masuk (check-in).');
    }


    // Laporan ringkas inventory
    public function report()
    {
        $products = Product::with(['checkIns', 'checkOuts'])->get();

        $totalValue = $products->sum(function ($product) {
            return $product->stock * $product->price;
        });

        return view('inventory.report', compact('products', 'totalValue'));
    }
}