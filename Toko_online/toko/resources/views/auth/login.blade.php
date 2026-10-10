@extends('layout')
@section('title','Login')
@section('content')
<div class="card" style="max-width:460px;margin:auto"><h1>Login</h1><form method="POST" action="{{ route('login.submit') }}">@csrf
<label>Username</label><input name="username" value="{{ old('username') }}" required>
<label>Password</label><input type="password" name="password" required>
<button type="submit">Masuk</button></form><p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p></div>
@endsection
