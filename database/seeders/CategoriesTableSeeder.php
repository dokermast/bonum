<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'parent_id' => 0,
            'name' => 'Art',
            'slug' => 'art',
            'status' => 0,
        ]);
        Category::create([
            'id' => 2,
            'parent_id' => 1,
            'name' => 'Cinema',
            'slug' => 'cinema',
            'status' => 0,
        ]);
        Category::create([
            'id' => 3,
            'parent_id' => 1,
            'name' => 'Theatre',
            'slug' => 'theatre',
            'status' => 0,
        ]);
        Category::create([
            'id' => 4,
            'parent_id' => 0,
            'name' => 'Sport',
            'slug' => 'sport',
            'status' => 0,
        ]);
        Category::create([
            'id' => 5,
            'parent_id' => 4,
            'name' => 'Football',
            'slug' => 'football',
            'status' => 0,
        ]);
        Category::create([
            'id' => 6,
            'parent_id' => 4,
            'name' => 'Box',
            'slug' => 'box',
            'status' => 0,
        ]);
    }
}
