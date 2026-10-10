@extends('layout')
@section('title', 'Keranjang')
@section('content')
<h1>Keranjang belanja</h1>
@if(count($items) === 0)
<div class="card"><p>Keranjang masih kosong.</p><a class="btn" href="{{ route('index') }}">Pilih barang</a></div>
@else
@foreach($items as $item)
<div class="card" style="margin-bottom:12px">
<div class="row" style="justify-content:space-between">
<div><h3>{{ $item['barang']->nama }}</h3>
<p>Rp {{ number_format($item['barang']->harga,0,',','.') }} × {{ $item['jumlah'] }} = <strong>Rp {{ number_format($item['subtotal'],0,',','.') }}</strong></p></div>
<div class="row">
<form method="POST" action="{{ route('keranjang.minus', $item['barang']) }}">@csrf<button type="submit">−</button></form>
<strong>{{ $item['jumlah'] }}</strong>
<form method="POST" action="{{ route('keranjang.plus', $item['barang']) }}">@csrf<button type="submit" {{ $item['jumlah'] >= $item['barang']->stok ? 'disabled' : '' }}>+</button></form>
<form method="POST" action="{{ route('keranjang.hapus', $item['barang']) }}">@csrf<button type="submit">Hapus</button></form>
</div></div></div>
@endforeach
<div class="card"><h2>Total: Rp {{ number_format($total,0,',','.') }}</h2>
<form method="POST" action="{{ route('keranjang.kosongkan') }}">@csrf<button type="submit">Kosongkan keranjang</button></form>
</div>
@endif
@endsection
