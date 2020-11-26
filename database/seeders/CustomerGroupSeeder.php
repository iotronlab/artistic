<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_groups')->insert([
            'name' => 'General'
        ]);
        DB::table('customer_groups')->insert([
            'name' => 'Patron'
        ]);
    }
}
