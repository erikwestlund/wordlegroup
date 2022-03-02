<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        if(Auth::check()) {
            return redirect()->to(route('account.home'));
        }
    }

    public function render()
    {
        return view('livewire.home');
    }
}
