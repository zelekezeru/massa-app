<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'amount',
        'sales_agent_id',
        'sale_id',
        'company_id',
    ];
}
