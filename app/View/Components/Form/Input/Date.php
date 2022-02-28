<?php

namespace App\View\Components\Form\Input;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class Date extends Component
{
    public $errors;

    public $label;

    public $name;

    public $options;

    public $placeholder;

    public function __construct($name, $errors = null, $options = [], $label = '', $placeholder = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $this->getOptions($options);
        $this->placeholder = $placeholder;
        $this->errors = $errors ?? new ViewErrorBag();
    }

    public function getOptions($options)
    {
        return array_merge([
            'dateFormat' => 'Y-m-d',
            'enableTime' => false,
            'altFormat'  => 'Y-m-d',
            'altInput'   => true,
        ], $options);
    }

    public function render()
    {
        return view('components.form.input.date');
    }
}
