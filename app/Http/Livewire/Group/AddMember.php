<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class AddMember extends Component
{
    public Group $group;

    public $newMember;

    protected $rules = [
        'newMember.name' => 'required|min:2',
        'newMember.email' => 'required|email',
    ];

    public function mount($group)
    {
        $this->group = $group;
    }

    public function save()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.group.add-member');
    }
}
