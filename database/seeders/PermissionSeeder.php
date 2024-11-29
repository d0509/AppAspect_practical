<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        $permissions = [
            ['name' => 'Add Category'],
            ['name' => 'Edit Category'],
            ['name' => 'View Category'],
            ['name' => 'Delete Category']
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
