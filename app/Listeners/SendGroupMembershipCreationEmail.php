<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendGroupMembershipCreationEmail
{
    public function handle($event)
    {
        Mail::to($event->groupMembership->user->email)
            ->send(new \App\Mail\GroupMembershipCreated($event->groupMembership));
    }
}
