<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeFamilyTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('attribute_families')->delete();

        DB::table('attribute_families')->insert([
            [
                'id'              => '1',
                'code'            => 'default-1',
                'name'            => 'Default(color, material, medium, size)',
                'status'          => '0',
            ],
            [
                'id'              => '2',
                'code'            => 'default-2',
                'name'            => 'Default Artworks(color, material, medium)',
                'status'          => '0',
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
