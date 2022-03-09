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

    protected $listeners = ['scoreRecorded'];

    public function mount(Group $group)
    {
        $this->group = $this->group;
        $this->user = Auth::check() ? Auth::user() : null;
        $this->memberOfGroup = $this->getIsMemberOfGroup();

        if (!$this->memberOfGroup) {
            session('errorMessage', 'You are not a member of this group.');

            return redirect()->to(route('account.home'));
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
