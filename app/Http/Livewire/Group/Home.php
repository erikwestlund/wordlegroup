<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $group;

    public $memberOfGroup;

    public $user;

    public $guest;

    public $pendingInvitations;

    protected $listeners = ['scoreRecorded'];

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->user = Auth::check() ? Auth::user() : null;
        $this->memberOfGroup = $this->user ? $this->getIsMemberOfGroup() : false;

        if (!$group->public && !$this->memberOfGroup) {
            abort(403);
        }

        if ($group->isAdmin($this->user)) {
            $this->group->load('pendingInvitations');
        }
    }

    public function getIsMemberOfGroup()
    {
        return $this->user->memberships->pluck('group_id')->contains($this->group->id);
    }

    public function scoreRecorded()
    {
        session()->flash('message', 'Score recorded.');

        return redirect()->to(route('group.home', $this->group));
    }

    public function render()
    {
        return view('livewire.group.home');
    }
}
