<?php

namespace App\View\Components\Form\Input;

use Illuminate\View\Component;

class Select extends Component
{
    public $label;

    public $selectedValue;

    public $name;

    public $options;

    public function __construct($name, $options, $selectedValue = null, $label = null)
    {
        $this->name = $name;
        $this->options = $options;
        $this->selectedValue = $selectedValue;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.form.input.select');
    }
}
