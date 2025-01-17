<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@madukare.com',
            'password' => Hash::make('aaaaaa'), // Pastikan password di-hash
            'no_telp' => '081234567890',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@madukare.com',
            'password' => Hash::make('aaaaaa'),
            'no_telp' => '081234567891',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@madukare.com',
            'password' => Hash::make('aaaaaa'),
            'no_telp' => '081234567892',
            'role_id' => 1,
        ]);
    }
}