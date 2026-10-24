<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Akun demo lokal. Ganti password setelah praktik; jangan gunakan di produksi.
        $accounts = [
            ['name' => 'Admin Demo', 'email' => 'admin@example.test', 'role' => 'admin'],
            ['name' => 'Customer Demo', 'email' => 'customer@example.test', 'role' => 'customer'],
            ['name' => 'Staff Demo', 'email' => 'staff@example.test', 'role' => 'staff'],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrNew(['email' => $account['email']]);
            $user->name = $account['name'];
            $user->role = $account['role'];
            if (! $user->exists) {
                $user->password = Hash::make('DemoW7!ChangeMe');
            }
            $user->save();
        }
    }
}
