<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelledProducts extends Model
{
    use HasFactory;

    protected $table = 'selled_products';

    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','mehsul_id');
    }
}
