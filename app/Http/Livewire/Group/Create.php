<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $email;

    public $groupName;

    public $userName;

    protected $rules = [
        'groupName' => 'required|min:2',
        'email'     => 'required|email',
        'userName'  => 'required|min:2',
    ];


    public function store()
    {
        $this->validate();

        $user = User::firstOrCreateFromEmail([
            'email' => $this->email,
        ]);

        $group = Group::create([
            'owner_id' => $user->id,
            'name'     => $this->groupName,
            'key'      => uniqid(),
        ]);

        $groupMembership = GroupMembership::create([
            'group_id' => $group->id,
            'user_id'  => $user->id,
            'name'     => $this->userName,
            'key'      => uniqid(),
        ]);

        return redirect()->to(route('group.manage', $group->urlKey));
    }

    public function render()
    {
        return view('livewire.group.create');
    }
}
