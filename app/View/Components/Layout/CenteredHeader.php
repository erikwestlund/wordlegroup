<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class CenteredHeader extends Component
{
    public $textColor;

    public function __construct($textColor = null)
    {
        $this->textColor = $textColor;
    }

    public function render()
    {
        return view('components.layout.centered-header');
    }
}
