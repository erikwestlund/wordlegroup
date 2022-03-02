<?php

namespace App\Http\Livewire\Group;

use App\Mail\GroupVerification;
use App\Mail\UnverifiedGroupCreated;
use App\Models\Group;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SendVerificationEmail extends Component
{
    public $email;

    public $group;

    protected $rules = [
        'email' => ['required' ,'email']
    ];

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function send()
    {
        $this->validate();

        Mail::to($this->group->admin->email)
            ->send(new GroupVerification($this->group));

        session()->flash('message', 'Verification request email sent.');

        return redirect()->to(route('group.verify-email-notification', $this->group));
    }

    public function render()
    {
        return view('livewire.group.send-verification-email');
    }
}
