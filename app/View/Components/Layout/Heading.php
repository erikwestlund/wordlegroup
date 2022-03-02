<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Heading extends Component
{
    public $textColor;

    public $wide;

    public function __construct($textColor = null, $wide = false)
    {
        $this->textColor = $textColor;
        $this->wide = $wide;
    }

    public function render()
    {
        return view('components.layout.heading');
    }
}
