<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saved(User $user)
    {
        $user->updateStats();
        $user->memberships->each(fn($membership) => $membership->group->updateStats());
    }
}
