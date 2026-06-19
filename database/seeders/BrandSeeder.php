<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['NamaBrand' => 'Indofood', 'StatusAktif' => 1],
            ['NamaBrand' => 'Mayora', 'StatusAktif' => 1],
            ['NamaBrand' => 'Erigo', 'StatusAktif' => 1],
            ['NamaBrand' => 'Samsung', 'StatusAktif' => 1],
            ['NamaBrand' => 'Wardah', 'StatusAktif' => 1],
        ];
        
        foreach ($data as $item) {
            Brand::create($item);
        }
    }
}
