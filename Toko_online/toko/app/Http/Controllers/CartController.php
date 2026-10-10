<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::whereIn('id_barang', array_keys($cart))->get()->keyBy('id_barang');
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            if (!isset($products[$id])) continue;
            $product = $products[$id];
            $qty = (int)$qty;
            $subtotal = $product->harga * $qty;
            $items[] = compact('product', 'qty', 'subtotal');
            $total += $subtotal;
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->stok < 1) return back()->with('error', 'Stok barang habis.');

        $cart = $request->session()->get('cart', []);
        $qty = (int)($cart[$product->id_barang] ?? 0);
        if ($qty >= $product->stok) return back()->with('error', 'Jumlah di keranjang sudah mencapai stok.');
        $cart[$product->id_barang] = $qty + 1;
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk masuk ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['jumlah' => ['required', 'integer', 'min:1']]);
        if ($data['jumlah'] > $product->stok) {
            return back()->with('error', 'Jumlah tidak boleh melebihi stok tersedia.');
        }
        $cart = $request->session()->get('cart', []);
        $cart[$product->id_barang] = $data['jumlah'];
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Jumlah diperbarui.');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id_barang]);
        $request->session()->put('cart', $cart);
        return back();
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
