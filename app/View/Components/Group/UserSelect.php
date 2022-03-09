<?php

namespace App\View\Components\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\Component;

class UserSelect extends Component
{
    public $group;

    public $selectedUser;

    public $name;

    public function __construct($name, Group $group, User $selectedUser = null)
    {
        $this->name = $name;
        $this->group = $group;
        $this->selectedUser = $selectedUser;
    }

    public function render()
    {
        return view('components.group.user-select');
    }
}
