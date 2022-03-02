<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class FlashMessage extends Component
{
    public $bgColor;

    public $borderColor;

    public $textColor;

    public $buttonIconFill;

    public $buttonIconHoverFill;

    public $type;

    public function __construct($type = 'success')
    {
        $this->type = $type;
        $this->setColors($type);
    }

    protected function setColors($type)
    {
        if($type === 'error') {
            $this->bgColor = 'bg-red-100';
            $this->textColor = 'text-red-800';
            $this->borderColor = 'border-red-700';
            $this->buttonIconFill = 'fill-red-700';
            $this->buttonIconHoverFill = 'fill-red-900';
        } else {
            $this->bgColor = 'bg-green-100';
            $this->textColor = 'text-green-800';
            $this->borderColor = 'border-green-700';
            $this->buttonIconFill = 'fill-green-700';
            $this->buttonIconHoverFill = 'fill-green-900';
        }
    }

    public function render()
    {
        return view('components.layout.flash-message');
    }
}