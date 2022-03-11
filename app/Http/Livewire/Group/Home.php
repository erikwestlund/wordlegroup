<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $group;

    public $isAdmin;

    public $memberOfGroup;

    public $user;

    public $guest;

    public $pendingInvitations;

    protected $listeners = ['scoreRecorded'];

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->user = Auth::check() ? Auth::user() : null;
        $this->memberOfGroup = $this->user ? $this->group->isMemberOf($this->user) : false;
        $this->isAdmin = $this->memberOfGroup && $group->isAdmin($this->user);

        if (!$group->public && !$this->memberOfGroup) {
            abort(403);
        }

        if ($this->isAdmin) {
            $this->group->load('pendingInvitations');
        }
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
