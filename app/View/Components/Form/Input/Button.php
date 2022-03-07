<?php

namespace App\View\Components\Form\Input;

use Illuminate\View\Component;

class Button extends Component
{
    public $primary;

    public function __construct($primary = true)
    {
        $this->primary = $primary;
    }

    public function render()
    {
        return view('components.form.input.button');
    }
}
