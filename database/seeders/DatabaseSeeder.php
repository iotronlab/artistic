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
            CustomerSeeder::class,
            VendorSeeder::class,
            //VendorReview::class
            CategorySeeder::class,
            AttributeFamilyTableSeeder::class,
            AttributeGroupTableSeeder::class,
            AttributeTableSeeder::class,
            AttributeOptionTableSeeder::class,
            ProductFlatSeeder::class,
            //relation changed to url
            //ProductCategorySeeder::class,
            CategoryFilterAttributesSeeder::class,
            //StockSeeder::class,
            CustomerGroupSeeder::class,
            // ShippingMethodSeeder::class,
            // TaxCategoryTableSeeder::class
        ]);
    }
}
