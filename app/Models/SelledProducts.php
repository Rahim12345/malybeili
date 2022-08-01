<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelledProducts extends Model
{
    use HasFactory;

    protected $table = 'selled_products';

    protected $guarded = [];
}
