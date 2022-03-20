<?php

namespace App\View\Components\Form\Input;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;
use function view;

class Text extends Component
{
    public $errors;

    public $label;

    public $name;

    public $placeholder;

    public $tip;

    public function __construct($name, $errors = null, $label = '', $placeholder = '', $tip = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->tip = $tip;
        $this->errors = $errors ?? new ViewErrorBag();;
    }

    public function render()
    {
        return view('components.form.input.text');
    }
}
