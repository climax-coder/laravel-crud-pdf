<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'feature_image',
        'gallery_images',
        'shipping_cost',
        'product_status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
    ];
}
