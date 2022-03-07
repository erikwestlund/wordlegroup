<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $user;

    protected $listeners = ['scoreRecorded'];

    public function mount()
    {
        $this->user = Auth::user();

        $this->user->load('memberships.group.admin');
    }

    public function scoreRecorded()
    {
        session()->flash('message', 'Score recorded.');

        return redirect()->to(route('account.home'));
    }

    public function render()
    {
        return view('livewire.account.home');
    }
}
