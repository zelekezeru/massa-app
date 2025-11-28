<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'company_id',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function seeds()
    {
        return $this->hasMany(Seed::class);
    }

}
