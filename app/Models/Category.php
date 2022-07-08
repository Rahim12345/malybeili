<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'slug_az',
        'slug_en',
        'slug_ru',
        'on_home',
        'src'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
