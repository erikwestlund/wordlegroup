<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $alignDropdown;

    public $buttonClass;

    public $buttonSlot;

    public $chevronTextColor;

    public $dropdownCustom;

    public $id;

    public $label;

    public $name;

    public $width;

    public function __construct(
        $name,
        $label = null,
        $width = 'w-64 ',
        $buttonClass = null,
        $dropdownCustom = null,
        $alignDropdown = 'center',
        $chevronTextColor = 'text-gray-500'
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->buttonClass = $buttonClass;
        $this->width = $width;
        $this->dropdownCustom = $dropdownCustom;
        $this->alignDropdown = $alignDropdown;
        $this->chevronTextColor = $chevronTextColor;
    }

    public function render()
    {
        return view('components.layout.dropdown');
    }
}
