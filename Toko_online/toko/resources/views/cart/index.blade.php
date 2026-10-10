@extends('layout')
@section('title','Keranjang Belanja')
@section('content')
<h1>Keranjang Belanja</h1>
@if(!$items)
<div class="card"><p>Keranjang kosong.</p><a class="btn" href="{{ route('store.index') }}">Lihat produk</a></div>
@else
@foreach($items as $item)
<div class="card"><div class="row"><div><h3>{{ $item['product']->nama_barang }}</h3>
<p>Rp {{ number_format($item['product']->harga,0,',','.') }} × {{ $item['qty'] }} = <strong>Rp {{ number_format($item['subtotal'],0,',','.') }}</strong></p>
<p class="muted">Stok tersedia: {{ $item['product']->stok }}</p></div>
<div><form method="POST" action="{{ route('cart.update',$item['product']) }}">@csrf @method('PATCH')
<input style="width:90px" type="number" name="jumlah" min="1" max="{{ $item['product']->stok }}" value="{{ $item['qty'] }}" required><button>Simpan jumlah</button></form>
<form method="POST" action="{{ route('cart.remove',$item['product']) }}">@csrf @method('DELETE')<button>Hapus</button></form></div></div></div>
@endforeach
<div class="card"><h2>Total: Rp {{ number_format($total,0,',','.') }}</h2><div class="row">
<form method="POST" action="{{ route('cart.clear') }}">@csrf @method('DELETE')<button>Kosongkan keranjang</button></form>
<a class="btn" href="{{ route('checkout.form') }}">Checkout</a></div></div>
@endif
@endsection
