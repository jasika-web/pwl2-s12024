<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// route resource
Route::resource('/products', ProductController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/categories', CategoryController::class);

// Redirect root ke halaman login 
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Authentication 
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  ROUTE YANG DILINDUNGI LOGIN (AUTH MIDDLEWARE)
Route::middleware(['auth'])->group(function () {

    // Dashboard hanya bisa diakses kalau sudah login 
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    // Products
    Route::resource('/products', ProductController::class);

    // Supplier
    Route::resource('/suppliers', SupplierController::class);

    // Transaksi Penjualan 
    Route::resource('/transactions', TransactionController::class);

    // Categories
    Route::resource('/categories', CategoryController::class);
});
