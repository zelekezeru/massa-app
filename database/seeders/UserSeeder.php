<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure the Super Admin role exists
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@massa.com',
            'phone' => '0915391234',
            'address' => 'Hawassa, Sidama, Ethiopia',
            'username' => 'SA-01-25',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'default_password' => '123456789',
            'company_id' => 1,
        ]);

        $user->assignRole($superAdminRole);
    }
}