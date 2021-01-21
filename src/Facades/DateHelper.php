<?php

namespace MBober35\Helpers\Facades;

use Carbon\Carbon;
use Illuminate\Support\Facades\Facade;
use MBober35\Helpers\Helpers\DateHelperManager;

/**
 * @method DateHelperManager tz($timeZone = "")
 * @method Carbon|null changeTz($value)
 * @method Carbon|null format($value, $format = "d.m.Y H:i")
 * @method Carbon|null dateTo($value)
 * @method Carbon|null dateFrom($value)
 * @method Carbon|null toUtc($value)
 *
 * @see DateHelperManager
 */
class DateHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "date-helper";
    }
}