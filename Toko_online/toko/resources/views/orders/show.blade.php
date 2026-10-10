@extends('layout')
@section('title','Detail Pesanan')
@section('content')
<h1>Detail Pesanan</h1><div class="card">
<p><strong>ID Pesanan:</strong> {{ $order->id_order }}</p><p><strong>Tanggal:</strong> {{ $order->tanggal_order }}</p>
<p><strong>Alamat pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>
<table style="width:100%;border-collapse:collapse"><thead><tr><th align="left">Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr></thead><tbody>
@foreach($order->details as $detail)
<tr><td>{{ $detail->product->nama_barang }}</td><td align="right">Rp {{ number_format($detail->harga_satuan,0,',','.') }}</td><td align="center">{{ $detail->jumlah_beli }}</td><td align="right">Rp {{ number_format($detail->harga_satuan*$detail->jumlah_beli,0,',','.') }}</td></tr>
@endforeach
</tbody></table><h2>Total: Rp {{ number_format($order->total_harga,0,',','.') }}</h2>
<a class="btn" href="{{ route('orders.index') }}">Kembali ke riwayat</a></div>
@endsection
