<?php

namespace App\Providers;

use App\Helpers\ShipRocket;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ShipRocketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ShipRocket::class, function () {
            $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                'email' => 'sarthak.k7189@gmail.com',
                'password' => 'Anik@9046',
            ])['token'];
            return new ShipRocket($response);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
