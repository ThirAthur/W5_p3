<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'budi'],
            [
                'id_user' => 'USRDEMO0000001',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => 'password123',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Melati No. 1',
            ]
        );

        $products = [
            ['BRG0000001','Buku Tulis','Buku tulis 38 lembar',5000,30,'buku-tulis.jpg'],
            ['BRG0000002','Pulpen','Pulpen tinta biru',3000,40,'pulpen.jpg'],
            ['BRG0000003','Penggaris','Penggaris 30 cm',4000,20,'penggaris.jpg'],
            ['BRG0000004','Pensil 2B','Pensil untuk menulis',2500,25,'pensil.jpg'],
            ['BRG0000005','Penghapus','Penghapus putih',1500,35,'penghapus.jpg'],
            ['BRG0000006','Spidol','Spidol permanen',7000,15,'spidol.jpg'],
            ['BRG0000007','Buku Gambar','Buku gambar A4',8000,18,'buku-gambar.jpg'],
            ['BRG0000008','Stabilo','Penanda teks',6500,12,'stabilo.jpg'],
            ['BRG0000009','Map Plastik','Map dokumen',2500,22,'map.jpg'],
            ['BRG0000010','Rautan','Rautan pensil',3500,16,'rautan.jpg'],
        ];

        foreach ($products as [$id,$nama,$deskripsi,$harga,$stok,$gambar]) {
            Product::updateOrCreate(['id_barang' => $id], [
                'nama_barang' => $nama, 'deskripsi' => $deskripsi,
                'harga' => $harga, 'stok' => $stok, 'gambar' => $gambar,
            ]);
        }
    }
}
