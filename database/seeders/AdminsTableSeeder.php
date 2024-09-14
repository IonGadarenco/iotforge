<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{

    public static function run()
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
                'active' => 1
            ]
        );

        $permissions = [
            ['id' => Permission::PAGES, 'name' => 'Pagini', 'guard_name' => 'admin'],
            ['id' => Permission::CONFIG, 'name' => 'Configurări', 'guard_name' => 'admin'],
            ['id' => Permission::ACTIVITIES, 'name' => 'Activități', 'guard_name' => 'admin'],
            ['id' => Permission::LOGS, 'name' => 'Loguri', 'guard_name' => 'admin'],
            ['id' => Permission::ADMINS, 'name' => 'Administratori', 'guard_name' => 'admin'],
            ['id' => Permission::ROLES, 'name' => 'Roluri', 'guard_name' => 'admin'],
            ['id' => Permission::CONSTANTS, 'name' => 'Constante', 'guard_name' => 'admin'],

        ];

        foreach ($permissions as $permissionData) {
            Permission::updateOrCreate(
                ['id' => $permissionData['id']],
                $permissionData
            );
        }

        $role = Role::firstOrCreate(
            [
                'guard_name' => 'admin',
                'name' => 'Full Access',
                'full_access' => 1,
            ]
        );
        $allPermissionsArr = array_column($permissions, 'id');

        $role->permissions()->attach($allPermissionsArr);

        $admin->roles()->attach($role);
    }
}
