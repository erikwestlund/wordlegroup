<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class SubHeading extends Component
{
    public $textColor;

    public function __construct($textColor = '')
    {
        $this->textColor = $textColor;
    }
    public function render()
    {
        return view('components.layout.sub-heading');
    }
}
