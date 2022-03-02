<?php

namespace App\Listeners;

use App\Mail\UnverifiedGroupCreated;
use App\Mail\UserVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserVerificationEmail
{
    public function handle($event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}
