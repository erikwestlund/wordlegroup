<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class PageContainer extends Component
{
    public $heading;

    public $title;

    public $headingTextColor;

    public $wide;

    public $topPadding;

    public $errorMessage;

    public function __construct($title, $topPadding = true, $heading = null, $wide = false, $headingTextColor = null, $errorMessage = null)
    {
        $this->heading = $heading;
        $this->topPadding = $topPadding;
        $this->title = $title;
        $this->wide = $wide;
        $this->headingTextColor = $headingTextColor;
        $this->errorMessage = $errorMessage;
    }

    public function render()
    {
        return view('components.layout.page-container');
    }
}
