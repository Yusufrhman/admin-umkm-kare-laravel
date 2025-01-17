<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    /**
     * Get the product that belongs to the category.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the category that belongs to the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
