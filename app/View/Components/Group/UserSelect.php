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

    public $options;

    public $errors;

    public function __construct($name, Group $group, User $selectedUser = null)
    {
        $this->name = $name;
        $this->group = $group;
        $this->selectedUser = $selectedUser;

        $this->options = $group->memberships
            ->map(function ($membership) {
                return [
                    'value' => $membership->id,
                    'label' => $membership->user->name,
                ];
            });
    }

    public function render()
    {
        return view('components.group.user-select');
    }
}
