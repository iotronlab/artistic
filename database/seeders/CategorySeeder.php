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
            ['id' => 1, 'name' => 'Artworks', 'slug' => 'art', 'parent_id' => null],
            ['id' => 2, 'name' => 'Home Decor', 'slug' => 'home-decor', 'parent_id' => null],
            ['id' => 3, 'name' => 'Clothing & Accessories', 'slug' => 'accessories', 'parent_id' => null],
            ['id' => 4, 'name' => 'Gifts', 'slug' => 'gifts', 'parent_id' => null],

            ['id' => 5, 'name' => 'Traditional Art', 'slug' => 'traditional-art', 'parent_id' => 1],
            ['id' => 6, 'name' => 'Modern Art', 'slug' => 'modern-art', 'parent_id' => 1],
            ['id' => 7, 'name' => 'Contemporary Art', 'slug' => 'contemporary-art', 'parent_id' => 1],
            ['id' => 8, 'name' => 'New Art', 'slug' => 'new-art', 'parent_id' => 1],

            ['id' => 9, 'name' => 'Madhubani', 'slug' => 'madhubani', 'parent_id' => 5],
            ['id' => 10, 'name' => 'Rajasthani', 'slug' => 'rajasthani', 'parent_id' => 5],
            ['id' => 11, 'name' => 'Folk', 'slug' => 'folk', 'parent_id' => 5],
            ['id' => 12, 'name' => 'Tribal', 'slug' => 'tribal', 'parent_id' => 5],
            ['id' => 13, 'name' => 'Phad', 'slug' => 'phad', 'parent_id' => 5],
            ['id' => 14, 'name' => 'Warli', 'slug' => 'warli', 'parent_id' => 5],
            ['id' => 15, 'name' => 'Patachitra', 'slug' => 'patachitra', 'parent_id' => 5],
            ['id' => 16, 'name' => 'Tanjore', 'slug' => 'tanjore', 'parent_id' => 5],
            ['id' => 17, 'name' => 'Kalamazhuthu', 'slug' => 'kalamezhuthu', 'parent_id' => 5],
            ['id' => 18, 'name' => 'Gond', 'slug' => 'gond', 'parent_id' => 5],
            ['id' => 19, 'name' => 'Miniature Painting', 'slug' => 'miniature-painting', 'parent_id' => 5],
            ['id' => 20, 'name' => 'Kalamkari', 'slug' => 'kalamkari', 'parent_id' => 5],
            ['id' => 21, 'name' => 'Cheriyal Scrolls', 'slug' => 'cheriyal-scrolls', 'parent_id' => 5],
            ['id' => 22, 'name' => 'Kalighat Painting', 'slug' => 'kalighat-painting', 'parent_id' => 5],
            ['id' => 23, 'name' => 'Picchwal', 'slug' => 'picchwal', 'parent_id' => 5],
            ['id' => 24, 'name' => 'Kerala Murals', 'slug' => 'kerala-murals', 'parent_id' => 5],
            ['id' => 25, 'name' => 'Dhokra Art', 'slug' => 'dhokra-art', 'parent_id' => 5],

            ['id' => 26, 'name' => 'Abstract Art', 'slug' => 'abstract-art', 'parent_id' => 6],
            ['id' => 27, 'name' => 'Concept Art', 'slug' => 'concept-art-1', 'parent_id' => 6],
            ['id' => 28, 'name' => 'Pattern/Design', 'slug' => 'pattern-design', 'parent_id' => 6],
            ['id' => 29, 'name' => 'Minimalistic', 'slug' => 'minimalistic', 'parent_id' => 6],
            ['id' => 30, 'name' => 'Figurative', 'slug' => 'figurative', 'parent_id' => 6],
            ['id' => 31, 'name' => 'Panel', 'slug' => 'panel', 'parent_id' => 6],
            ['id' => 32, 'name' => 'Digital Art', 'slug' => 'digital-art', 'parent_id' => 6],
            ['id' => 33, 'name' => 'Impasto/Texture', 'slug' => 'impasto-texture', 'parent_id' => 6],
            ['id' => 34, 'name' => 'Doodle Art', 'slug' => 'doddle-art', 'parent_id' => 6],
            ['id' => 35, 'name' => 'Gothic Art', 'slug' => 'gothic-art', 'parent_id' => 6],

            ['id' => 36, 'name' => 'Landscapes', 'slug' => 'landscapes', 'parent_id' => 7],
            ['id' => 37, 'name' => 'Seascopes', 'slug' => 'seacopes', 'parent_id' => 7],
            ['id' => 38, 'name' => 'Silhoutte', 'slug' => 'silhoutte', 'parent_id' => 7],
            ['id' => 39, 'name' => 'Floral Art', 'slug' => 'floral-art', 'parent_id' => 7],
            ['id' => 40, 'name' => 'Clay Art', 'slug' => 'clay-art', 'parent_id' => 7],
            ['id' => 41, 'name' => 'Realistic Art', 'slug' => 'realistic-art', 'parent_id' => 7],
            ['id' => 42, 'name' => 'Miniature Art', 'slug' => 'miniature-art', 'parent_id' => 7],
            ['id' => 43, 'name' => 'Still-life', 'slug' => 'still-life', 'parent_id' => 7],
            ['id' => 44, 'name' => 'Mandala', 'slug' => 'mandala', 'parent_id' => 7],
            ['id' => 45, 'name' => 'Sketches', 'slug' => 'sketches', 'parent_id' => 7],
            ['id' => 46, 'name' => 'Anatomy', 'slug' => 'anatomy', 'parent_id' => 7],
            ['id' => 47, 'name' => 'Concept Art', 'slug' => 'concept-art-2', 'parent_id' => 7],

            ['id' => 48, 'name' => 'Stone', 'slug' => 'stone', 'parent_id' => 8],
            ['id' => 49, 'name' => 'String Art', 'slug' => 'string-art', 'parent_id' => 8],
            ['id' => 50, 'name' => 'Alcohol Art', 'slug' => 'alcohol-art', 'parent_id' => 8],
            ['id' => 51, 'name' => 'Resin Art', 'slug' => 'resin-art', 'parent_id' => 8],
            ['id' => 52, 'name' => 'Dot Art', 'slug' => 'dot-art', 'parent_id' => 8],

            ['id' => 53, 'name' => 'Carpets', 'slug' => 'carpets', 'parent_id' => 2],
            ['id' => 54, 'name' => 'Cushions', 'slug' => 'cushions', 'parent_id' => 2],
            ['id' => 55, 'name' => 'Macrames', 'slug' => 'macrames', 'parent_id' => 2],
            ['id' => 56, 'name' => 'Dream Catchers', 'slug' => 'dream-catchers', 'parent_id' => 2],
            ['id' => 57, 'name' => 'Bottle Art', 'slug' => 'bottle-art', 'parent_id' => 2],
            ['id' => 58, 'name' => 'Coasters', 'slug' => 'coasters', 'parent_id' => 2],
            ['id' => 59, 'name' => 'Name-Plates', 'slug' => 'name-plates', 'parent_id' => 2],
            ['id' => 60, 'name' => 'Key-Holder', 'slug' => 'key-holder', 'parent_id' => 2],
            ['id' => 61, 'name' => 'Ash Tray', 'slug' => 'ash-tray', 'parent_id' => 2],

            ['id' => 62, 'name' => 'T-shirts', 'slug' => 't-shirts', 'parent_id' => 3],
            ['id' => 63, 'name' => 'Sarees', 'slug' => 'sarees', 'parent_id' => 3],
            ['id' => 64, 'name' => 'Jewellery', 'slug' => 'jewellery', 'parent_id' => 3],
            ['id' => 65, 'name' => 'Shoes', 'slug' => 'shoes', 'parent_id' => 3],

            ['id' => 66, 'name' => 'Frames', 'slug' => 'frames', 'parent_id' => 4],
            ['id' => 67, 'name' => 'Cards', 'slug' => 'cards', 'parent_id' => 4],
            ['id' => 68, 'name' => 'Explosion Box', 'slug' => 'explosion-box', 'parent_id' => 4],
            ['id' => 69, 'name' => 'Bookmarks', 'slug' => 'bookmarks', 'parent_id' => 4],
            ['id' => 70, 'name' => 'Mugs', 'slug' => 'mugs', 'parent_id' => 4],
            ['id' => 71, 'name' => 'Pottery', 'slug' => 'pottery', 'parent_id' => 4],
            ['id' => 72, 'name' => 'Trinket Boxes', 'slug' => 'trinket-boxes', 'parent_id' => 4],
            ['id' => 73, 'name' => 'Tissue Boxes', 'slug' => 'tissue-boxes', 'parent_id' => 4],
            ['id' => 74, 'name' => 'Pots', 'slug' => 'pots', 'parent_id' => 4],
            ['id' => 75, 'name' => 'Diyas', 'slug' => 'diyas', 'parent_id' => 4],

        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
