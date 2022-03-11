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

    public $buttonIconBg;

    public $type;

    public function __construct($type = 'success')
    {
        $this->type = $type;
        $this->setColors($type);
    }

    protected function setColors($type)
    {
        if ($type === 'error') {
            $this->bgColor = 'bg-red-100';
            $this->textColor = 'text-red-800';
            $this->borderColor = 'border-red-700';
            $this->buttonIconFill = 'fill-red-700';
            $this->buttonIconHoverFill = 'fill-red-900';
            $this->buttonIconBg = 'hover:bg-red-200';
        } if ($type === 'info') {
            $this->bgColor = 'bg-blue-100';
            $this->textColor = 'text-blue-800';
            $this->borderColor = 'border-blue-700';
            $this->buttonIconFill = 'fill-blue-700';
            $this->buttonIconHoverFill = 'fill-blue-900';
            $this->buttonIconBg = 'hover:bg-blue-200';
        } else {
            $this->bgColor = 'bg-green-100';
            $this->textColor = 'text-green-800';
            $this->borderColor = 'border-green-700';
            $this->buttonIconFill = 'fill-green-700';
            $this->buttonIconHoverFill = 'fill-green-900';
            $this->buttonIconBg = 'hover:bg-green-200';
        }
    }

    public function render()
    {
        return view('components.layout.flash-message');
    }
}
