@extends('layout')
@section('title','Daftar Produk')
@section('content')
<h1>Daftar Barang</h1><p class="muted">Kamu dapat melihat produk tanpa login. Untuk membeli, login terlebih dahulu.</p>
<div class="grid">
@foreach($products as $product)
<div class="card">
@if($product->gambar)<img class="product" src="{{ asset('images/'.$product->gambar) }}" alt="{{ $product->nama_barang }}">@endif
<h3>{{ $product->nama_barang }}</h3><p class="price">Rp {{ number_format($product->harga,0,',','.') }}</p>
<p>Stok: {{ $product->stok }}</p><p class="muted">{{ $product->deskripsi }}</p>
<div class="row"><a class="btn" href="{{ route('store.show',$product) }}">Detail</a>
@auth
<form method="POST" action="{{ route('cart.add',$product) }}">@csrf<button {{ $product->stok < 1 ? 'disabled' : '' }}>Tambah</button></form>
@else
<a class="btn" href="{{ route('login') }}">Login untuk membeli</a>
@endauth
</div></div>
@endforeach
</div>
@endsection
