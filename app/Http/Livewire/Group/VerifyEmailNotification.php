<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class VerifyEmailNotification extends Component
{
    public $group;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        return view('livewire.group.verify-email-notification');
    }
}
