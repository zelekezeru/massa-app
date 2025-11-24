<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear any cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            // Manage Users
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Manage Sales
            'view-sales',
            'create-sales',
            'edit-sales',
            'delete-sales',

            // Manage Sales Locations
            'view-sales-locations',
            'create-sales-locations',
            'edit-sales-locations',
            'delete-sales-locations',

            // Manage Sales Agents
            'view-sales-agents',
            'create-sales-agents',
            'edit-sales-agents',
            'delete-sales-agents',

            // Manage Customers
            'view-customers',
            'create-customers',
            'edit-customers',
            'delete-customers',

            // Manage Payments
            'view-payments',
            'create-payments',
            'edit-payments',
            'delete-payments',

            // Manage Sales Items
            'view-sales-items',
            'create-sales-items',
            'edit-sales-items',
            'delete-sales-items',

            // Manage Price List
            'view-price-list',
            'create-price-list',
            'edit-price-list',
            'delete-price-list',

            // Manage Commissions
            'view-commissions',
            'create-commissions',
            'edit-commissions',
            'delete-commissions',

            // Manage Products
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',

            // Manage Reports
            'view-reports',
            'create-reports',
            'edit-reports',
            'delete-reports',

            // Manage Farms
            'view-farms',
            'create-farms',
            'edit-farms',
            'delete-farms',

            // Manage
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles
        $roles = [
            'super_admin',
            'admin',
            'user',
            'sales_agent',
            'manager',
            'customer',
            'supplier',
            'employee',
            'farmer',
        ];

        // Assign permissions to roles
        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            if ($roleName === 'super_admin') {
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]);
            }
        }
    }
}