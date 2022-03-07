<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class LoadingSpinner extends Component
{
    public $icon;

    public $family;

    public $width;

    public $height;

    public $iconClasses;

    public $defaultIconClasses = true;

    public function __construct($icon = 'circle-notch', $family = 'regular', $iconClasses = null)
    {
        $this->icon = $icon;
        $this->family = $family;

        if($iconClasses) {
            $this->defaultIconClasses = false;
            $this->iconClasses = $iconClasses;
        }
    }

    public function render()
    {
        return view('components.layout.loading-spinner');
    }
}
