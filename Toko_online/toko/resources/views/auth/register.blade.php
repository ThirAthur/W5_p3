@extends('layout')
@section('title','Daftar Akun')
@section('content')
<div class="card" style="max-width:560px;margin:auto"><h1>Daftar akun</h1><form method="POST" action="{{ route('register.submit') }}">@csrf
<label>Nama lengkap</label><input name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
<label>Email</label><input type="email" name="email" value="{{ old('email') }}" required>
<label>Username</label><input name="username" value="{{ old('username') }}" required>
<label>Password (minimal 8 karakter)</label><input type="password" name="password" required>
<label>Konfirmasi password</label><input type="password" name="password_confirmation" required>
<label>Nomor HP</label><input name="no_hp" value="{{ old('no_hp') }}">
<label>Alamat</label><textarea name="alamat" required>{{ old('alamat') }}</textarea>
<button type="submit">Buat akun</button></form></div>
@endsection
