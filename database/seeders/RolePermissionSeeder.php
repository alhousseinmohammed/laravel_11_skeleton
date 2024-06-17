<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $guards = ['api', 'jwt-api'];

        $permissions = [
            'book.view',
            'book.create',
            'book.edit',
            'book.delete',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
        ];

        foreach ($permissions as $permission) {
            foreach ($guards as $guard) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guard]);
            }
        }

        $roles = [
            'admin' => $permissions,
            'editor' => ['book.view', 'book.create', 'book.edit'],
            'viewer' => ['book.view'],
        ];

        foreach ($roles as $role_name => $rolePermissions) {
            foreach ($guards as $guard) {
                $role = Role::firstOrCreate(['name' => $role_name, 'guard_name' => $guard]);
                $role->syncPermissions($rolePermissions);
            }
        }
    }
}
