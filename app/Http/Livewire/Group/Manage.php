<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use Livewire\Component;

class Manage extends Component
{
    public $key;

    public $group;

    public function mount($key)
    {
        $this->group = Group::getFromUrlKey($key);
    }

    public function remove($membershipId)
    {
//        $user = GroupMembership::where('id', $membershipId);
//
//        $user->delete();
//
//        session()->flash('message', $user->name . ' renamed.');

    }

    public function render()
    {
        return view('livewire.group.manage');
    }
}
