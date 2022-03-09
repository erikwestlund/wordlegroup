<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class PageContainer extends Component
{
    public $caption;

    public $captionClass;

    public $captionSlot;

    public $errorMessage;

    public $heading;

    public $headingTextColor;

    public $title;

    public $topPadding;

    public $wide;

    public function __construct(
        $title,
        $topPadding = true,
        $heading = null,
        $caption = null,
        $captionClass = null,
        $wide = false,
        $headingTextColor = null,
        $errorMessage = null
    ) {
        $this->heading = $heading;
        $this->caption = $caption;
        $this->captionClass = $captionClass;
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
