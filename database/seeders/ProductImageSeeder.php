<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            ProductImage::create([
                'image_url' => 'https://go-wisata.id/images/RHsoLcH63Tmh4ZcWSdapwwDAIzn6gbUKDnmMVMqF.jpg',
                'product_id' => $product->id,  // Menggunakan relasi product_id
            ]);
        }
    }
}
