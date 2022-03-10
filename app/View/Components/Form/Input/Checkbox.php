<?php

namespace App\View\Components\Form\Input;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;

    public $label;

    public $tip;

    public $errors;

    public function __construct($name, $label, $errors = null, $tip = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->tip = $tip;
        $this->errors = $errors ?? new ViewErrorBag();;
    }

    public function render()
    {
        return view('components.form.input.checkbox');
    }
}
