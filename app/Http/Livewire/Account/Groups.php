<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Groups extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.account.groups');
    }
}
