@extends('layout')
@section('title','Checkout')
@section('content')
<div class="card" style="max-width:650px;margin:auto"><h1>Checkout</h1>
<p>Total harga barang: <strong>Rp {{ number_format($total,0,',','.') }}</strong></p>
<p>Ongkos kirim diabaikan sesuai ketentuan tugas.</p>
<form method="POST" action="{{ route('checkout') }}">@csrf
<label>Alamat pengiriman</label><textarea name="alamat_pengiriman" required>{{ old('alamat_pengiriman', Auth::user()->alamat) }}</textarea>
<button type="submit">Konfirmasi checkout</button></form></div>
@endsection
