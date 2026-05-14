<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'long_description',
        'price',
        'discount_price',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
