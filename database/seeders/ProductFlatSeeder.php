<?php

namespace Database\Seeders;

use App\Models\Product\Product;
use App\Models\Product\ProductFlat;
use Illuminate\Database\Seeder;

class ProductFlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductFlat::factory()
            ->count(1)
            ->for(Product::factory())
            ->times(25)
            ->create();
    }
}
