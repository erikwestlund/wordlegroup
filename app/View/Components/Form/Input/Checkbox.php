<?php

namespace App\View\Components\Form\Input;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $label;
    public $tip;

    public function __construct($name, $label, $tip = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->tip = $tip;
    }

    public function render()
    {
        return view('components.form.input.checkbox');
    }
}
