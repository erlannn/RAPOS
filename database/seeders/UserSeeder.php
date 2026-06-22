<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'Nama' => 'Erlan',
            'Username' => 'admin',
            'Email' => 'admin@gmail.com',
            'Password' => password_hash('12345678', PASSWORD_BCRYPT),
            'StoreID' => 1
        ])->assignRole('Admin');

        User::create([
            'Nama' => 'Gudang',
            'Username' => 'gudang',
            'Email' => 'gudang@gmail.com',
            'Password' => password_hash('12345678', PASSWORD_BCRYPT),
            'StoreID' => 1
        ])->assignRole('Gudang');
    }
}
