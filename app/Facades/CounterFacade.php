<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CounterFacade extends Facade
{
    /**
     * @method static int increment(string $key, array $tags = null)
     */
    public static function getFacadeAccessor()
    {
        return 'App\Contracts\CounterContract';
    }
}