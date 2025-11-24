<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'location'];

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
