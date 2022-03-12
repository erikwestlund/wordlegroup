<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public $viewingUser;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->viewingUser = Auth::check() ? Auth::user() : null;

        if ($user->profileCannotBeSeenBy($this->viewingUser)) {
            abort(403);
        }
    }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
