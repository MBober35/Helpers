<?php

namespace MBober35\Helpers\View\Components;

use Illuminate\View\Component;
use MBober35\Helpers\Facades\MenuStructure;

class NavList extends Component
{
    /**
     * Menu key.
     *
     * @var string
     */
    public $key;

    /**
     * Template
     *
     * @var string
     */
    public $blade;

    /**
     * Menu sturcture.
     *
     * @var array
     */
    public $structure;

    /**
     * Create a new component instance.
     *
     * InvisibleReCaptcha constructor.
     * @param string $callback
     */
    public function __construct($key, $blade = "nav-list")
    {
        $this->key = $key;
        $this->structure = MenuStructure::getStructureByKey($key);
        if (in_array($blade, ["nav-list", "kit-nav-list"])) {
            $this->blade = $blade;
        }
        else {
            $this->blade = "nav-list";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view("helpers::components.{$this->blade}");
    }
}
