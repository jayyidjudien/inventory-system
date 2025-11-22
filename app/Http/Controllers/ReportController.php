<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
       $data = Report::with('product')->orderBy('date', 'desc')->get();

        // Hitung total check-in, check-out, dan stok
        $totalCheckIn  = $data->sum('quantity_checked_in');
        $totalCheckOut = $data->sum('quantity_checked_out');
        $totalStock    = $data->sum('current_stock');

        return view('reports.index', compact(
            'data',
            'totalCheckIn',
            'totalCheckOut',
            'totalStock'
        ));
    }

    public function generate()
    {
        // Logic generate report
        return redirect()->route('reports.index');
    }

}
