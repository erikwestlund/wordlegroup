<?php

namespace App\View\Components\Account;

use App\Concerns\GetsLeaderboards;
use App\Concerns\GetsUserGroupsWithRelationshipsLoaded;
use App\Concerns\GetsUsersInSharedGroupsWithAuthenticatedUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use function Symfony\Component\Translation\t;

class GroupsList extends Component
{
    public $user;

    public $anonymizePrivateGroups;

    public $groups;

    public $viewingUser;

    public $userIsAuthenticatedUser;

    public $leaderboards;

    public function __construct(User $user, $anonymizePrivateGroups = false)
    {
        $this->user = $user;
        $this->viewingUser = Auth::check() ? Auth::user() : null;
        $this->userIsAuthenticatedUser = Auth::check() && $this->user->id === $this->viewingUser->id;
        $this->anonymizePrivateGroups = $anonymizePrivateGroups;
        $this->groups = $this->getGroups($user, $this->viewingUser, $anonymizePrivateGroups);
    }

    public function getAllUserGroups(User $user)
    {
        return (new GetsUserGroupsWithRelationshipsLoaded($user))
            ->groups;
    }

    public function getGroups(User $user, User $viewingUser = null, $anonymizePrivateGroups = false)
    {
        return $this->getRawGroups($user, $viewingUser, $anonymizePrivateGroups)
                    ->map(function ($group) use ($viewingUser) {

                        $group->leaderboards = app(GetsLeaderboards::class)->mapsUsersToLeaderboards($group, $group->activeLeaderboards, $viewingUser);

//
//                        // Bind the leader user to each member of the leaderboard.
//                        $group->leaderboard = $group->leaderboard
//                            ->map(function ($position) use ($group, $viewingUser) {
//                                $position['user'] = $group->memberships->firstWhere('user_id',
//                                    $position['user_id'])->user;
//
//                                $position['can_be_seen_by_viewing_user'] = $position['user']->profileCanBeSeenBy($viewingUser);
//                                $position['user']['public_name'] = $position['can_be_seen_by_viewing_user'] ? $position['user']->name : 'Anonymous User';
//
//                                return $position;
//                            });
//
//                        // Get the all time leader.
//
//                        $group->leader = $group->leaderboard->isNotEmpty()
//                            ? $group->leaderboard->first()['user']
//                            : null;

                        return $group;
                    });
    }

    public function getRawGroups(User $user, User $viewingUser = null, $anonymizePrivateGroups = false)
    {
        // Not anonymized? Just show all the groups.
        if (!$anonymizePrivateGroups) {
            return $this->getAllUserGroups($user);
        }

        // Viewing user is logged in and viewing one's own profile? Show all groups.
        if ($this->viewingUser && $this->viewingUser->id === $this->user->id) {
            return $this->getAllUserGroups($user);
        }

        // Show only groups where the group is public or where the viewing user is in the group.
        $viewingUsersGroupIds = $viewingUser ? $this->getAllUserGroups($viewingUser)->pluck('id') : collect();

        return $this->getAllUserGroups($user)
                    ->filter(function ($group) use ($viewingUsersGroupIds) {
                        // group is public? return
                        if ($group->public) {
                            return true;
                        }

                        return $viewingUsersGroupIds->contains($group->id);
                    });
    }

    public function render()
    {
        return view('components.account.groups-list');
    }
}
