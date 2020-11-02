<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AttributeFamilyTableSeeder::class,
            AttributeGroupTableSeeder::class,
            AttributeTableSeeder::class,
            AttributeOptionTableSeeder::class,
            ProductSeeder::class,
            ProductFlatSeeder::class
        ]);
    }
}
