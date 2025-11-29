<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'sales_location_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && empty($model->company_id)) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    public function salesLocation()
    {
        return $this->belongsTo(SalesLocation::class);
    }
}
