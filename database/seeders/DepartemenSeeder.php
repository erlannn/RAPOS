<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Nama' => 'Makanan & Minuman'],
            ['Nama' => 'Pakaian'],
            ['Nama' => 'Elektronik'],
            ['Nama' => 'Kecantikan'],
            ['Nama' => 'Kesehatan'],
        ];
        
        foreach ($data as $item) {
            Departemen::create($item);
        }
    }
}
