<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'KodeStore' => 'ST001',
            'NamaStore' => 'Toko Pusat',
            'TipeLokasi' => 'TOKO',
            'Alamat' => 'Jl. Raya Pusat No.1',
            'NoTelp' => '08123456789',
            'StatusAktif' => 1,
        ]);
    }
}
