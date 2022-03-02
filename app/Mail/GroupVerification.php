<?php

namespace App\Mail;

use App\Models\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroupVerification extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function build()
    {
        return $this->subject('Verify Your Wordle Group "' . $this->group->name . '"')
                    ->markdown('emails.verify-group', [
                        'group' => $this->group,
                    ]);
    }
}
