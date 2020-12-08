<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WeeklyFeaturedProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:weekly';
    protected $initial = 0;
    protected $final = 5;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively changed featured products on weekly basis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //reset active products
        $last_product = DB::table('featured_products')
            ->where('is_active', '1')->pluck('order')->last();

        if ($last_product != null && $last_product != 10) {
            $this->initial = $last_product;
            $this->final = $this->final + $last_product;
        }

        DB::table('featured_products')->where('is_active', 1)->update(['is_active' => '0']);

        //Active next 5 products
        $products = DB::table('featured_products')
            ->where('order', '>', $this->initial)
            ->where('order', '<=', $this->final)
            ->update(['is_active' => '1']);
        $this->info('Successfully changed featured products.');
    }
}
