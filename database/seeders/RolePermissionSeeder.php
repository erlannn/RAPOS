<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create_brand']);
        Permission::create(['name' => 'edit_brand']);
        Permission::create(['name' => 'delete_brand']);
        Permission::create(['name' => 'view_brand']);

        Permission::create(['name' => 'create_departemen']);
        Permission::create(['name' => 'edit_departemen']);
        Permission::create(['name' => 'delete_departemen']);
        Permission::create(['name' => 'view_departemen']);

        Permission::create(['name' => 'create_kategori']);
        Permission::create(['name' => 'edit_kategori']);
        Permission::create(['name' => 'delete_kategori']);
        Permission::create(['name' => 'view_kategori']);

        Permission::create(['name' => 'create_subkategori']);
        Permission::create(['name' => 'edit_subkategori']);
        Permission::create(['name' => 'delete_subkategori']);
        Permission::create(['name' => 'view_subkategori']);

        Permission::create(['name' => 'create_store']);
        Permission::create(['name' => 'edit_store']);
        Permission::create(['name' => 'delete_store']);
        Permission::create(['name' => 'view_store']);

        Permission::create(['name' => 'create_produk']);
        Permission::create(['name' => 'edit_produk']);
        Permission::create(['name' => 'delete_produk']);
        Permission::create(['name' => 'view_produk']);

        Permission::create(['name' => 'create_supplier']);
        Permission::create(['name' => 'edit_supplier']);
        Permission::create(['name' => 'delete_supplier']);
        Permission::create(['name' => 'view_supplier']);

        Permission::create(['name' => 'create_inventori']);
        Permission::create(['name' => 'edit_inventori']);
        Permission::create(['name' => 'delete_inventori']);
        Permission::create(['name' => 'view_inventori']);

        Permission::create(['name' => 'create_mutasistok']);
        Permission::create(['name' => 'edit_mutasistok']);
        Permission::create(['name' => 'delete_mutasistok']);
        Permission::create(['name' => 'view_mutasistok']);

        Permission::create(['name' => 'create_stok']);
        Permission::create(['name' => 'edit_stok']);
        Permission::create(['name' => 'delete_stok']);
        Permission::create(['name' => 'view_stok']);

        Permission::create(['name' => 'create_barangmasuk']);
        Permission::create(['name' => 'edit_barangmasuk']);
        Permission::create(['name' => 'delete_barangmasuk']);
        Permission::create(['name' => 'view_barangmasuk']);

        Permission::create(['name' => 'create_barangkeluar']);
        Permission::create(['name' => 'edit_barangkeluar']);
        Permission::create(['name' => 'delete_barangkeluar']);
        Permission::create(['name' => 'view_barangkeluar']);

        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleGudang = Role::create(['name' => 'Gudang']);

        $roleAdmin->givePermissionTo([
            'create_brand',
            'edit_brand',
            'delete_brand',
            'view_brand',

            'create_departemen',
            'edit_departemen',
            'delete_departemen',
            'view_departemen',

            'create_kategori',
            'edit_kategori',
            'delete_kategori',
            'view_kategori',

            'create_subkategori',
            'edit_subkategori',
            'delete_subkategori',
            'view_subkategori',

            'create_store',
            'edit_store',
            'delete_store',
            'view_store',

            'create_produk',
            'edit_produk',
            'delete_produk',
            'view_produk',

            'create_supplier',
            'edit_supplier',
            'delete_supplier',
            'view_supplier',

            'create_inventori',
            'edit_inventori',
            'delete_inventori',
            'view_inventori',

            'create_mutasistok',
            'edit_mutasistok',
            'delete_mutasistok',
            'view_mutasistok',

            'create_stok',
            'edit_stok',
            'delete_stok',
            'view_stok',

            'create_barangmasuk',
            'edit_barangmasuk',
            'delete_barangmasuk',
            'view_barangmasuk',

            'create_barangkeluar',
            'edit_barangkeluar',
            'delete_barangkeluar',
            'view_barangkeluar',
        ]);

        $roleGudang->givePermissionTo([
            'create_inventori',
            'edit_inventori',
            'view_inventori',

            'create_mutasistok',
            'edit_mutasistok',
            'view_mutasistok',

            'create_stok',
            'view_stok',

            'create_barangmasuk',
            'view_barangmasuk',

            'create_barangkeluar',
            'view_barangkeluar',
        ]);
    }
}
