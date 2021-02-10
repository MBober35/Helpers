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

    /**
     * Получить класс для li.
     *
     * @param object $item
     * @param string $begin
     * @return string
     */
    public function getListClass(object $item, string $begin = "")
    {
        $class = [];
        if (! empty($begin)) $class[] = $begin;
        if ($item->children) $class[] = "dropdown";
        return implode(" ", $class);
    }

    /**
     * Получить класс для li.
     *
     * @param object $item
     * @param string $begin
     * @return string
     */
    public function getKitListClass(object $item, string $begin = "")
    {
        $class = [];
        if (! empty($begin)) $class[] = $begin;
        if ($this->getActive($item)) $class[] = "active";
        return implode(" ", $class);
    }

    /**
     * Получить класс для ссылки.
     *
     * @param object $item
     * @param $active
     * @param string $begin
     * @return string
     */
    public function getLinkClass(object $item, $active, string $begin = "")
    {
        $class = [];
        if (! empty($begin)) $class[] = $begin;
        if ($item->children) $class[] = "dropdown-toggle";
        if ($item->class) $class[] = $item->class;
        if ($active) $class[] = "active";
        return implode(" ", $class);
    }

    /**
     * Получить класс для ссылки.
     *
     * @param object $item
     * @param string $begin
     * @return string
     */
    public function getKitLinkClass(object $item, string $begin = "")
    {
        $class = [];
        if (! empty($begin)) $class[] = $begin;
        if ($item->children) $class[] = "collapsed";
        if ($item->class) $class[] = $item->class;
        return implode(" ", $class);
    }

    /**
     * Активная ссылка.
     *
     * @param object $item
     * @return bool
     */
    public function getActive(object $item)
    {
        if (! $item->route && empty($item->children)) return false;
        if ($item->single) return $this->name() === $item->route;
        return $this->makeSubRoutes($item);
    }

    /**
     * Проверить условие активации ссылки на подстраницах.
     *
     * @param object $item
     * @return bool
     */
    protected function makeSubRoutes(object $item)
    {
        $fullName = $this->name();
        $current = $this->splitRoute($fullName);
        $activeRoutes = $this->getChildrenRoutes($item);
        $disabledRoutes = [];
        foreach ($item->active as $route) {
            if (strripos($route, "!") === 0) {
                if (strripos($route, "*") !== false) {
                    $result = $this->splitRoute($route);
                } else {
                    $result = $route;
                }
                $disabledRoutes[] = str_replace("!", "", $result);
            }
            else {
                $result = $this->splitRoute($route);
                $activeRoutes[] = $result;
            }
        }
        if (
            in_array($current, $disabledRoutes) ||
            in_array($fullName, $disabledRoutes)
        ) return false;
        return in_array($current, $activeRoutes);
    }

    /**
     * Дочернии пути.
     *
     * @param $item
     */
    protected function getChildrenRoutes($item)
    {
        $activeRoutes = [];
        foreach ($item->children as $child) {
            if (! $child->route) continue;
            $activeRoutes[] = $this->splitRoute($child->route);
        }
        if ($item->route) {
            $activeRoutes[] = $this->splitRoute($item->route);
        }
        return array_unique($activeRoutes);
    }

    /**
     * Разбить путь.
     *
     * @param $route
     * @return string
     */
    protected function splitRoute($route)
    {
        $exploded = explode(".", $route);
        if (count($exploded) == 1) return $route;
        $str = [];
        for ($i = 0; $i < count($exploded) - 1; $i++) {
            $str[] = $exploded[$i];
        }
        return implode(".", $str);
    }
}