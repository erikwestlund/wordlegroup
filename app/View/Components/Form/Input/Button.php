<?php

namespace App\View\Components\Form\Input;

use Illuminate\View\Component;

class Button extends Component
{
    public $primary;

    public $loadingAction;

    public $width;

    public function __construct($primary = true, $loadingAction = null, $width = 'w-auto')
    {
        $this->primary = $primary;
        $this->loadingAction = $loadingAction;
        $this->width = $width;
    }

    public function render()
    {
        return view('components.form.input.button');
    }
}
