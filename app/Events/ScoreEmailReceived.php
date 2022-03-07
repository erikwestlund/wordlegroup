<?php

namespace App\Events;

use App\Models\MailScoreMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoreEmailReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(MailScoreMessage $message)
    {
        $this->message = $message;
    }
}
