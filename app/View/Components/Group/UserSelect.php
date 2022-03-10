<?php

namespace App\View\Components\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\View\Component;

class UserSelect extends Component
{
    public $errors;

    public $group;

    public $label;

    public $name;

    public $options;

    public $selectedUserId;

    public function __construct($name, Group $group, $label = 'Group Member', $selectedUserId = null)
    {
        $this->name = $name . uniqid();
        $this->label = $label;
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
