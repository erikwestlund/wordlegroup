<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $group;

    public function mount(Group $group)
    {
        $this->group = $this->group;
    }


    public function render()
    {
        return view('livewire.group.page');
    }
}
