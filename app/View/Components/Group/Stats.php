<?php

namespace App\View\Components\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\Component;

class Stats extends Component
{
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group->load('scores');
    }

    public function render()
    {
        return view('components.group.stats');
    }
}
