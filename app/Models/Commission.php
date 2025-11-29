<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'amount',
        'sales_agent_id',
        'sale_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && empty($model->company_id)) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    public function salesAgent()
    {
        return $this->belongsTo(SalesAgent::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


}
