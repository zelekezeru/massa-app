<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define fillable attributes
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
    ];
}
