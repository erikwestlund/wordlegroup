<?php

namespace App\Http\Livewire\Account;

use App\Mail\LoginEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $attempt;

    protected $rules = [
        'email' => ['required', 'exists:users'],
    ];

    public function mount(Request $request)
    {
        if ($request->input('id') && $request->input('token')) {
            $this->attemptLogIn($request);
        }
    }

    protected function attemptLogIn($request)
    {
        $this->user = User::find($request->input('id'));

        if (!$this->user || !$this->user->validateAuthToken($request->input('token'))) {
            $this->addError('attempt', 'This log in link is no longer valid.');
            return;
        }

        Auth::loginUsingId($this->user->id, true);

        $this->user->resetAuthToken();

        session()->flash('message', 'You have been logged in.');

        return redirect()->to(route('account.home'));
    }

    protected function getMessages()
    {
        return [
            'email.exists' => 'We could not find an account with that email address. <a class="underline hover:text-red-800 font-semibold" href="' . route('register') . '">Register an account.</a>',
        ];
    }

    public function send()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        $user->generateNewAuthToken();

        Mail::to($user)
            ->send(new LoginEmail($user));

        session()->flash('message', 'Log in email sent.');

        return redirect()->to(route('login'));
    }

    public function render()
    {
        return view('livewire.account.login');
    }
}
