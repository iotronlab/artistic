<?php

namespace Database\Seeders;

use App\Models\Product\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::factory()
            ->times(25)
            ->create();
    }
}
