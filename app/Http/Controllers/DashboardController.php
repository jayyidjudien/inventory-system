<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with basic statistics.
     */
    public function index(Request $request)
    {
        // Pastikan user terautentikasi bila route tidak memakai middleware
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $totalUsers = Schema::hasTable('users') ? DB::table('users')->count() : 0;
        $totalProducts = Schema::hasTable('products') ? DB::table('products')->count() : 0;
        $totalStock = null;
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'stock')) {
            $totalStock = DB::table('products')->sum('stock');
        }
        $products = Product::all();
        $totalValue = $products->sum(function ($product) {
        return $product->stock * $product->price;
        });


        $activityTables = ['inventory_movements', 'inventories', 'transactions', 'logs', 'checkins', 'checkouts'];
        $activityTable = null;
        foreach ($activityTables as $t) {
            if (Schema::hasTable($t)) {
                $activityTable = $t;
                break;
            }
        }

        $recentActivities = collect();
        if ($activityTable) {
            $recentActivities = DB::table($activityTable)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }

        return view('dashboard', [
            'user' => Auth::user(),
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'recentActivities' => $recentActivities,
            'totalValue' => $totalValue
        ]);
    }
}
