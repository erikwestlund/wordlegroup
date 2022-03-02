<?php

namespace App\Http\Livewire\Account;

use App\Mail\GroupVerification;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendVerificationEmail extends Component
{
    public $email;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function send()
    {
        $this->user->sendEmailVerificationNotification();

        session()->flash('message', 'Verification request email sent.');

        return redirect()->to(route('account.verify-email-notification', $this->user));
    }

    public function render()
    {
        return view('livewire.account.send-verification-email');
    }
}
