<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programming = Category::create([
            'nama' => 'Programming',
            'slug' => 'programming'
        ]);

        $dailylife = Category::create([
            'nama' => 'Daily Life',
            'slug' => 'daily-life'
        ]);

        $dailylife = Category::create([
            'nama' => 'No Category',
            'slug' => 'no-category'
        ]);
    }
}
