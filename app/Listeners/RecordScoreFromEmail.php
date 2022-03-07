<?php

namespace App\Listeners;

use App\Concerns\RecordsMailScore;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordScoreFromEmail
{
    public function handle($event)
    {
        app(RecordsMailScore::class)->record($event->message);
    }
}
