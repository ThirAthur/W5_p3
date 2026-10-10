<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f6fb;margin:0;padding:40px}
        .card{max-width:420px;margin:auto;background:white;padding:28px;border-radius:12px;box-shadow:0 8px 28px #0001}
        label{display:block;margin-top:16px} input{box-sizing:border-box;width:100%;padding:11px;margin-top:6px}
        button{margin-top:20px;padding:11px 18px;background:#174ea6;color:white;border:0;border-radius:6px;width:100%;cursor:pointer}
        .error{background:#fee2e2;color:#991b1b;padding:10px;border-radius:6px}
    </style>
</head>
<body>
<div class="card">
    <h1>Login</h1>
    <p>Masuk untuk membuka dashboard.</p>
    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <label for="username">Username</label>
        <input id="username" name="username" value="{{ old('username') }}" required autofocus>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
