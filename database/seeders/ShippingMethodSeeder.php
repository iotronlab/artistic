<?php

namespace Database\Seeders;

use App\Models\Order\ShippingMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tax_categories')->delete();


        $json = Storage::disk('local')->get('data/shipping-methods.json');
        $data = json_decode($json);
        foreach ($data as $shipping) {
            ShippingMethod::create(array(
                'name' => $shipping->name,
                'courier_partner' => $shipping->courier,
                'type' => $shipping->type,
                'price' => $shipping->price,
            ));
        }

        DB::table('country_shipping_method')->insert([
            [
                'country_id' => 99,
                'shipping_method_id' => 1
            ],
            [
                'country_id' => 99,
                'shipping_method_id' => 2
            ],
        ]);
    }
}
