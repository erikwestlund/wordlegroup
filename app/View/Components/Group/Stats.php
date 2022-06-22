<?php

namespace App\View\Components\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\Component;

class Stats extends Component
{
    public $group;

    public $leaderboard;

    public function __construct(Group $group, $leaderboard)
    {
        $this->group = $group;
        $this->leaderboard = $leaderboard;
    }

    public function render()
    {
        return view('components.group.stats');
    }
}
