<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use App\Rules\OnlyOneUserPerGroup;
use Livewire\Component;

class AddMember extends Component
{
    public Group $group;

    public $name;

    public $email;


    protected function getRules()
    {
        return [
            'name'  => 'required|min:2',
            'email' => ['required', 'email', new OnlyOneUserPerGroup($this->group)],
        ];
    }

    public function mount($group)
    {
        $this->group = $group;
    }

    public function save()
    {
        $this->validate();

        $user = User::firstOrCreateFromEmail([
            'email' => $this->email,
        ]);

        $group = GroupMembership::create([
            'group_id' => $this->group->id,
            'user_id'  => $user->id,
            'name'     => $this->name,
            'key'      => uniqid(),
        ]);

        session()->flash('message', 'Member added.');


        return redirect()->to(route('group.manage', $this->group->urlKey));
    }

    public function render()
    {
        return view('livewire.group.add-member');
    }
}
