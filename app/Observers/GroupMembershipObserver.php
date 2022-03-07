<?php

namespace App\Observers;

use App\Models\GroupMembership;

class GroupMembershipObserver
{
    public function created(GroupMembership $membership)
    {
        $this->runEvents($membership);
    }

    public function updated(GroupMembership $membership)
    {
        $this->runEvents($membership);
    }

    public function saved(GroupMembership $membership)
    {
        $this->runEvents($membership);
    }

    public function runEvents(GroupMembership $membership)
    {
        $membership->user->updateStats();
        $membership->user->memberships->each(fn($membership) => $membership->group->updateStats());
    }
}
