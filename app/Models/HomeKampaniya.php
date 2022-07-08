<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeKampaniya extends Model
{
    use HasFactory;

    protected $table = 'home_kampaniyas';

    protected $fillable = [
        'deadline',
        'link'
    ];
}
