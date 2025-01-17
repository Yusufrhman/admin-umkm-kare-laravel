<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Madu Murni']);
        Category::create(['name' => 'Madu Premium']);
        Category::create(['name' => 'Madu Hutan']);
        Category::create(['name' => 'Madu Plus']);
    }
}
