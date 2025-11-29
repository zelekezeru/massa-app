<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tray extends Model
{
    protected $fillable = [
        'code',
        'type',
        'productionDate',
        'capacity',
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

    public function nurseries()
    {
        return $this->belongsToMany(Nursery::class, 'nursery_tray')->withPivot('quantity')->withTimestamps();
    }
}
