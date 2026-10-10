@extends('layout')
@section('title', 'Daftar Barang')
@section('content')
<h1>Daftar barang</h1>
<div class="grid">
@foreach($barang as $b)
<div class="card">
<h3>{{ $b->nama }}</h3>
<p>Harga: <strong>Rp {{ number_format($b->harga, 0, ',', '.') }}</strong></p>
<p class="muted">Stok: {{ $b->stok }}</p>
<form method="POST" action="{{ route('keranjang.tambah', $b) }}">@csrf
<button type="submit" {{ $b->stok < 1 ? 'disabled' : '' }}>Masukkan ke keranjang</button>
</form>
</div>
@endforeach
</div>
@endsection
