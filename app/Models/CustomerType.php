<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'company_id',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
