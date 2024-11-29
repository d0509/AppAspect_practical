<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'name' => 'Add Category',
            'name' => 'Edit Category',
            'name' => 'View Category',
            'name' => 'Delete Category',
        ];
    }
}
