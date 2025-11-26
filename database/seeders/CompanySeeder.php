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
            'logo' => '/assets/img/massa-logo.svg',
            'settings' => json_encode([
                'theme' => 'green',
                'timezone' => 'Africa/Lagos',
                'features' => ['multi-tenant', 'traceability', 'dashboard'],
            ]),
        ]);
    }
}
