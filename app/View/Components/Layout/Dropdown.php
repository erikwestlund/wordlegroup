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

    public $buttonSlot;

    public $alignDropdown;

    public $dropdownCustom;

    public function __construct($name, $label = null, $width = 'w-64 ', $buttonClass = null, $dropdownCustom = null, $alignDropdown = 'center')
    {
        $this->name = $name;
        $this->label = $label;
        $this->buttonClass = $buttonClass;
        $this->width = $width;
        $this->dropdownCustom = $dropdownCustom;
        $this->alignDropdown = $alignDropdown;
    }

    public function render()
    {
        return view('components.layout.dropdown');
    }
}
