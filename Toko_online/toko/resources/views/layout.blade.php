<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>@yield('title','Toko Online')</title>
<style>
body{margin:0;font-family:Arial,sans-serif;background:#f5f7fb;color:#172033}header{background:#143b70;color:white;padding:18px 5%;display:flex;justify-content:space-between;gap:15px;align-items:center;flex-wrap:wrap}header a{color:white;margin-right:12px}main{max-width:1100px;margin:28px auto;padding:0 18px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px}.card{background:white;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-bottom:14px}.price{font-weight:bold;color:#174ea6}.muted{color:#667085}button,.btn{background:#1d4ed8;color:white;border:0;padding:10px 14px;border-radius:6px;text-decoration:none;cursor:pointer}input,textarea{box-sizing:border-box;width:100%;padding:10px;margin:6px 0 14px;border:1px solid #cbd5e1;border-radius:6px}label{display:block}button:disabled{background:#9ca3af}.msg{padding:12px;background:#dcfce7}.err{padding:12px;background:#fee2e2}.row{display:flex;justify-content:space-between;gap:16px;align-items:center;flex-wrap:wrap}img.product{width:100%;height:140px;object-fit:contain;background:#f8fafc;border-radius:8px}
</style></head>
<body>
<header><strong><a href="{{ route('store.index') }}">Toko Online</a></strong><nav>
<a href="{{ route('store.index') }}">Produk</a>
@auth
<a href="{{ route('cart.index') }}">Keranjang ({{ array_sum(session('cart', [])) }})</a>
<a href="{{ route('orders.index') }}">Pesanan Saya</a>
<span>{{ Auth::user()->nama_lengkap }}</span>
<form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Logout</button></form>
@else
<a href="{{ route('login') }}">Login</a><a href="{{ route('register') }}">Daftar</a>
@endauth
</nav></header>
<main>
@if(session('success'))<p class="msg">{{ session('success') }}</p>@endif
@if(session('error'))<p class="err">{{ session('error') }}</p>@endif
@if($errors->any())<div class="err"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</main></body></html>
