<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'location', 'company_id'];

    protected static function booted()
    {
        static::addGlobalScope('company', function (Builder $builder) {
            if (app()->bound('company_id')) {
                $builder->where('company_id', app('company_id'));
            } else if (auth()->check()) {
                $builder->where('company_id', auth()->user()->company_id);
            }
        });
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type');
    }

    public function salesLocations()
    {
        return $this->belongsTo(SalesLocation::class, 'sales_location_id');
    }

    public function salesAgents()
    {
        return $this->belongsToMany(SalesAgent::class, 'sales_agent_customer', 'customer_id', 'sales_agent_id');
    }

    
}
