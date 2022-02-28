<?php

namespace App\View\Components\Form\Input;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $errors;

    public $label;

    public $name;

    public $rows;

    public $placeholder;

    public $tip;

    public function __construct($name, $rows = 3, $tip = '', $errors =  null, $label = '', $placeholder = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->rows = $rows;
        $this->placeholder = $placeholder;
        $this->tip = $tip;
        $this->errors = $errors ?? new ViewErrorBag();;
    }

    public function render()
    {
        return view('components.form.input.textarea');
    }
}
