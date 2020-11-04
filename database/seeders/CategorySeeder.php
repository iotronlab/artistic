<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Art & Craft', 'slug' => 'art', 'parent_id' => null],
            ['id' => 2, 'name' => 'Apparels', 'slug' => 'apparels', 'parent_id' => null],
            ['id' => 3, 'name' => 'Accessories', 'slug' => 'accessories', 'parent_id' => null],
            ['id' => 4, 'name' => 'Paintings', 'slug' => 'paintings', 'parent_id' => 1],
            ['id' => 5, 'name' => 'Posters', 'slug' => 'posters', 'parent_id' => 1],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
