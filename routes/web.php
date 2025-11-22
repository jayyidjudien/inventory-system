<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Root + Dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Product Routes (requires auth + role admin)
Route::resource('products', ProductController::class)->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin|warehouse']);

// Inventory Routes (requires auth + role admin or warehouse)
Route::prefix('inventory')
    ->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin,warehouse'])
    ->group(function () {
        // tampilkan form checkout (nama route: inventory.checkout)
        Route::get('checkout', [InventoryController::class, 'showCheckOutForm'])->name('inventory.checkout');

        // proses checkout (nama route: inventory.checkout.store)
        Route::post('checkout', [InventoryController::class, 'checkOut'])
            ->name('inventory.checkout.store');
    // Route::get('/inventory/checkout', [InventoryController::class, 'showCheckOutForm'])->name('inventory.checkout')->middleware('auth');
    // Route::post('/inventory/checkout', [InventoryController::class, 'checkOut'])->name('inventory.checkout.store')->middleware('auth');


        // jika belum ada, pastikan checkin route juga ada
        Route::get('checkin', [InventoryController::class, 'showCheckInForm'])->name('inventory.checkin');
        Route::post('checkin', [InventoryController::class, 'checkIn'])->name('inventory.checkin.store');
    });

// Report Routes
Route::get('/reports/generate', [ReportController::class, 'generate'])
    ->name('reports.generate');

Route::get('reports', [ReportController::class, 'index'])
    ->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin,warehouse'])
    ->name('reports.index');

// route admin dashboard (akses hanya admin)
Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])
    ->name('admin.dashboard');