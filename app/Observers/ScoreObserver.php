<?php

namespace App\Observers;

use App\Models\Score;

class ScoreObserver
{
    public function created(Score $score)
    {
        $score->syncToGroupMemberships();
    }

    public function saved(Score $score)
    {
        $score->syncToGroupMemberships();
    }
}
