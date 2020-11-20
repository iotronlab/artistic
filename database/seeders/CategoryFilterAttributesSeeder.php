<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFilterAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('category_filterable_attributes')->delete();

        DB::table('category_filterable_attributes')->insert([
            [
                'category_id'              => '1',
                'attribute_id'            => '19',
            ],
            [
                'category_id'              => '1',
                'attribute_id'            => '21',
            ],
            [
                'category_id'              => '1',
                'attribute_id'            => '22',
            ],
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
