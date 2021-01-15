<?php

namespace MBober35\Helpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static isActive(string $name)
 *
 * @see ActiveRouteManager
 */
class ActiveRoute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "active-route";
    }
}