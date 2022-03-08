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

    public $pickerName;

    public $placeholder;

    public $defaultValue;

    public function __construct($name, $errors = null, $options = [], $label = '', $placeholder = '', $defaultValue = null)
    {
        $this->name = $name;
        $this->defaultValue = $defaultValue ?? now()->format('Y-m-d');
        $this->pickerName = 'picker_' . uniqid();
        $this->label = $label;
        $this->options = $this->getOptions($options);
        $this->placeholder = $placeholder;
        $this->errors = $errors ?? new ViewErrorBag();
    }

    public function getOptions($options)
    {
        return array_merge([
            'dateFormat' => 'Y-m-d',
            'defaultDate' => now()->format('Y-m-d'),
            'enableTime' => false,
        ], $options);
    }

    public function render()
    {
        return view('components.form.input.date');
    }
}
