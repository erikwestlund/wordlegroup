<?php

namespace App\Http\Livewire\Group;

use App\Events\GroupMembershipCreated;
use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\GroupMembershipInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Invitation extends Component
{
    public $allowDigestEmails;

    public $allowReminderEmails;

    public $email;

    public $invitation;

    public $name;

    public $publicProfile;

    public $invitedUserExists;

    protected $rules = [
        'name' => ['required'],
    ];

    public function mount(Request $request, $invitationId)
    {
        $invitation = GroupMembershipInvitation::find($invitationId);

        if (!$invitation) {
            session()->flash('message', 'This invitation is no longer valid.');

            return redirect()->to(route('home'));
        }

        if($invitation->user) {
            $this->invitedUserExists = true;

            // If this user has been invited, but user is not logged in, redirect to login.
            if(! Auth::check()) {
                return redirect(route('login'));
            }

            // If this user is logged in, and it's not their invitation, abort 403
            if(Auth::check() && Auth::user()->email !== $invitation->email) {
                abort(403);
            }

            if(Auth::check()) {
                session()->flash('infoMessage', 'You have pending group invitations.');

                return redirect(route('account.home'));
            }
        }

        $this->invitation = $invitation;
        $this->token = $request->input('token');

        $this->verifyToken();

        if (Auth::check()) {
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
        $user = User::firstOrCreate([
            'email' => $this->email,
        ], [
            'email_verified_at'     => now(),
            'name'                  => $this->name,
            'public_profile'        => $this->publicProfile ?? false,
            'allow_digest_emails'   => $this->allowDigestEmails ?? false,
            'allow_reminder_emails' => $this->allowReminderEmails ?? false,
        ]);

        $groupMembership = GroupMembership::firstOrCreate([
            'user_id'  => $user->id,
            'group_id' => $this->invitation->group_id,
        ]);

        Auth::loginUsingId($user->id, true);

        $this->invitation->delete();

        event(new GroupMembershipCreated($groupMembership));

        session()->flash('message', 'You have successfully joined ' . $this->invitation->group->name . '.');

        return redirect()->to(route('account.home'));
    }

    public function render()
    {
        return view('livewire.group.invitation');
    }
}
