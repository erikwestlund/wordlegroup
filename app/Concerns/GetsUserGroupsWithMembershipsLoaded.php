<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetsUserGroupsWithMembershipsLoaded
{
    public $user;

    public $groups;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->setGroups($user);
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups(User $user = null)
    {
        if(! $user) {
            $this->groups = collect();
            return;
        }

        $this->user->load('memberships.group.memberships.user');
        $this->groups = $this->user->memberships->pluck('group');
    }
}
