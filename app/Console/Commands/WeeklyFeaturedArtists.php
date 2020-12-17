<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WeeklyFeaturedArtists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artists:featured';
    protected $initial = 0;
    protected $final = 5;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively change featured artists on weekly basis';

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
        $last_artist = DB::table('featured_artists')
            ->where('is_active', '1')->pluck('order')->last();

        if ($last_artist != null && $last_artist != 20) {
            $this->initial = $last_artist;
            $this->final = $this->final + $last_artist;
        }

        DB::table('featured_artists')->where('is_active', 1)->update(['is_active' => '0']);

        //Active next 5 artists
        $artists = DB::table('featured_artists')
            ->where('order', '>', $this->initial)
            ->where('order', '<=', $this->final)
            ->update(['is_active' => '1']);
        $this->info('Successfully changed featured artists.');
    }
}
