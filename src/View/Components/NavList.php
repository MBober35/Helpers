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
    public function __construct($key)
    {
        $this->key = $key;
        $this->structure = MenuStructure::getStructureByKey($key);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('helpers::components.nav-list');
    }
}
