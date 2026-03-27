<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\CheckoutController as ClientCheckoutController;
use App\Http\Controllers\Client\ContactController as ClientContactController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Trang client

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sanpham', [ClientProductController::class, 'index'])->name('products.index');
Route::get('/sanpham/{slug}', [ClientProductController::class, 'show'])->name('products.show');
Route::get('/ho-so-ca-nhan', [ClientProfileController::class, 'index'])->name('profile.index');
Route::get('/contact', [ClientContactController::class, 'index'])->name('contact');
Route::post('/contact', [ClientContactController::class, 'store'])->name('contact.store');
Route::prefix('cart')->group(function () {
    Route::get('/', [ClientCartController::class, 'index'])->name('cart.index');
    Route::post('/them/{id}', [ClientCartController::class, 'add'])->name('cart.add');
    Route::post('/cap-nhat/{id}', [ClientCartController::class, 'update'])->name('cart.update');
    Route::delete('/xoa/{id}', [ClientCartController::class, 'remove'])->name('cart.remove');
});


Route::get('/checkout', [ClientCheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout.index');

Route::post('/checkout', [ClientCheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');


Route::middleware('auth')->group(function () {
    Route::get('/don-hang', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('/don-hang/{id}', [ClientOrderController::class, 'show'])->name('orders.show');
    Route::patch('/don-hang/{id}/huy', [ClientOrderController::class, 'cancel'])->name('orders.cancel');
});

// Route admin gộp vào web.php luôn
Route::prefix('admin')
    ->middleware(['auth', 'admin']) // middleware admin vẫn dùng bình thường
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('variants', ProductVariantController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class);
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        // Route::patch('/orders/{id}/confirm', [OrderController::class, 'confirmOrder']);->name('admin.orders.confirm');
        Route::post('orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
        Route::post('orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    });
require __DIR__.'/auth.php';
