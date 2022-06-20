<?php

namespace App\Models;

use App\Concerns\UpdatesLeaderboards;
use App\Concerns\WordleBoard;
use App\Concerns\WordleDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory, Prunable, SoftDeletes;

    protected $casts = [
        'leaderboard' => 'collection',
    ];

    protected $dates = ['verified_at'];

    protected $guarded = [];

    protected $hidden = [
        'token',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function getAdminUrlAttribute()
    {
        return route('group.home', $this);
    }

    public function getVerifyUrlAttribute()
    {
        return route('group.verify', $this) . '?token=' . $this->token;
    }

    public function isAdmin(User $user)
    {
        if (!$user) {
            return false;
        }

        return $this->admin_user_id === $user->id;
    }

    public function isMemberOf(User $user = null)
    {
        if (!$user) {
            return false;

        }

        return $user->memberships->pluck('group_id')->contains($this->id);
    }

    public function pendingInvitations()
    {
        return $this->hasMany(GroupMembershipInvitation::class, 'group_id');
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subMinutes(config('settings.unverified_group_expires_minutes')))
                     ->whereNull('verified_at');
    }

    public function updateStats()
    {
        $stats = $this->getSummaryStats();

        $this->update([
            'member_count'       => $stats['member_count'],
            'scores_recorded'    => $stats['scores_recorded'],
            'score_mean'         => $stats['score_mean'],
            'score_median'       => $stats['score_median'],
            'score_mode'         => $stats['score_mode'],
            'score_distribution' => $stats['score_distribution'],
            'leaderboard'        => $this->getLeaderBoard() // forever board
        ]);

        $this->updateLeaderboards();
    }

    public function getSummaryStats($startDate = null, $endDate = null)
    {
        [$startBoard, $endBoard] = app(WordleBoard::class)->getStartAndEndBoardsFromDates($startDate, $endDate);

        $scores = $this->scores
            ->where('board_number', '>=', $startBoard)
            ->where('board_number', '<=', $endBoard);

        return [
            'member_count'       => $this->memberships()->count(),
            'scores_recorded'    => $scores->count(),
            'score_mean'         => $this->getMeanScore($scores),
            'score_median'       => $this->getMedianScore($scores),
            'score_mode'         => $this->getModeScore($scores),
            'score_distribution' => $this->getScoreDistribution($scores),
        ];
    }

    public function updateLeaderboards()
    {
        app(UpdatesLeaderboards::class)->update($this);
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class, 'group_id');
    }

    public function scores()
    {
        return $this->belongsToMany(Score::class, 'group_membership_score');
    }

    public function getMeanScore($scores = null)
    {
        $scores = $scores ?? $this->scores;

        return $scores->isNotEmpty() ? (float)round($scores->average('score'), 2) : null;
    }

    public function getMedianScore($scores = null)
    {
        $scores = $scores ?? $this->scores;

        return $scores->isNotEmpty() ? (float)round($scores->median('score'), 1) : null;
    }

    public function getModeScore($scores = null)
    {
        $scores = $scores ?? $this->scores;

        return $scores->isNotEmpty() ? (int)collect($scores->mode('score'))->min() : null;
    }

    public function getScoreDistribution($scores = null)
    {
        $scores = $scores ?? $this->scores;

        return collect([1, 2, 3, 4, 5, 6, 7])
            ->mapWithKeys(function ($number) use ($scores) {
                return [
                    ($number === 7 ? 'X' : $number) => $scores->where('score', $number)->count(),
                ];
            });
    }

    /*
     * Gets leaderboard for all scores between start date and end date.
     */
    public function getLeaderBoard($startDate = null, $endDate = null)
    {
        [$startBoard, $endBoard] = app(WordleBoard::class)->getStartAndEndBoardsFromDates($startDate, $endDate);

        $userScores = $this->memberships
            ->map(function ($membership) use ($startBoard, $endBoard) {
                $userScores = $this->scores
                    ->where('user_id', $membership->user_id)
                    ->where('board_number', '>=', $startBoard)
                    ->where('board_number', '<=', $endBoard)
                    ->pluck('score');

                return [
                    'user_id' => $membership->user_id,
                    'name'    => $membership->user->name,
                    'stats'   => [
                        'median' => $userScores->isNotEmpty() ? round($userScores->average(), 1) : null,
                        'mean'   => $userScores->isNotEmpty() ? round($userScores->average(), 2) : null,
                        'mode'   => $userScores->isNotEmpty() ? collect($userScores->mode())->min() : null,
                        'count'  => $userScores->isNotEmpty() ? $userScores->count() : null,
                    ],
                ];
            })
            ->reject(fn($userScore) => $userScore['stats']['count'] === 0);


        $placeNumbers = $userScores->pluck('stats.mean')
                                   ->unique()
                                   ->sort()
                                   ->values()
                                   ->map(function ($score, $index) {
                                       return [
                                           'place' => $index + 1,
                                           'score' => $score,
                                       ];
                                   });

        $leaderboard = $userScores
            ->map(function ($userScore) use ($placeNumbers) {
                $place = $placeNumbers->firstWhere('score', $userScore['stats']['mean'])['place'];

                $userScore['place'] = $place;

                return $userScore;
            })
            ->sortBy('place')
            ->values();

        return $leaderboard;
    }

    public function verified()
    {
        return (bool)$this->verified_at;
    }

    public function verify()
    {
        $this->update(['verified_at' => now(), 'token' => null]);
    }
}
