<?php

namespace MBober35\Helpers\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;
use MBober35\Helpers\Exceptions\PreventActionException;

class UniversalPriority extends Component
{
    /**
     * Таблица.
     *
     * @var string
     */
    public $table;

    /**
     * Поле.
     *
     * @var string
     */
    public $field;

    /**
     * Name
     *
     * @var array
     */
    public $elements;

    /**
     * UniversalPriority constructor.
     * @param string $table
     * @param array $elements
     * @param string $field
     */
    public function __construct(string $table, array $elements, string $field = "priority")
    {
        $this->table = $table;
        $this->field = $field;
        $this->elements = $elements;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view("helpers::components.universal-priority");
    }
}
