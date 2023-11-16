<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Elmalika we Elamir',
            'email' => 'MWA@superadmin.com',
            'password' => Hash::make('123456'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Omar',
            'email' => 'omar@admin.com',
            'password' => Hash::make('1234567'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Nuby',
            'email' => 'nuby@admin.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Miecky',
            'email' => 'mcmc@admin.com',
            'password' => Hash::make('123456789'),
            'role_id' => 2
        ]);

    }
}
