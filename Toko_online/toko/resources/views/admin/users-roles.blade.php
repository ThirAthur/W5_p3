<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Role Management</title>
    <style>
        body{font-family:system-ui,sans-serif;max-width:960px;margin:36px auto;padding:0 18px;color:#222}
        table{width:100%;border-collapse:collapse}th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left}
        select,button{padding:8px} .status{padding:10px;background:#e8f5e9;margin:12px 0}
        .error{color:#b00020}
    </style>
</head>
<body>
    <h1>Role Management</h1>
    <p>Hanya admin yang dapat membuka halaman ini. Role admin tidak tersedia sebagai pilihan perubahan.</p>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <table>
        <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Role sekarang</th><th>Ubah role</th></tr></thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name ?? $user->username ?? '-' }}</td>
                <td>{{ $user->email ?? '-' }}</td>
                <td>{{ $user->role ?? 'customer' }}</td>
                <td>
                    @if ($user->role !== 'admin' && auth()->id() !== $user->id)
                        <form method="POST" action="{{ route('admin.users.role.update', $user) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role" required>
                                <option value="customer" @selected($user->role === 'customer')>customer</option>
                                <option value="staff" @selected($user->role === 'staff')>staff</option>
                            </select>
                            <button type="submit">Simpan</button>
                        </form>
                    @else
                        <span>Tidak dapat diubah</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
