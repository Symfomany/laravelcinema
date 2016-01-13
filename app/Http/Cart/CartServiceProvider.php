<?php

namespace App\Http\Cart;

use Illuminate\Support\ServiceProvider;

/**
 * To provide a Cart Solution in Laravel
 * Class CartServiceProvider
 * @package App\Http\Cart
 */
class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function ($app) {
            return new Cart();
        });
    }
}
