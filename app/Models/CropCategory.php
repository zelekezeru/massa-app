<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
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

    public function crops()
    {
        return $this->hasMany(Crop::class, 'crop_categories_id');
    }
}
