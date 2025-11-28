<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function crops()
    {
        return $this->hasMany(Crop::class, 'crop_categories_id');
    }
}
