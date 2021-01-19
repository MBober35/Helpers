<?php

namespace MBober35\Helpers\Facades;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string sliceActive(string $name, bool $trim = false)
 * @method static string name()
 * @method static int pager(LengthAwarePaginator $items, int $iteration)
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