<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArtisticInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artistic:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrate and seed command, config, link storage and run other commands';

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
        // cached new changes
        $this->warn('Step: Caching new changes...');
        $cached = $this->call('config:cache');
        $this->info($cached);

        // waiting for 2 seconds
        $this->warn('Please wait...');
        sleep(2);

        // running `php artisan migrate`
        $this->warn('Step: Migrating all tables into database...');
        $migrate = $this->call('migrate:fresh');
        $this->info($migrate);

        // running `php artisan shiprocket:fetch`
        $this->warn('Step: Fetching Countries from ShipRocketApi');
        $result = $this->call('shiprocket:fetch');
        $this->info($result);

        // running `php artisan db:seed`
        $this->warn('Step: seeding basic data for artistic kickstart...');
        $result = $this->call('db:seed');
        $this->info($result);


        // running `php artisan passport:install`
        $this->warn('Step: Installing Passport');
        $result = $this->call('passport:install');
        $this->info($result);

        // running `php artisan voyager:install`
        $this->warn('Step: Installing Admin Package Voyager');
        $result = $this->call('voyager:install');
        $this->info($result);

        // running `php artisan storage:link`
        $this->warn('Step: Linking Storage directory...');
        $result = $this->call('storage:link');
        $this->info($result);

        // running `composer dump-autoload`
        $this->warn('Step: Composer Autoload...');
        $result = shell_exec('composer dump-autoload');
        $this->info($result);

        $this->info('-----------------------------');
        $this->info('Congratulations!');
        $this->info('The installation has been finished and you can now use Artistic.');
    }
}
