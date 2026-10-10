<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Buku Tulis', 5000, 30],
            ['Pulpen', 3000, 40],
            ['Penggaris', 4000, 20],
            ['Pensil 2B', 2500, 25],
            ['Penghapus', 1500, 35],
        ];

        foreach ($items as [$nama, $harga, $stok]) {
            Barang::updateOrCreate(['nama' => $nama], ['harga' => $harga, 'stok' => $stok]);
        }
    }
}
