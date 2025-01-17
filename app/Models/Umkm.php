<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_name',
        'description',
        'main_image',
        'nomer_wa',
        'instagram',
        'user_id',
        'status'
    ];

    /**
     * Get the user that owns the UMKM.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products for this UMKM.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
