@extends('layout')
@section('title',$product->nama_barang)
@section('content')
<div class="card"><h1>{{ $product->nama_barang }}</h1><p>{{ $product->deskripsi }}</p>
<p class="price">Rp {{ number_format($product->harga,0,',','.') }}</p><p>Stok: {{ $product->stok }}</p>
@auth<form method="POST" action="{{ route('cart.add',$product) }}">@csrf<button {{ $product->stok < 1 ? 'disabled' : '' }}>Masukkan ke keranjang</button></form>
@else<a class="btn" href="{{ route('login') }}">Login untuk membeli</a>@endauth
<p><a href="{{ route('store.index') }}">Kembali ke daftar produk</a></p></div>
@endsection
