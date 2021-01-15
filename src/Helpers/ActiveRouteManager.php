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
     * @param string $name
     * @param bool $trim
     * @return string
     */
    public function sliceActive(string $name, bool $trim = false)
    {
        $isActive = strstr($this->currentName, $name) !== false ? ' active' : '';
        return $trim ? trim($isActive) : $isActive;
    }

    /**
     * Получить имя текущего роута.
     *
     * @return string|null
     */
    public function getName()
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
    public function getItemPager(LengthAwarePaginator $items, int $iteration)
    {
        $perPage = $items->perPage();
        $page = $items->currentPage();
        return $iteration + $perPage * ($page - 1);
    }
}