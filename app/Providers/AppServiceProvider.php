<?php

namespace App\Providers;

use App\Helpers\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {

            // auth('api')->user();


            return new Cart(auth('cust-api')->user());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
