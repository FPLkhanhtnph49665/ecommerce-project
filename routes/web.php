<?php

use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;


use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\CheckoutController as ClientCheckoutController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use Illuminate\Support\Facades\Route;

// Trang client

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sanpham', [ClientProductController::class, 'index'])->name('products.index');
Route::get('/sanpham/{slug}', [ClientProductController::class, 'show'])->name('products.show');

Route::prefix('cart')->group(function () {
    Route::get('/', [ClientCartController::class, 'index'])->name('cart.index');
    Route::post('/them/{id}', [ClientCartController::class, 'add'])->name('cart.add');
    Route::post('/cap-nhat/{id}', [ClientCartController::class, 'update'])->name('cart.update');
    Route::get('/xoa/{id}', [ClientCartController::class, 'remove'])->name('cart.remove');
});


Route::get('/checkout', [ClientCheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout.index');

Route::post('/checkout', [ClientCheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');


Route::middleware('auth')->group(function () {
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [ClientOrderController::class, 'show'])->name('orders.show');
});

// Route admin gộp vào web.php luôn
Route::prefix('admin')
    ->middleware(['auth', 'admin']) // middleware admin vẫn dùng bình thường
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });
require __DIR__.'/auth.php';
