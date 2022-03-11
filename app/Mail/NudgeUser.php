<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NudgeUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $nudgedByUser;

    public function __construct(User $user, User $nudgedByUser)
    {
        $this->user = $user;
        $this->nudgedByUser = $nudgedByUser;
    }

    public function build()
    {
        $this->subject($this->nudgedByUser->name . ' Has Nudged You To Record Your Wordle Scores')
             ->markdown('emails.nudge-user', [
                 'user'         => $this->user,
                 'nudgedByUser' => $this->nudgedByUser,
             ]);
    }
}
