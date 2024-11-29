<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Datta Pandya',
            'email' => 'datta@yopmail.com',
            'password' => '123'
        ]);

        $user->assignRole('admin');
    }
}
