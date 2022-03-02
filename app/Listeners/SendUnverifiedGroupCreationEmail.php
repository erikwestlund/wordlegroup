<?php

namespace App\Listeners;

use App\Events\GroupCreated;
use App\Mail\UnverifiedGroupCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUnverifiedGroupCreationEmail
{
    public function handle($event)
    {
        Mail::to($event->group->admin->email)
            ->send(new UnverifiedGroupCreated($event->group));
    }
}
