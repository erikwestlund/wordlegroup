<?php

namespace App\View\Components\Group;

use App\Concerns\GetsGroupData;
use App\Concerns\GetsLeaderboards;
use App\Models\Group;
use Illuminate\View\Component;

class StatisticsTabs extends Component
{
    use GetsGroupData;

    public $group;

    public $anonymizePrivateUsers;

    public $leaderboards;

    public $memberOfGroup;

    public function __construct(Group $group, $memberOfGroup, $anonymizePrivateUsers = false)
    {
        $this->group = $this->getGroupWithMemberships($group);
        $this->memberOfGroup = $memberOfGroup;
        $this->anonymizePrivateUsers = $anonymizePrivateUsers;
        $this->leaderboards = app(GetsLeaderboards::class)->getActive($group);
    }

    public function render()
    {
        return view('components.group.statistics-tabs');
    }
}
