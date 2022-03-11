<?php

namespace App\View\Components\Group;

use App\Models\Group;
use Illuminate\View\Component;

class Leaderboard extends Component
{
    public $group;

    public $anonymizePrivateUsers;

    public $leaderboard;

    public function __construct(Group $group, $anonymizePrivateUsers = false)
    {
        $this->group = $group;
        $this->group->load('memberships.user');
        $this->anonymizePrivateUsers = $anonymizePrivateUsers;
        $this->leaderboard = $this->getLeaderboard($this->group);
    }

    public function getLeaderboard(Group $group)
    {
        return $group->leaderboard
            ->map(function($position) use($group) {
                $position['user'] = $group->memberships->firstWhere('user_id', $position['user_id'])->user;

               return $position;
            });
    }

    public function render()
    {
        return view('components.group.leaderboard');
    }
}
