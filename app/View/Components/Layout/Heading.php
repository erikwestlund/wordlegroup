<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Heading extends Component
{
    public $textColor;

    public $wide;

    public $headingClass;

    public function __construct($textColor = null, $wide = false, $headingClass = null)
    {
        $this->textColor = $textColor;
        $this->wide = $wide;
        $this->headingClass = $headingClass;
    }

    public function render()
    {
        return view('components.layout.heading');
    }
}
