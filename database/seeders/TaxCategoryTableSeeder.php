<?php

namespace Database\Seeders;

use App\Models\Tax\TaxCategory;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TaxCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_categories')->delete();


        $json = Storage::disk('local')->get('data/tax-categories.json');
        $data = json_decode($json);
        foreach ($data as $category) {
            TaxCategory::create(array(
                'name' => $category->name,
                'percent' => $category->percent,
                'description' => $category->description,
            ));
        }
    }
}
