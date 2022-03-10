<?php

namespace App\View\Components\Group;

use Illuminate\View\Component;

class AdminBadge extends Component
{
    public $textSize;

    public function __construct($textSize = 'text-sm')
    {
        $this->textSize = $textSize;
    }

    public function render()
    {
        return view('components.group.admin-badge');
    }
}
