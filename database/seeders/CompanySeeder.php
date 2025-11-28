<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'MASSA Farm',
            'email' => 'info@massa.farm',
            'phone' => '+251 915 391 234',
            'address' => 'Hawassa, Ethiopia',
            'logo' => '/assets/img/massa-logo.svg',
            'settings' => json_encode([
                'theme' => 'green',
                'timezone' => 'Africa/Lagos',
                'features' => ['multi-tenant', 'traceability', 'dashboard'],
            ]),
        ]);
    }
}
