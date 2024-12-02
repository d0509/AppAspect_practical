<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues during truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate roles and permissions tables
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // Define roles
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'admin', 'guard_name' => 'api'],
            ['name' => 'editor', 'guard_name' => 'web'],
            ['name' => 'editor', 'guard_name' => 'api'],
        ];

        // Bulk insert roles
        Role::insert($roles);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
