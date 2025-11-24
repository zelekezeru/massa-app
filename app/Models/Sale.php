<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model {
    use HasFactory;
    protected $fillable = [
        'invoice_no','customer_id','sales_agent_id','sales_location_id',
        'status','invoice_date','sub_total','discount','tax','total','balance_due','notes'
    ];

    public function customer()
    { 
        return $this->belongsTo(Customer::class); 
    }
    public function items()
    { 
        return $this->hasMany(SaleItem::class);
    }
    public function payments()
    { 
        return $this->hasMany(Payment::class);
    }
    public function agent()
    { 
        return $this->belongsTo(User::class,'sales_agent_id');
    }
    public function location()
    { 
        return $this->belongsTo(SalesLocation::class,'sales_location_id');
    }
    public function commissions()
    { 
        return $this->hasMany(Commission::class);
    }

    public function recalcTotals(){
        $this->sub_total = $this->items()->sum('line_total');
        $this->total = max(0, $this->sub_total - $this->discount + $this->tax);
        $this->balance_due = $this->total - $this->payments()->sum('amount');
        $this->save();
    }
}
