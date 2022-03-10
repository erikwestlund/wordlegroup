<?php

namespace App\View\Components\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\Component;

class UserSelect extends Component
{
    public $group;

    public $selectedUserId;

    public $name;

    public $options;

    public $errors;

    public function __construct($name, Group $group, $selectedUserId = null)
    {
        $this->name = $name;
        $this->group = $group;
        $this->selectedUserId = $selectedUserId;

        $this->options = $group->memberships
            ->map(function ($membership) {
                return [
                    'value' => $membership->user->id,
                    'label' => $membership->user->name,
                ];
            });
    }

    public function render()
    {
        return view('components.group.user-select');
    }
}
