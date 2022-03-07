<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class Rename extends Component
{
    public Group $group;

    protected $rules = [
        'group.name' => 'required|min:2',
    ];

    public function mount($group)
    {
        $this->group = $group;
    }

    public function update()
    {

        $this->validate();

        $this->group->save();

        session()->flash('message', 'Group renamed.');

        return redirect()->to(route('group.home', $this->group->urlKey));
    }


    public function render()
    {
        return view('livewire.group.rename');
    }
}
