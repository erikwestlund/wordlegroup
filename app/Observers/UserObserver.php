<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function update(User $user)
    {
        $user->updateStats();
        $user->memberships->each(fn($membership) => $membership->group->updateStats());
    }
}
