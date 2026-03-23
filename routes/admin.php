<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\OrderController;
use App\Http\Middleware\AdminMiddleware;

Route::prefix('admin')
    ->middleware(['web', 'auth', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        // Route::resource('products', ProductController::class);
        // Route::resource('orders', OrderController::class);
    });
