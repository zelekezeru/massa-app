<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    protected $fillable = [
        'name',
        'location',
        'quantity',
        'plantationDate',
        'harvestDate',
        'status',
        'seed_id',
        'farm_id',
        'product_id',
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

    public function trays()
    {
        return $this->belongsToMany(Tray::class, 'nursery_tray')->withPivot('quantity')->withTimestamps();
    }

    public function seed()
    {
        return $this->belongsTo(Seed::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
