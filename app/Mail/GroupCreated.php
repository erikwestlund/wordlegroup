<?php

namespace App\Mail;

use App\Models\Group;
use App\Models\GroupMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroupCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function build()
    {
        return $this->subject('You Have Created The Wordle Group "' . $this->group->name . '"')
                    ->markdown('emails.group-created', [
                        'group' => $this->group,
                    ]);
    }
}
