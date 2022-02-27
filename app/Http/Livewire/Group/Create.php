<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $groupName;
    public $email;

    protected $rules = [
        'groupName' => 'required|min:2',
        'email' => 'required|email',
    ];


    public function store()
    {
        $this->validate();

        $emailOwner = User::firstOrCreateFromEmail([
            'email' => $this->email,
        ]);

        $group = Group::create([
            'owner_id' => $emailOwner->id,
            'name' => $this->groupName,
            'key' => uniqid()
        ]);

        return redirect()->to(route('group.manage', $group->urlKey));
    }

    public function render()
    {
        return view('livewire.group.create');
    }
}
