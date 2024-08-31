<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * Admin Routes
     */

    // Route::middleware('can:isAdmin')->group(function () {});

    // Categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::patch('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Products
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::patch('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    /**
     * Customer Routes
     */
    // Products
    Route::get('/products', [ProductController::class, 'indexCustomer'])->name('customer.products.index');
    Route::get('/products/{product}', [ProductController::class, 'showCustomer'])->name('customer.products.show');

    // Orders
    Route::post('/products', [OrderController::class, 'store'])->name('customer.products.store');

    // Profile Page
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
