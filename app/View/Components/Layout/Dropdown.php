<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $name;

    public $id;

    public $active;

    public $label;

    public function __construct($name, $label, $active = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->active = $active;
    }

    public function render()
    {
        return view('components.layout.dropdown');
    }
}
