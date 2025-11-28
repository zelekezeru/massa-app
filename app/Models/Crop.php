<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $fillable = [
        'name',
        'variety',
        'description',
        'crop_categories_id',
        'company_id',
        'farm_id',
    ];

    protected $casts = [
        'crop_categories_id' => 'integer',
        'company_id' => 'integer',
        'farm_id' => 'integer',
    ];

    public function cropCategory()
    {
        return $this->belongsTo(CropCategory::class, 'crop_categories_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
