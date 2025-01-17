<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $categories = Category::all();

        foreach ($products as $product) {
            foreach ($categories as $category) {
                if (strpos(strtolower($product->name), strtolower($category->name)) !== false) {
                    ProductCategory::create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
