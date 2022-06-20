<?php

namespace App\Observers;

use App\Models\Score;

class ScoreObserver
{
    public function updated(Score $score)
    {
        $this->runEvents($score);
    }

    public function saved(Score $score)
    {
        $this->runEvents($score);
    }

    public function runEvents(Score $score)
    {
        $score->syncToDailyScores();
        $score->syncToGroupMemberships();
        $score->updateLeaderboards();
        $score->user->updateStats();
        $score->user->memberships->each(fn($membership) => $membership->group->updateStats());
    }
}
