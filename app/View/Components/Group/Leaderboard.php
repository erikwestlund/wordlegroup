<?php

namespace App\View\Components\Group;

use App\Concerns\GetsGroupData;
use App\Models\Group;
use Illuminate\View\Component;

class Leaderboard extends Component
{
    use GetsGroupData;

    public $group;

    public $anonymizePrivateUsers;

    public $leaderboard;

    public function __construct(Group $group, $leaderboard, $anonymizePrivateUsers = false)
    {
        $this->group = $this->getGroupWithMemberships($group);
        $this->anonymizePrivateUsers = $anonymizePrivateUsers;
        $this->leaderboard = $leaderboard;
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
