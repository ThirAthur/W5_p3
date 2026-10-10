<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'budi'],
            ['nama_lengkap' => 'Budi Santoso', 'password' => 'password123']
        );

        User::updateOrCreate(
            ['username' => 'siti'],
            ['nama_lengkap' => 'Siti Aminah', 'password' => 'password123']
        );
    }
}
