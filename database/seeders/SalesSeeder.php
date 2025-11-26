<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use App\Models\CustomerType;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::first();        

        $customerTypes = [
            ['name' => 'Hotel', 'description' => 'Customers from hotels'],
            ['name' => 'Restaurant', 'description' => 'Customers from restaurants'],
            ['name' => 'Retail', 'description' => 'Customers from retail stores'],
            ['name' => 'Wholesale', 'description' => 'Customers from wholesale markets'],
            ['name' => 'Individual', 'description' => 'Individual clients'],
            ['name' => 'Online', 'description' => 'Customers from online platforms'],
        ];
        // Create customer types
        foreach ($customerTypes as $type) {
            CustomerType::create([
                'company_id' => $company->id,
                'name' => $type['name'],
                'description' => $type['description'],
            ]);
        }
    }
}
