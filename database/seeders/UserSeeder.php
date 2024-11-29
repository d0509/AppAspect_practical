<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        $user = User::create([
            'name' => 'Datta Pandya',
            'email' => 'datta@yopmail.com',
            'password' => '123'
        ]);

        $user->assignRole('admin');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
