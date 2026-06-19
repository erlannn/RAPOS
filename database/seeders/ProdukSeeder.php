<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'BrandID' => 1,
                'KategoriID' => 1,
                'SubKategoriID' => 1,
                'SKU' => 'PRD001',
                'Barcode' => '1111111111111',
                'NamaProduk' => 'Chitato Sapi Panggang 68g',
                'Satuan' => 'PCS',
                'Deskripsi' => 'Keripik kentang rasa sapi panggang',
                'StatusAktif' => 1
            ],
            [
                'BrandID' => 2,
                'KategoriID' => 1,
                'SubKategoriID' => 2,
                'SKU' => 'PRD002',
                'Barcode' => '2222222222222',
                'NamaProduk' => 'Roma Kelapa 300g',
                'Satuan' => 'PCS',
                'Deskripsi' => 'Biskuit kelapa renyah',
                'StatusAktif' => 1
            ],
            [
                'BrandID' => 3,
                'KategoriID' => 3,
                'SubKategoriID' => 4,
                'SKU' => 'PRD003',
                'Barcode' => '3333333333333',
                'NamaProduk' => 'Kemeja Hitam Polos',
                'Satuan' => 'PCS',
                'Deskripsi' => 'Kemeja lengan pendek warna hitam',
                'StatusAktif' => 1
            ],
            [
                'BrandID' => 4,
                'KategoriID' => 4,
                'SubKategoriID' => 5,
                'SKU' => 'PRD004',
                'Barcode' => '4444444444444',
                'NamaProduk' => 'Samsung Galaxy S23',
                'Satuan' => 'UNIT',
                'Deskripsi' => 'Smartphone flagship Samsung 8/256GB',
                'StatusAktif' => 1
            ],
            [
                'BrandID' => 5,
                'KategoriID' => 5, // Wait, KategoriID 5 is 'Perawatan Wajah' (from KategoriSeeder)
                'SubKategoriID' => null, // null is allowed
                'SKU' => 'PRD005',
                'Barcode' => '5555555555555',
                'NamaProduk' => 'Wardah Lightening Serum',
                'Satuan' => 'PCS',
                'Deskripsi' => 'Serum wajah untuk mencerahkan',
                'StatusAktif' => 1
            ],
        ];
        
        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
