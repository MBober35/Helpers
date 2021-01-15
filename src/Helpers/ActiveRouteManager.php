<?php

namespace MBober35\Helpers\Helpers;

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
}