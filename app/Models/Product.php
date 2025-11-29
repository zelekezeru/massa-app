<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define fillable attributes
    protected $fillable = [
        'sku',
        'name',
        'unit',
        'base_price',
        'stock',
        'sales_location_id',
        'notes',
        'farm_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && empty($model->company_id)) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function salesLocation()
    {
        return $this->belongsTo(SalesLocation::class, 'sales_location_id');
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
