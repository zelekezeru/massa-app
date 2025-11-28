<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    protected $fillable = [
        'name',
        'variety',
        'description',
        'supplier_id',
        'seed_categories_id',
        'farm_id',
        'company_id',
    ];

    protected $casts = [
        'seed_categories_id' => 'integer',
        'company_id' => 'integer',
        'farm_id' => 'integer',
    ];

    public function seedCategory()
    {
        return $this->belongsTo(SeedCategory::class, 'seed_categories_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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
