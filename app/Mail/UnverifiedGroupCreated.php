<?php

namespace App\Mail;

use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnverifiedGroupCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function build()
    {
        return $this->subject('Verify Your Email For Wordle Group "' . $this->group->name . '"')
                    ->markdown('emails.unverified-group-created', [
                        'group' => $this->group,
                    ]);
    }
}
