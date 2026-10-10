<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreAuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/produk/{product}', [StoreController::class, 'show'])->name('store.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [StoreAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [StoreAuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [StoreAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [StoreAuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [StoreAuthController::class, 'logout'])->name('logout');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/keranjang', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/pesanan', [OrderController::class, 'history'])->name('orders.index');
    Route::get('/pesanan/{order}', [OrderController::class, 'detail'])->name('orders.show');
});
