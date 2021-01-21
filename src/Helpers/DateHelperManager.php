<?php

namespace MBober35\Helpers\Helpers;

use Carbon\Carbon;

class DateHelperManager
{
    public $timeZone;
    public $date;
    public $utc;

    public function __construct()
    {
        $this->timeZone = config("dates.tz");
        $this->utc = config("dates.utc");
        $this->date = null;
    }

    /**
     * Задать временную зону.
     *
     * @param string $timeZone
     * @return $this
     */
    public function tz($timeZone = "") {
        $this->timeZone = ! empty($timeZone) ? $timeZone : config("dates.tz");
        return $this;
    }

    /**
     * Изменить временную зону.
     *
     * @param $value
     * @return Carbon|null
     */
    public function changeTz($value)
    {
        if (empty($value)) return null;
        try {
            $carbon = new Carbon($value);
        }
        catch (\Exception $exception) {
            return null;
        }
        $carbon->timezone = $this->timeZone;
        return $carbon->toDateTimeString();
    }

    /**
     * Формат даты.
     *
     * @param $value
     * @param string $format
     * @return false|string|null
     */
    public function format($value, $format = "d.m.Y H:i")
    {
        if (empty($value)) return null;
        return date($format, strtotime($value));
    }

    /**
     * Дата от.
     *
     * @param $value
     * @return string|null
     */
    public function dateFrom($value)
    {
        if (empty($value)) return null;
        $value = "$value 00:00:00";
        return $this->toUtc($value);
    }

    /**
     * Дата до.
     *
     * @param $value
     * @return string|null
     */
    public function dateTo($value)
    {
        if (empty($value)) return null;
        $value = "$value 23:59:59";
        return $this->toUtc($value);
    }

    /**
     * Конвертировать в utc.
     *
     * @param $value
     * @return string|null
     */
    public function toUtc($value)
    {
        if (empty($value)) return null;
        try {
            $carbon = Carbon::createFromFormat("Y-m-d H:i:s", $value, $this->timeZone);
            $carbon->timezone = $this->utc;
            return $carbon->toDateTimeString();
        }
        catch (\Exception $exception) {
            return null;
        }
    }
}