<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['DepartemenID' => 1, 'Nama' => 'Makanan Ringan'],
            ['DepartemenID' => 1, 'Nama' => 'Minuman Kemasan'],
            ['DepartemenID' => 2, 'Nama' => 'Kemeja Pria'],
            ['DepartemenID' => 3, 'Nama' => 'Smartphone'],
            ['DepartemenID' => 4, 'Nama' => 'Perawatan Wajah'],
        ];
        
        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
