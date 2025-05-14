<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard view',
                    'vendor dashboard view',
                ],
            ],

            [
                'group_name' => 'CRM',
                'permissions' => [
                    'contact request read',
                    'contact request reply',
                    'contact request show',
                    'contact request delete',
                ],
            ],

            [
                'group_name' => 'Storefront',
                'permissions' => [
                    'vendor read',
                    'vendor create',
                    'vendor delete',
                    'brand read',
                    'brand create',
                    'brand delete',
                ],
            ],

            [
                'group_name' => 'Manage Home',
                'permissions' => [
                    'home slider read',
                    'home slider create',
                    'home slider delete',
                ],
            ],

            [
                'group_name' => 'Manage Products',
                'permissions' => [
                    'category read',
                    'category create',
                    'category delete',
                    'sub category read',
                    'sub category create',
                    'sub category delete',
                    'attribute read',
                    'attribute create',
                    'attribute delete',
                    'product read',
                    'product create',
                    'product delete',
                    'product delete',
                ],
            ],

            [
                'group_name' => 'Manage Orders',
                'permissions' => [
                    'order read',
                    'order update',
                    'order delivery status update',
                    'order delete',
                ],
            ],

            [
                'group_name' => 'Admin User',
                'permissions' => [
                    'admin read',
                    'admin create',
                    'admin update',
                    'admin delete',
                ],
            ],

            [
                'group_name' => 'Admin Role',
                'permissions' => [
                    'role read',
                    'role create',
                    'role update',
                    'role delete',
                ],
            ],

            [
                'group_name' => 'Admin Permissions',
                'permissions' => [
                    'permission read',
                    'permission create',
                    'permission update',
                    'permission delete',
                ],
            ],
        ];

        foreach ($permissions as $permission) {
            $groupName = $permission['group_name'];

            foreach ($permission['permissions'] as $permissionName) {
                $permissionExists = Permission::where('name', $permissionName)
                    ->where('group_name', $groupName)
                    ->where('guard_name', 'admin')
                    ->first();

                if (! $permissionExists) {
                    Permission::create([
                        'name' => $permissionName,
                        'group_name' => $groupName,
                        'guard_name' => 'admin',
                    ]);
                }
            }
        }
        $roleSuperAdmin = Role::where('name', 'administrator')->where('guard_name', 'admin')->first();
        if (! $roleSuperAdmin) {
            $roleSuperAdmin = Role::create([
                'name' => 'administrator',
                'guard_name' => 'admin',
            ]);
        }
        $roleSuperAdmin->givePermissionTo(Permission::all());

        $superAdmin = Admin::where('email', 'admin@admin.com')->first();
        if ($superAdmin) {
            $superAdmin->assignRole($roleSuperAdmin);
        }
    }
}
