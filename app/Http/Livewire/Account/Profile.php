<?php

namespace App\Http\Livewire\Account;

use App\Concerns\GetsUsersInSharedGroupsWithAuthenticatedUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Profile extends Component
{
    public $user;

    public $viewingUser;

    public $userIdsInSharedGroups;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->viewingUser = Auth::check() ? Auth::user() : null;

        $this->userIdsInSharedGroups = $this->getUsersInSharedGroups();

        if ($user->profileCannotBeSeenBy($this->viewingUser)) {
            abort(403);
        }
    }

     public function getUsersInSharedGroups()
    {
        return app(GetsUsersInSharedGroupsWithAuthenticatedUser::class)->users->pluck('id');
    }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
