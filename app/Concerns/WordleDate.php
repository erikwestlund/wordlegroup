<?php

namespace App\Concerns;

use Carbon\Carbon;

class WordleDate
{
    public function get($date)
    {
        return Carbon::parse($date)
            ->setHour(6)
            ->setMinute(0)
            ->setSecond(0)
            ->setMicrosecond(0);
    }
}
