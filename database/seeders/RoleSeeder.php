<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the default permissions
        $permissions = \App\Models\Permission::defaultPermissions();

        foreach ($permissions as $permission) {
            \App\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Default Permissions added.');

        // Seed the default roles
        $roles = \App\Models\Role::defaultRoles();
        foreach ($roles as $role) {
            $role = \App\Models\Role::firstOrCreate(['name' => $role]);
            if ($role->name == 'admin') {
                // Assign all permissions
                $role->syncPermissions(\App\Models\Permission::all());
                $this->command->info('Admin granted all the permissions');
            } else {
                // For others by default only read access
                $role->syncPermissions(\App\Models\Permission::where('name', 'LIKE', 'view_%')->get());
            }
        }

        // If only one user exists, assign the admin role to it
        if (\App\Models\User::count() == 1) {
            \App\Models\User::first()->assignRole('admin');
            $this->command->info('Admin granted to only user');
        }

        // If no user exists, create one with admin role
        if (\App\Models\User::count() == 0) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'tek2991@gmail.com',
            ])->assignRole('admin');
        }
    }
}
