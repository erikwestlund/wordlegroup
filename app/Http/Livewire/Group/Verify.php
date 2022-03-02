<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Illuminate\Http\Request;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Verify extends Component
{
    public $group;

    public $token;

    public function mount(Request $request, Group $group)
    {
        $this->group = $group;
        $this->token = $request->input('token');

        $this->verify();
    }

    public function verify()
    {
        if($this->token === $this->group->token) {
            $this->group->verify();

            if(! $this->group->admin->verified()) {
                $this->group->admin->verifyEmail();
            }

            session()->flash('message', 'Group verified.');

            return redirect()->to(route('group.home', $this->group));
        }
    }


    public function render()
    {
        return view('livewire.group.verify');
    }
}
