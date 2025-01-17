<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            UMKMSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            ProductCategorySeeder::class,
        ]);
    }
}
