<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verify extends Component
{
    public $user;

    public $token;

    public function mount(Request $request, User $user)
    {
        $this->user = $user;
        $this->token = $request->input('token');

        $this->verify();
    }

    public function verify()
    {
        if ($this->user->validateAuthToken($this->token)) {
            $this->user->verifyEmail();

            Auth::loginUsingId($this->user->id, true);

            $this->user->resetAuthToken();

            session()->flash('message', 'User email verified.');

            return redirect()->to(route('account.home', $this->user));
        }
    }

    public function render()
    {
        return view('livewire.account.verify');
    }
}
