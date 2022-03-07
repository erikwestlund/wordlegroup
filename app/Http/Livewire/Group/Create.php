<?php

namespace App\Http\Livewire\Group;

use App\Concerns\Tokens;
use App\Events\GroupCreated;
use App\Events\GroupMembershipCreated;
use App\Events\UnverifiedGroupCreated;
use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.group.create');
    }
}
