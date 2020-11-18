<?php

namespace Database\Seeders;

use App\Models\Vendor\VendorReview;
use Illuminate\Database\Seeder;

class VendorReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorReview::factory()
            ->times(10)
            ->create();
    }
}
