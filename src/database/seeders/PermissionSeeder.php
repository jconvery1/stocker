<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define dummy data for floor staff
        $floorStaffPermissions = [
            'stock' => true,
            'orders' => true,
            'sales' => true,
            'deliveries' => true,
            'suppliers' => false,
            'settings' => false,
        ];

        // Define dummy data for manager
        $managerPermissions = [
            'stock' => true,
            'orders' => true,
            'sales' => true,
            'deliveries' => true,
            'suppliers' => true,
            'settings' => true,
        ];

        // Define roles and their permissions
        $roles = [
            [
                'role' => 'floor staff',
                'permissions' => $floorStaffPermissions,
            ],
            [
                'role' => 'manager',
                'permissions' => $managerPermissions,
            ],
        ];

        // Insert data into the permissions table
        foreach ($roles as $role) {
            $permissionsData = [];

            foreach ($role['permissions'] as $module => $access) {
                $permissionsData[] = [
                    'role' => $role['role'],
                    'module' => $module,
                    'access' => $access,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('permissions')->insert($permissionsData);
        }
    }
}
