<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class Page extends Component
{
    public $group;

    public function mount($key)
    {
        $this->group = Group::getFromUrlKey($key);
    }


    public function render()
    {
        return view('livewire.group.page');
    }
}
