<?php

namespace App\Http\Livewire\Account;

use App\Events\GroupMembershipCreated;
use App\Models\GroupMembership;
use App\Models\GroupMembershipInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendingGroupInvitations extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->user->pendingGroupInvitations->load('group.admin');
    }

    public function accept($groupMembershipId)
    {
        $invitation = GroupMembershipInvitation::find($groupMembershipId);

        $groupMembership = GroupMembership::firstOrCreate([
            'user_id'  => $this->user->id,
            'group_id' => $invitation->group_id,
        ]);

        $invitation->delete();

        event(new GroupMembershipCreated($groupMembership));

        session()->flash('message', 'You have successfully joined ' . $invitation->group->name . '.');

        return redirect()->to(route('account.home'));
    }

    public function decline($groupMembershipId)
    {
        $invitation = GroupMembershipInvitation::find($groupMembershipId);

        $invitation->delete();

        session()->flash('message', 'You have declined to join ' . $invitation->group->name . '.');

        return redirect()->to(route('account.home'));
    }

    public function render()
    {
        return view('livewire.account.pending-group-invitations');
    }
}
