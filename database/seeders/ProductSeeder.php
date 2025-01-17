<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\UMKM;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $umkm1 = UMKM::where('umkm_name', 'Madu Kare Asli')->first();
        $umkm2 = UMKM::where('umkm_name', 'Madu Kare Premium')->first();

        Product::create([
            'name' => 'Madu Murni 250ml',
            'price' => 100000,
            'description' => 'Madu murni asli lebah ternak',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm1->id,  // Mengambil ID UMKM
        ]);

        Product::create([
            'name' => 'Madu Premium 250ml',
            'price' => 150000,
            'description' => 'Madu premium kualitas super',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm1->id,
        ]);

        Product::create([
            'name' => 'Madu Hutan 250ml',
            'price' => 125000,
            'description' => 'Madu hutan alami',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm1->id,
        ]);

        Product::create([
            'name' => 'Madu Plus 250ml',
            'price' => 175000,
            'description' => 'Madu plus propolis',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm1->id,
        ]);

        Product::create([
            'name' => 'Madu Murni Premium 250ml',
            'price' => 120000,
            'description' => 'Madu murni premium',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm2->id,
        ]);

        Product::create([
            'name' => 'Madu Premium Gold 250ml',
            'price' => 180000,
            'description' => 'Madu premium grade A',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm2->id,
        ]);

        Product::create([
            'name' => 'Madu Hutan Liar 250ml',
            'price' => 140000,
            'description' => 'Madu hutan murni',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm2->id,
        ]);

        Product::create([
            'name' => 'Madu Plus Extra 250ml',
            'price' => 200000,
            'description' => 'Madu plus royal jelly',
            'main_image' => '/dev/madu-kare.png',
            'umkm_id' => $umkm2->id,
        ]);
    }
}
