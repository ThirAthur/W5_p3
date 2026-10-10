<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkoutForm(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (!$cart) return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');

        $products = Product::whereIn('id_barang', array_keys($cart))->get()->keyBy('id_barang');
        $total = 0;
        foreach ($cart as $id => $qty) {
            if (!isset($products[$id])) continue;
            $total += $products[$id]->harga * (int)$qty;
        }

        return view('orders.checkout', compact('total'));
    }

    public function checkout(Request $request)
    {
        $data = $request->validate(['alamat_pengiriman' => ['required', 'string', 'max:5000']]);
        $cart = $request->session()->get('cart', []);
        if (!$cart) return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');

        $order = DB::transaction(function () use ($cart, $data) {
            $lockedProducts = Product::whereIn('id_barang', array_keys($cart))
                ->lockForUpdate()->get()->keyBy('id_barang');

            $total = 0;
            foreach ($cart as $id => $qty) {
                if (!isset($lockedProducts[$id])) {
                    throw new \RuntimeException('Produk tidak ditemukan.');
                }
                $product = $lockedProducts[$id];
                $qty = (int)$qty;
                if ($qty < 1 || $qty > $product->stok) {
                    throw new \RuntimeException('Stok tidak mencukupi untuk ' . $product->nama_barang . '.');
                }
                $total += $product->harga * $qty;
            }

            $order = Order::create([
                'id_order' => 'ORD' . strtoupper(Str::random(12)),
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $data['alamat_pengiriman'],
            ]);

            foreach ($cart as $id => $qty) {
                $product = $lockedProducts[$id];
                OrderDetail::create([
                    'id_order' => $order->id_order,
                    'id_barang' => $id,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => (int)$qty,
                ]);
                $product->decrement('stok', (int)$qty);
            }

            return $order;
        });

        $request->session()->forget('cart');
        return redirect()->route('orders.show', $order->id_order)->with('success', 'Checkout berhasil.');
    }

    public function history()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)->latest('tanggal_order')->get();
        return view('orders.index', compact('orders'));
    }

    public function detail(Order $order)
    {
        abort_unless($order->id_user === Auth::user()->id_user, 403);
        $order->load('details.product');
        return view('orders.show', compact('order'));
    }
}
