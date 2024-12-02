<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        // Create user and assign roles
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => '123',
        ]);

        $user->assignRole('admin');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
