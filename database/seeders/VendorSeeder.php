<?php

namespace Database\Seeders;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vendor::factory()
        //     ->times(100)
        //     ->create();

        // Vendor::create([
        //     'display_name' => 'Helsinki',
        //     'contact_name' => 'Helsinki',
        //     'url' => 'helsinki',
        //     'contact' => '1234567890',
        //     'email' => 'vendor@artify.co.in',
        //     'password' => bcrypt('123456'),
        // ]);

        DB::table('vendors')->insert([
            'display_name' => 'Helsinki',
            'contact_name' => 'Helsinki',
            'url' => 'helsinki',
            'contact' => '1234567890',
            'email' => 'vendor@artify.co.in',
            'password' => bcrypt('123456'),
        ]);
    }
}
