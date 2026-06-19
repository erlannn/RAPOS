<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['KategoriID' => 1, 'Nama' => 'Keripik'],
            ['KategoriID' => 1, 'Nama' => 'Biskuit'],
            ['KategoriID' => 2, 'Nama' => 'Jus Buah'],
            ['KategoriID' => 3, 'Nama' => 'Lengan Pendek'],
            ['KategoriID' => 4, 'Nama' => 'Android'],
        ];
        
        foreach ($data as $item) {
            SubKategori::create($item);
        }
    }
}
