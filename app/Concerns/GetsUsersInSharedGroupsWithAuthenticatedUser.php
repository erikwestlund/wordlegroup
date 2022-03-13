<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetsUsersInSharedGroupsWithAuthenticatedUser
{
    public $user;

    public $users;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->setUsers($this->user);
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function setUsers(User $user = null)
    {
        if (!$user) {
            $this->users = collect();

            return;
        }

        $this->users = (new GetsUserGroupsWithMembershipsLoaded($user))
            ->groups
            ->pluck('memberships')
            ->flatten()
            ->pluck('user');
    }
}
