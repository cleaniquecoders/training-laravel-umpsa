<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::updateOrCreate(['name' => 'User' ], [])
        // create roles
        $role = Role::firstOrCreate(['name' => 'User']);

        // create permissions
        $permissions = [
            'create-task',
            'update-task',
            'view-task',
            'view-tasks',
            'delete-task',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $role->givePermissionTo($permission);
        }

        User::query()
            ->get()
            ->each(
                fn($user) => $user->assignRole('User')
            );
    }
}
