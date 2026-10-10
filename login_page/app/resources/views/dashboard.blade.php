<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>body{font-family:Arial,sans-serif;margin:40px;background:#f3f6fb}.card{max-width:700px;margin:auto;background:#fff;padding:28px;border-radius:12px}.top{display:flex;justify-content:space-between;align-items:center}button{padding:9px 14px;cursor:pointer}</style>
</head>
<body>
<div class="card">
    <div class="top">
        <h1>Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Logout</button></form>
    </div>
    <h2>Selamat datang, {{ $user->nama_lengkap }}!</h2>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ $user->username }}</p>
</div>
</body>
</html>
