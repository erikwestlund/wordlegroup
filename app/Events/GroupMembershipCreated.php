<?php

namespace App\Events;

use App\Models\GroupMembership;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMembershipCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $groupMembership;

    public function __construct(GroupMembership $groupMembership)
    {
        $this->groupMembership = $groupMembership;
    }
}
