<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreAuthController;

Route::get('/login', [StoreAuthController::class, 'showLoginForm'])
    ->name('login');

Route::middleware('guest')->group(function () {
    // Menampilkan halaman registrasi
    Route::get('/register', [StoreAuthController::class, 'showRegister'])
        ->name('register');

    // Memproses registrasi
    Route::post('/register', [StoreAuthController::class, 'register'])
        ->name('register.submit');
});
Route::get('/store', [StoreController::class, 'index'])
    ->name('store.index');

// Sesuaikan dengan route katalog yang sudah ada di proyek Anda.
Route::get('/', [CartController::class, 'index']);

// Cart tetap stateless: payload cart dikirim setiap request.
// Hanya customer terautentikasi yang boleh mengubah cart.
Route::post('/cart/add', [CartController::class, 'add'])
    ->middleware(['auth', 'can:use-cart'])
    ->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])
    ->middleware(['auth', 'can:use-cart'])
    ->name('cart.update');

// Halaman daftar user dan endpoint perubahan role khusus admin.
Route::get('/admin/users', [RoleController::class, 'index'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.index');
Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');
