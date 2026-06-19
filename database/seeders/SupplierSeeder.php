<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'KodeSupplier' => 'SUP001',
                'NamaSupplier' => 'PT Indofood Sukses Makmur',
                'PIC' => 'Budi',
                'NoTelp' => '081234567801',
                'Email' => 'budi@indofood.com',
                'Alamat' => 'Jakarta Raya',
                'StatusAktif' => 1
            ],
            [
                'KodeSupplier' => 'SUP002',
                'NamaSupplier' => 'PT Mayora Indah',
                'PIC' => 'Siti',
                'NoTelp' => '081234567802',
                'Email' => 'siti@mayora.com',
                'Alamat' => 'Tangerang',
                'StatusAktif' => 1
            ],
            [
                'KodeSupplier' => 'SUP003',
                'NamaSupplier' => 'PT Erigo Indonesia',
                'PIC' => 'Andi',
                'NoTelp' => '081234567803',
                'Email' => 'andi@erigo.com',
                'Alamat' => 'Bandung',
                'StatusAktif' => 1
            ],
            [
                'KodeSupplier' => 'SUP004',
                'NamaSupplier' => 'PT Samsung Electronics',
                'PIC' => 'Citra',
                'NoTelp' => '081234567804',
                'Email' => 'citra@samsung.com',
                'Alamat' => 'Bekasi',
                'StatusAktif' => 1
            ],
            [
                'KodeSupplier' => 'SUP005',
                'NamaSupplier' => 'PT Paragon Technology',
                'PIC' => 'Dewi',
                'NoTelp' => '081234567805',
                'Email' => 'dewi@paragon.com',
                'Alamat' => 'Jakarta Selatan',
                'StatusAktif' => 1
            ],
        ];
        
        foreach ($data as $item) {
            Supplier::create($item);
        }
    }
}
