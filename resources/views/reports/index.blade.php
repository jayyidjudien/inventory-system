<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Reports</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Inventory Reports</h1>
        
        <div class="mb-3">
            <a href="{{ route('reports.generate') }}" class="btn btn-primary">Generate Report</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity Checked In</th>
                    <th>Quantity Checked Out</th>
                    <th>Current Stock</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Summary</h5>
            <p>Total Check-In: {{ $totalCheckIn }}</p>
            <p>Total Check-Out: {{ $totalCheckOut }}</p>
            <p>Total Current Stock: {{ $totalStock }}</p>
        </div>
    </div>

                @foreach($data as $report)
                <tr>
                    <td>{{ $report->product->name }}</td>
                    <td>{{ $report->quantity_checked_in }}</td>
                    <td>{{ $report->quantity_checked_out }}</td>
                    <td>{{ $report->current_stock }}</td>
                    <td>{{ $report->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>