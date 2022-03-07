<?php

namespace App\View\Components\Group;

use App\Models\Group;
use Illuminate\View\Component;

class Leaderboard extends Component
{
    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        return view('components.group.leaderboard');
    }
}
