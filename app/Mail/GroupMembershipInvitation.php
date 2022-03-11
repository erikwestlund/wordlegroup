<?php

namespace App\Mail;

use App\Models\GroupMembershipInvitation as GroupMembershipInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroupMembershipInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(GroupMembershipInvitationModel $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->subject($this->invitation->invitingUser->name . ' Has Invited You To Join Their Wordle Group ' . $this->invitation->group->name)
                    ->markdown('emails.group-membership-invitation', [
                        'invitation' => $this->invitation,
                    ]);
    }
}
