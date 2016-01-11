<?php

namespace App\Http\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Cart.
 */
class Cart extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Http\Cart\Cart';
    }
}
