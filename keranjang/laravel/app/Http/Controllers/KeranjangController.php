<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::orderBy('id')->get();
        $cart = $request->session()->get('cart', []);
        $jumlahItem = array_sum($cart);
        return view('barang.index', compact('barang', 'jumlahItem'));
    }

    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $jumlah) {
            $barang = Barang::find($id);
            if (!$barang) continue;
            $jumlah = min((int)$jumlah, (int)$barang->stok);
            $subtotal = $barang->harga * $jumlah;
            $items[] = ['barang' => $barang, 'jumlah' => $jumlah, 'subtotal' => $subtotal];
            $total += $subtotal;
        }

        return view('barang.keranjang', compact('items', 'total'));
    }

    public function tambah(Request $request, Barang $barang)
    {
        if ($barang->stok < 1) {
            return back()->with('error', 'Stok barang habis.');
        }

        $cart = $request->session()->get('cart', []);
        $jumlah = (int)($cart[$barang->id] ?? 0);

        if ($jumlah >= $barang->stok) {
            return back()->with('error', 'Jumlah tidak boleh melebihi stok.');
        }

        $cart[$barang->id] = $jumlah + 1;
        $request->session()->put('cart', $cart);
        return back()->with('success', 'Barang ditambahkan ke keranjang.');
    }

    public function tambahJumlah(Request $request, Barang $barang)
    {
        $cart = $request->session()->get('cart', []);
        $jumlah = (int)($cart[$barang->id] ?? 0);
        if ($jumlah < $barang->stok) $cart[$barang->id] = $jumlah + 1;
        $request->session()->put('cart', $cart);
        return back();
    }

    public function kurangi(Request $request, Barang $barang)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$barang->id])) {
            $cart[$barang->id]--;
            if ($cart[$barang->id] <= 0) unset($cart[$barang->id]);
        }
        $request->session()->put('cart', $cart);
        return back();
    }

    public function hapus(Request $request, Barang $barang)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$barang->id]);
        $request->session()->put('cart', $cart);
        return back();
    }

    public function kosongkan(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('keranjang');
    }
}
