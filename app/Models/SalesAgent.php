<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesAgent extends Model
{
    protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'address',
        'sales_location_id',
        'user_id',
    ];

    public function salesLocation()
    {
        return $this->belongsTo(SalesLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
