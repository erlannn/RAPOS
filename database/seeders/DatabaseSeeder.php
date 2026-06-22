<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StoreSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            DepartemenSeeder::class,
            KategoriSeeder::class,
            SubKategoriSeeder::class,
            BrandSeeder::class,
            SupplierSeeder::class,
            ProdukSeeder::class,
        ]);
    }
}
