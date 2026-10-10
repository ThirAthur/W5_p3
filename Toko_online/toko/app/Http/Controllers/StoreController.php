<?php

namespace App\Http\Controllers;

use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('nama_barang')->get();
        return view('store.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('store.show', compact('product'));
    }
}
