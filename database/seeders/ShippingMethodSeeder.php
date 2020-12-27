<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_methods')->insert([
            'name' => 'ShipRocket'
        ]);
        DB::table('country_shipping_method')->insert([
            'country_id' => 99,
            'shipping_method_id' => 1
        ]);
    }
}
