<?php

namespace App\Mail;

use App\Models\Group;
use App\Models\GroupMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroupMembershipCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $groupMembership;

    public function __construct(GroupMembership $groupMembership)
    {
        $this->groupMembership = $groupMembership;
    }

    public function build()
    {
        return $this->subject('You Have Joined The Wordle Group "' . $this->groupMembership->group->name . '"')
        ->markdown('emails.group-membership-created', [
            'groupMembership' => $this->groupMembership,
        ]);
    }
}
