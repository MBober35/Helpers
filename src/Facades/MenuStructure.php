<?php

namespace MBober35\Helpers\Facades;

use Illuminate\Support\Facades\Facade;
use MBober35\Helpers\Helpers\MenuStructureManager;

/**
 * @method static array getStructureByKey(string $key)
 *
 * @see MenuStructureManager
 */
class MenuStructure extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "menu-structure";
    }
}