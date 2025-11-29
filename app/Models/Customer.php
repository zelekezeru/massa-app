<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
        'customer_type',
        'credit_limit',
        'sales_location_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && empty($model->company_id)) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'customer_type');
    }

    public function salesLocation()
    {
        return $this->belongsTo(SalesLocation::class, 'sales_location_id');
    }

    public function salesAgents()
    {
        return $this->belongsToMany(SalesAgent::class, 'sales_agent_customer', 'customer_id', 'sales_agent_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
