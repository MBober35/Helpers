<?php

namespace MBober35\Helpers\Helpers;

use Illuminate\Support\Facades\Route;

class MenuStructureManager
{
    protected $menuItem;

    public function __construct()
    {
        $menuItem = (object) [];
    }

    /**
     * Получить структуру по ключу.
     *
     * @param string $key
     * @return array
     */
    public function getStructureByKey(string $key)
    {
        if (empty(config("menu-structure.{$key}"))) return [];
        $result = $this->prepareStructure(config("menu-structure.{$key}"));
        return $result;
    }

    protected function prepareStructure(array $structure)
    {
        $result = [];
        $i = 0;
        foreach ($structure as $menuItem) {
            if (! is_object($menuItem)) continue;
            $i++;
            $result[] = $this->prepareMenuItem($menuItem, $i);
        }
        return $result;
    }

    protected function prepareMenuItem(object $menuItem, $iteration) {
        $this->menuItem = clone $menuItem;
        $this->fillDefault($iteration);
        if (! empty($this->menuItem->method)) {
            // TODO: make for method.
            $this->menuItem->children = [];
        }
        else {
            $this->fillChildren($iteration);
        }
        $this->checkRoute();
        $result = clone $this->menuItem;
        return $result;
    }

    /**
     * Подготовить дочернии.
     *
     * @param $iteration
     */
    protected function fillChildren($iteration)
    {
        $iteration *= 10;
        $currentMenuItem = clone $this->menuItem;
        $children = [];
        foreach ($this->menuItem->children as $child) {
            $this->prepareMenuItem($child, $iteration);
            $children[] = clone $this->menuItem;
        }
        $currentMenuItem->children = $children;
        $this->menuItem = clone $currentMenuItem;
    }

    /**
     * Добавить необходимые свойства.
     */
    protected function fillDefault($iteration)
    {
        $this->setDefaultProp("id", $iteration);
        $this->setDefaultProp("method");
        $this->setDefaultProp("template");
        $this->setDefaultProp("url", "/");
        $this->setDefaultProp("route");
        $this->setDefaultProp("gate");
        $this->setDefaultProp("children", []);
        $this->setDefaultProp("class");
        $this->setDefaultProp("class");
        $this->setDefaultProp("active", []);
        $this->setDefaultProp("single");
        $this->setDefaultProp("target");
        $this->setDefaultProp("ico");
    }

    /**
     * Добавить свойстрово.
     *
     * @param object $menuItem
     * @param string $prop
     * @param false $value
     */
    protected function setDefaultProp(string $prop, $value = false)
    {
        if (! empty($this->menuItem->{$prop})) return;
        $this->menuItem->{$prop} = $value;
    }

    /**
     * Проверить путь.
     *
     * @return false
     */
    protected function checkRoute()
    {
        if ($this->menuItem->route && Route::has($this->menuItem->route)) {
            $this->menuItem->url = route($this->menuItem->route);
        }
        elseif (! Route::has($this->menuItem->route)) {
            $this->menuItem->route = false;
        }
    }
}