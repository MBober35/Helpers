<?php

namespace MBober35\Helpers\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class ActiveRouteManager
{
    protected $currentRoute;
    protected $currentName;

    public function __construct()
    {
        $this->currentRoute = request()->route();
        $this->currentName = $this->currentRoute->getName();
    }

    /**
     * Проверить, есть ли в текущем роуте входная строка.
     *
     * @param mixed $name
     * @param bool $trim
     * @return string
     */
    public function sliceActive($name, bool $trim = false)
    {
        if (! is_array($name)) $name = [$name];
        foreach ($name as $item) {
            $isActive = strstr($this->currentName, $item) !== false ? ' active' : '';
            if ($isActive) break;
        }
        return $trim ? trim($isActive) : $isActive;
    }

    /**
     * Получить имя текущего роута.
     *
     * @return string|null
     */
    public function name()
    {
        return $this->currentName;
    }

    /**
     * Порядковый номер элемента в запросе.
     *
     * @param LengthAwarePaginator $items
     * @param int $iteration
     * @return float|int
     */
    public function pager(LengthAwarePaginator $items, int $iteration)
    {
        $perPage = $items->perPage();
        $page = $items->currentPage();
        return $iteration + $perPage * ($page - 1);
    }
}