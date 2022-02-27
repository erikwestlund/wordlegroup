<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class Manage extends Component
{
    public $key;

    public $group;

    public function mount($key)
    {
        $this->group = Group::getFromUrlKey($key);
    }

    public function render()
    {
        return view('livewire.group.manage');
    }
}
