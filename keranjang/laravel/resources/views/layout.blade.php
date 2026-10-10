<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Toko Alat Tulis')</title>
<style>
body{font-family:Arial,sans-serif;background:#f5f7fb;color:#1f2937;margin:0}
header{background:#173e75;color:white;padding:18px 5%;display:flex;justify-content:space-between;align-items:center}
header a{color:white;margin-left:16px}main{max-width:1000px;margin:28px auto;padding:0 18px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
.card{background:white;border:1px solid #e5e7eb;border-radius:10px;padding:18px}
button,.btn{background:#1d4ed8;color:white;border:0;border-radius:6px;padding:9px 12px;cursor:pointer;text-decoration:none}
button:disabled{background:#9ca3af;cursor:not-allowed}.muted{color:#6b7280}.msg{padding:10px;background:#dcfce7;border-radius:6px}.err{padding:10px;background:#fee2e2;border-radius:6px}
.row{display:flex;gap:10px;align-items:center;flex-wrap:wrap}form{display:inline}
</style>
</head>
<body>
<header><strong>Toko Alat Tulis</strong><nav><a href="{{ route('index') }}">Daftar Barang</a><a href="{{ route('keranjang') }}">Keranjang ({{ array_sum(session('cart', [])) }})</a></nav></header>
<main>
@if(session('success'))<p class="msg">{{ session('success') }}</p>@endif
@if(session('error'))<p class="err">{{ session('error') }}</p>@endif
@yield('content')
</main>
</body>
</html>
