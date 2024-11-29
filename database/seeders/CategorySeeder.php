<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();

        $categories = [
            [
                'name' => 'Food',
            ],
            [
                'name' => 'Travel',
            ],
            [
                'name' => 'Technology',
            ],
            [
                'name' => 'Lifestyle',
            ],
            [
                'name' => 'Comparison'
            ]
        ];

        Category::insert($categories);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
