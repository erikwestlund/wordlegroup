<?php

namespace App\Http\Livewire\Account;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class VerifyEmailNotification extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.account.verify-email-notification');
    }
}
