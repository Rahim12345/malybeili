<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name_az',
        'name_en',
        'name_ru',
        'slug_az',
        'slug_en',
        'slug_ru',
        'about_az',
        'about_en',
        'about_ru',
        'price',
        'discount',
        'stock',
        'color_az',
        'color_en',
        'color_ru',
        'size_az',
        'size_en',
        'size_ru',
        'hidden'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
