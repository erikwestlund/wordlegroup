<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $name;

    public $width;

    public $id;

    public $label;

    public $buttonClass;

    public function __construct($name, $label, $width = 'w-64 ', $buttonClass = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->buttonClass = $buttonClass;
        $this->width = $width;
    }

    public function render()
    {
        return view('components.layout.dropdown');
    }
}
