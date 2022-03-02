<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class NotVerifiedNotification extends Component
{
    public $group;

    public $expiresMinutes;

    public function mount(Group $group)
    {
        $this->group = $group;

        $this->expiresMinutes = config('settings.unverified_group_expires_minutes') - now()->diffInMinutes($group->created_at);
    }

    public function render()
    {
        return view('livewire.group.not-verified-notification');
    }
}
