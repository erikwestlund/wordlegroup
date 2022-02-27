<?php

namespace App\View\Components\Form\Input;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;
use function view;

class Text extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $errors;

    public function __construct($name, $errors =  null, $label = '', $placeholder = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->errors = $errors ?? new ViewErrorBag();;
    }

    public function render()
    {
        return view('components.form.input.text');
    }
}
