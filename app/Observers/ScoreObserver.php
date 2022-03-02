<?php

namespace App\Observers;

use App\Models\Score;

class ScoreObserver
{
    public function created(Score $score)
    {
        $score->syncToGroups();
    }

    public function saved(Score $score)
    {
        $score->syncToGroups();
    }
}
