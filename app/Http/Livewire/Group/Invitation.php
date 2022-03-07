<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\GroupMembershipInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Invitation extends Component
{
    public $invitation;

    public $name;

    public $email;

    protected $rules = [
        'name' => ['required']
    ];

    public function mount(Request $request, GroupMembershipInvitation $invitation)
    {
        $this->invitation = $invitation;
        $this->token = $request->input('token');

        $this->verifyToken();

        if(Auth::check()) {
            Auth::logout();
        }

        $this->name = $invitation->name;
        $this->email = $invitation->email;
    }


    public function verifyToken()
    {
        if ($this->token !== $this->invitation->token) {
            session()->flash('errorMessage', 'Invitation is not valid.');

            return redirect()->to(route('home'));
        }
    }

    public function accept()
    {
        $user = User::create([
            'email'             => $this->email,
            'name'              => $this->name,
            'email_verified_at' => now(),
        ]);

        $groupMembership = GroupMembership::create([
            'user_id'  => $user->id,
            'group_id' => $this->invitation->group_id,
        ]);

        Auth::loginUsingId($user->id);

        $this->invitation->delete();

        session()->flash('message', 'You have successfully joined ' . $this->invitation->group->name . '.');

        return redirect()->to(route('account.home'));
    }

    public function render()
    {
        return view('livewire.group.invitation');
    }
}
