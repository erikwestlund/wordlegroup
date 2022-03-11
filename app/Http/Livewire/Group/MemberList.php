<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberList extends Component
{
    public $group;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function nudge($userId)
    {
        $user = User::find($userId);

        $user->nudgeUser(Auth::user());

        session()->flash('message', $user->name . ' has been nudged to record their scores.');

        return redirect()->to(route('group.home', $this->group));
    }

    public function render()
    {
        return view('livewire.group.member-list');
    }
}
