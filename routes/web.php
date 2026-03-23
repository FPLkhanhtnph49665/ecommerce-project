<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Trang client

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Route admin gộp vào web.php luôn
Route::prefix('admin')
    ->middleware(['auth', 'admin']) // middleware admin vẫn dùng bình thường
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('products', ProductController::class);
        // Route::resource('orders', OrderController::class);
    });
require __DIR__.'/auth.php';
