<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionToRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guards = ['web', 'api'];

        foreach ($guards as $guard) {
            // Fetch all permissions for the current guard
            $permissions = Permission::where('guard_name', $guard)->get();

            // Fetch the 'admin' role for the current guard
            $adminRole = Role::where('name', 'admin')->where('guard_name', $guard)->first();
            $adminUsers = User::role('admin')->get();

            foreach($adminUsers as $user){
                $user->givePermissionTo($permissions);
                $this->command->info("Admin role has been granted all permissions for the {$guard} guard.");
            }

            if ($adminRole) {
                // Assign all permissions to the admin role
                $adminRole->givePermissionTo($permissions);
                $this->command->info("Admin role has been granted all permissions for the {$guard} guard.");
            } else {
                $this->command->warn("Admin role with {$guard} guard not found. Permissions were not assigned.");
            }
        }
    }
}
