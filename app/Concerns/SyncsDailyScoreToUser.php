<?php

namespace App\Concerns;

use App\Models\Score;

class SyncsDailyScoreToUser
{
    /**
     * Every use should have one score per board.
     * The preferred score should be one created by the user.
     *
     * @param \App\Models\Score $score
     *
     * @return void
     */
    public function sync(Score $score)
    {
        // This grabs the recording user first.
        $dailyScore = Score::with(['user'])
                           ->for($score->user)
                           ->boardNumber($score->board_number)
                           ->recordingUserScoreFirst($score->user->id)
                           ->first();

        $score->user->dailyscoresForBoard($dailyScore->board_number)
                    ->syncWithPivotValues(
                        $dailyScore->id,
                        [
                            'board_number' => $dailyScore->board_number,
                        ]
                    );
    }
}
