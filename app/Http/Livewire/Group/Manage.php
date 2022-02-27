<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class Manage extends Component
{
    public $key;

    public $group;

    public $newMember;

    protected $rules = [
        'group.name' => 'required|min:2',
//        'newMember.name' => 'required|min:2',
//        'newMember.email' => 'required|email',
    ];

    public function mount($key)
    {
        $this->group = Group::getFromUrlKey($key);
    }

    public function addMember()
    {
        $this->validate();
    }


    public function render()
    {
        return view('livewire.group.manage');
    }
}
