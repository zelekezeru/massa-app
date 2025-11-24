<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesLocation extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state'];

    public function salesAgents()
    {
        return $this->hasMany(SalesAgent::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

}
