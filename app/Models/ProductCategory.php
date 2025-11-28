<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // Define fillable attributes
    protected $fillable = [
        'name',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
