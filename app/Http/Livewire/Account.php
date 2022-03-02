<?php

namespace App\Http\Livewire;

use App\Concerns\WordleBoard;
use App\Models\User;
use Livewire\Component;

class Account extends Component
{
    public $user;

    public function mount($key)
    {
        $this->user = User::getFromUrlKey($key);
    }

    public function render()
    {
        return view('livewire.account');
    }
}
