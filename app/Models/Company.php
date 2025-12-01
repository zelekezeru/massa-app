<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'settings',
        'default_language'
    ];

    protected $casts = [
        'settings' => 'array',
    ];
    
    public function cropCategories()   { return $this->hasMany(CropCategory::class); }
    public function crops()            { return $this->hasMany(Crop::class); }
    public function nurseries()        { return $this->hasMany(Nursery::class); }
    public function inventories()      { return $this->hasMany(Inventory::class); }
    public function productCategories(){ return $this->hasMany(ProductCategory::class); }
    public function customers()        { return $this->hasMany(Customer::class); }
    public function customerTypes()    { return $this->hasMany(CustomerType::class); }
    public function payments()         { return $this->hasMany(Payment::class); }
    public function priceLists()       { return $this->hasMany(PriceList::class); }
    public function users()            { return $this->hasMany(User::class); }
    public function salesAgents()      { return $this->hasMany(SalesAgent::class); }
    public function salesLocations()   { return $this->hasMany(SalesLocation::class); }
    public function sales()            { return $this->hasMany(Sale::class); }
    public function products()         { return $this->hasMany(Product::class); }
    public function farms()            { return $this->hasMany(Farm::class); }

}
