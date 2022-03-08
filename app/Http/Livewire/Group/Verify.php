<?php

namespace App\Http\Livewire\Group;

use App\Events\GroupCreated;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Verify extends Component
{
    public $group;

    public $token;

    public function mount(Request $request, $groupId)
    {
        $group = Group::find($groupId);

        if (!$group) {
            return redirect()->to(route('home'));
        }

        if ($group->verified()) {
            return redirect()->to(route('group.home', $groupId));
        }

        $this->group = $group;
        $this->token = $request->input('token');

        $this->verify();
    }

    public function verify()
    {
        if ($this->token === $this->group->token) {
            $this->group->verify();

            if (!$this->group->admin->verified()) {
                $this->group->admin->verifyEmail();

                $this->group->admin->resetAuthToken();
            }

            Auth::loginUsingId($this->group->admin->id, true);

            session()->flash('message', 'Group verified.');

            event(new GroupCreated($this->group));

            return redirect()->to(route('group.home', $this->group));
        }
    }

    public function render()
    {
        return view('livewire.group.verify');
    }
}
