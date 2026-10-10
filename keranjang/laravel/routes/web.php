<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;

Route::get('/', [KeranjangController::class, 'index'])->name('index');
Route::get('/keranjang', [KeranjangController::class, 'show'])->name('keranjang');
Route::post('/keranjang/tambah/{barang}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/tambah-jumlah/{barang}', [KeranjangController::class, 'tambahJumlah'])->name('keranjang.plus');
Route::post('/keranjang/kurangi/{barang}', [KeranjangController::class, 'kurangi'])->name('keranjang.minus');
Route::post('/keranjang/hapus/{barang}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');
