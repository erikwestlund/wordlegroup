<?php

namespace App\Concerns;

use App\Models\Score;

class SyncsScoresToGroupMemberships
{
    /**
     * If this is a user-provided score, sync it to all groups.
     *
     * Scores should be synced to a group when the
     *  score's user was a member of the group on the board's day.
     *
     * When more than one score exists for a user on that day (e.g.,
     *  if a score was recorded by an admin for a user and by that user
     *  him or herself), prefer the latest one by the score's owner.
     *
     * @param \App\Models\Score $score
     *
     * @return void
     */
    public function sync(Score $score)
    {
        $scoresOwnedByUserFromDay = Score::for($score->user)
                                         ->boardNumber($score->board_number)->get();

        $score->user
            ->memberships
            ->each(function ($membership) use($scoresOwnedByUserFromDay) {
                $correctScore = $this->getCorrectDailyScoreForMembershipFromPossibleScores($membership, $scoresOwnedByUserFromDay);
                dd(
                    $correctScore
                );
            });

    }

    public function getCorrectDailyScoreForMembershipFromPossibleScores($membership, $scores)
    {
        return $scores->filter(function($score) use($membership) {
            dd($score->endOfWordleDay, $membership->created_at, $score->validForMembership($membership));
            return $score->validForMembership($membership);
        });
    }
}
