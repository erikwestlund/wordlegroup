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
        'group.email' => 'required|min:2',
        'group.name' => 'required|min:2',
    ];

    public function mount($key)
    {
        $this->group = Group::getFromUrlKey($key);
    }

    public function rename()
    {
        $this->group->save();

        session()->flash('message', 'Group renamed.');

        return redirect()->to(route('group.manage', $this->group->urlKey));
    }

    public function render()
    {
        return view('livewire.group.manage');
    }
}
