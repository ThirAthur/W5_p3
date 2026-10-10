@extends('layout')
@section('title','Riwayat Pesanan')
@section('content')
<h1>Riwayat Pesanan</h1>
@if($orders->isEmpty())<div class="card">Belum ada pesanan.</div>
@else
@foreach($orders as $order)
<div class="card"><div class="row"><div><h3>{{ $order->id_order }}</h3><p>{{ $order->tanggal_order }}</p></div>
<div><strong>Rp {{ number_format($order->total_harga,0,',','.') }}</strong><p><a href="{{ route('orders.show',$order->id_order) }}">Lihat detail</a></p></div></div></div>
@endforeach
@endif
@endsection
