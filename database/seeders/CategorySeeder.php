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
            ['id' => 1, 'name' => 'Artworks', 'url' => 'art', 'parent_id' => null],
            ['id' => 2, 'name' => 'Home Decor', 'url' => 'home-decor', 'parent_id' => null],
            ['id' => 3, 'name' => 'Clothing & Accessories', 'url' => 'accessories', 'parent_id' => null],
            ['id' => 4, 'name' => 'Gifts', 'url' => 'gifts', 'parent_id' => null],

            ['id' => 5, 'name' => 'Traditional Art', 'url' => 'traditional-art', 'parent_id' => 1],
            ['id' => 6, 'name' => 'Modern Art', 'url' => 'modern-art', 'parent_id' => 1],
            ['id' => 7, 'name' => 'Contemporary Art', 'url' => 'contemporary-art', 'parent_id' => 1],
            ['id' => 8, 'name' => 'New Art', 'url' => 'new-art', 'parent_id' => 1],

            [
                'id' => 9, 'name' => 'Madhubani', 'url' => 'madhubani', 'parent_id' => 5,
                'meta_desc' => "Madhubani art is a traditional folk art style. Also called the mithila art, these paintings
                are so beautifully detailed and don't leave any empty gaps. These are often made on
                cloth, canvas and cow dung paper."
            ],
            ['id' => 10, 'name' => 'Rajasthani', 'url' => 'rajasthani', 'parent_id' => 5],
            ['id' => 11, 'name' => 'Folk', 'url' => 'folk', 'parent_id' => 5],
            ['id' => 12, 'name' => 'Tribal', 'url' => 'tribal', 'parent_id' => 5],
            ['id' => 13, 'name' => 'Phad', 'url' => 'phad', 'parent_id' => 5],
            ['id' => 14, 'name' => 'Warli', 'url' => 'warli', 'parent_id' => 5],
            ['id' => 15, 'name' => 'Patachitra', 'url' => 'patachitra', 'parent_id' => 5],
            ['id' => 16, 'name' => 'Tanjore', 'url' => 'tanjore', 'parent_id' => 5],
            ['id' => 17, 'name' => 'Kalamazhuthu', 'url' => 'kalamezhuthu', 'parent_id' => 5],
            ['id' => 18, 'name' => 'Gond', 'url' => 'gond', 'parent_id' => 5],
            ['id' => 19, 'name' => 'Miniature Painting', 'url' => 'miniature-painting', 'parent_id' => 5],
            ['id' => 20, 'name' => 'Kalamkari', 'url' => 'kalamkari', 'parent_id' => 5],
            ['id' => 21, 'name' => 'Cheriyal Scrolls', 'url' => 'cheriyal-scrolls', 'parent_id' => 5],
            ['id' => 22, 'name' => 'Kalighat Painting', 'url' => 'kalighat-painting', 'parent_id' => 5],
            ['id' => 23, 'name' => 'Picchwal', 'url' => 'picchwal', 'parent_id' => 5],
            ['id' => 24, 'name' => 'Kerala Murals', 'url' => 'kerala-murals', 'parent_id' => 5],
            ['id' => 25, 'name' => 'Dhokra Art', 'url' => 'dhokra-art', 'parent_id' => 5],

            ['id' => 26, 'name' => 'Abstract Art', 'url' => 'abstract-art', 'parent_id' => 6],
            ['id' => 27, 'name' => 'Concept Art', 'url' => 'concept-art', 'parent_id' => 6],
            ['id' => 28, 'name' => 'Pattern/Design', 'url' => 'pattern-design', 'parent_id' => 6],
            ['id' => 29, 'name' => 'Minimalistic', 'url' => 'minimalistic', 'parent_id' => 6],
            ['id' => 30, 'name' => 'Figurative', 'url' => 'figurative', 'parent_id' => 6],
            ['id' => 31, 'name' => 'Panel', 'url' => 'panel', 'parent_id' => 6],
            ['id' => 32, 'name' => 'Digital Art', 'url' => 'digital-art', 'parent_id' => 6],
            ['id' => 33, 'name' => 'Impasto/Texture', 'url' => 'impasto-texture', 'parent_id' => 6],
            ['id' => 34, 'name' => 'Doodle Art', 'url' => 'doddle-art', 'parent_id' => 6],
            ['id' => 35, 'name' => 'Gothic Art', 'url' => 'gothic-art', 'parent_id' => 6],

            ['id' => 36, 'name' => 'Landscapes', 'url' => 'landscapes', 'parent_id' => 7],
            ['id' => 37, 'name' => 'Seascopes', 'url' => 'seacopes', 'parent_id' => 7],
            ['id' => 38, 'name' => 'Silhoutte', 'url' => 'silhoutte', 'parent_id' => 7],
            ['id' => 39, 'name' => 'Floral Art', 'url' => 'floral-art', 'parent_id' => 7],
            ['id' => 40, 'name' => 'Clay Art', 'url' => 'clay-art', 'parent_id' => 7],
            ['id' => 41, 'name' => 'Realistic Art', 'url' => 'realistic-art', 'parent_id' => 7],
            ['id' => 42, 'name' => 'Miniature Art', 'url' => 'miniature-art', 'parent_id' => 7],
            ['id' => 43, 'name' => 'Still-life', 'url' => 'still-life', 'parent_id' => 7],
            ['id' => 44, 'name' => 'Mandala', 'url' => 'mandala', 'parent_id' => 7],
            ['id' => 45, 'name' => 'Sketches', 'url' => 'sketches', 'parent_id' => 7],
            ['id' => 46, 'name' => 'Anatomy', 'url' => 'anatomy', 'parent_id' => 7],


            ['id' => 47, 'name' => 'Stone', 'url' => 'stone', 'parent_id' => 8],
            ['id' => 48, 'name' => 'String Art', 'url' => 'string-art', 'parent_id' => 8],
            ['id' => 49, 'name' => 'Alcohol Art', 'url' => 'alcohol-art', 'parent_id' => 8],
            ['id' => 50, 'name' => 'Resin Art', 'url' => 'resin-art', 'parent_id' => 8],
            ['id' => 51, 'name' => 'Dot Art', 'url' => 'dot-art', 'parent_id' => 8],

            ['id' => 52, 'name' => 'Carpets', 'url' => 'carpets', 'parent_id' => 2],
            ['id' => 53, 'name' => 'Cushions', 'url' => 'cushions', 'parent_id' => 2],
            ['id' => 54, 'name' => 'Macrames', 'url' => 'macrames', 'parent_id' => 2],
            ['id' => 55, 'name' => 'Dream Catchers', 'url' => 'dream-catchers', 'parent_id' => 2],
            ['id' => 56, 'name' => 'Bottle Art', 'url' => 'bottle-art', 'parent_id' => 2],
            ['id' => 57, 'name' => 'Coasters', 'url' => 'coasters', 'parent_id' => 2],
            ['id' => 58, 'name' => 'Name-Plates', 'url' => 'name-plates', 'parent_id' => 2],
            ['id' => 59, 'name' => 'Key-Holder', 'url' => 'key-holder', 'parent_id' => 2],
            ['id' => 60, 'name' => 'Ash Tray', 'url' => 'ash-tray', 'parent_id' => 2],

            ['id' => 61, 'name' => 'T-shirts', 'url' => 't-shirts', 'parent_id' => 3],
            ['id' => 62, 'name' => 'Sarees', 'url' => 'sarees', 'parent_id' => 3],
            ['id' => 63, 'name' => 'Jewellery', 'url' => 'jewellery', 'parent_id' => 3],
            ['id' => 64, 'name' => 'Shoes', 'url' => 'shoes', 'parent_id' => 3],

            ['id' => 65, 'name' => 'Frames', 'url' => 'frames', 'parent_id' => 4],
            ['id' => 66, 'name' => 'Cards', 'url' => 'cards', 'parent_id' => 4],
            ['id' => 67, 'name' => 'Explosion Box', 'url' => 'explosion-box', 'parent_id' => 4],
            ['id' => 68, 'name' => 'Bookmarks', 'url' => 'bookmarks', 'parent_id' => 4],
            ['id' => 69, 'name' => 'Mugs', 'url' => 'mugs', 'parent_id' => 4],
            ['id' => 70, 'name' => 'Pottery', 'url' => 'pottery', 'parent_id' => 4],
            ['id' => 71, 'name' => 'Trinket Boxes', 'url' => 'trinket-boxes', 'parent_id' => 4],
            ['id' => 72, 'name' => 'Tissue Boxes', 'url' => 'tissue-boxes', 'parent_id' => 4],
            ['id' => 73, 'name' => 'Pots', 'url' => 'pots', 'parent_id' => 4],
            ['id' => 74, 'name' => 'Diyas', 'url' => 'diyas', 'parent_id' => 4],

        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
