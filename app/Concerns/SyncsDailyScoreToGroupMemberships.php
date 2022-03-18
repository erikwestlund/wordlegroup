<?php

namespace App\Concerns;

use App\Models\Score;

class SyncsDailyScoreToGroupMemberships
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
        $scoresOwnedByUserFromDay = Score::with(['user.memberships.group.admin'])
                                         ->for($score->user)
                                         ->boardNumber($score->board_number)
                                         ->recordingUserScoreFirst($score->user->id)
                                         ->get();

        $score->user
            ->memberships
            ->each(function ($membership) use ($scoresOwnedByUserFromDay) {
                $correctScore = $this->getCorrectDailyScoreForMembershipFromPossibleScores(
                    $membership,
                    $scoresOwnedByUserFromDay
                );

                if ($correctScore) {
                    $membership->scoresForBoard($correctScore->board_number)
                               ->syncWithPivotValues(
                                   $correctScore->id,
                                   [
                                       'user_id'      => $correctScore->user_id,
                                       'group_id'     => $membership->group_id,
                                       'board_number' => $correctScore->board_number,
                                   ]
                               );
                }
            });

    }

    public function getCorrectDailyScoreForMembershipFromPossibleScores($membership, $scores)
    {
        // First, filter out any scores that are from boards after the Wordle Group was created
        //  or that were created by someone who is not the score owner or the group administrator.
        //  And take that record. (recording users always come first)
        return $scores
            ->filter(function ($score) use ($membership) {
                return $score->validForMembership($membership);
            })->first();
    }
}
