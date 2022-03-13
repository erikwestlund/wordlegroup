<?php

namespace App\Models;

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
        $this->update([
            'member_count'       => $this->memberships()->count(),
            'scores_recorded'    => $this->scores()->count(),
            'score_mean'         => $this->getMeanScore(),
            'score_median'       => $this->getMedianScore(),
            'score_mode'         => $this->getModeScore(),
            'score_distribution' => $this->getScoreDistribution(),
            'leaderboard'        => $this->getLeaderBoard(),
        ]);
    }

    public function memberships()
    {
        return $this->hasMany(GroupMembership::class, 'group_id');
    }

    public function scores()
    {
        return $this->belongsToMany(Score::class, 'group_membership_score');
    }

    public function getMeanScore()
    {
        return $this->scores->isNotEmpty() ? (float)round($this->scores()->average('score'), 2) : null;
    }

    public function getMedianScore()
    {
        return $this->scores->isNotEmpty() ? (float)round($this->scores->median('score'), 1) : null;
    }

    public function getModeScore()
    {
        return $this->scores->isNotEmpty() ? (int)collect($this->scores->mode('score'))->min() : null;
    }

    public function getScoreDistribution()
    {
        return collect([1, 2, 3, 4, 5, 6, 7])
            ->mapWithKeys(function ($number) {
                return [
                    $number === 7 ? 'X' : $number => $this->scores->where('score', $number)->count(),
                ];
            });
    }

    public function getLeaderBoard()
    {
        $userScores = $this->memberships
            ->map(function ($membership) {
                $userScores = $this->scores
                    ->where('user_id', $membership->user_id)
                    ->pluck('score');

                return [
                    'user_id' => $membership->user_id,
                    'name'    => $membership->user->name,
                    'stats'   => [
                        'median' => round($userScores->average(), 1),
                        'mean'   => round($userScores->average(), 2),
                        'mode'   => collect($userScores->mode())->min(),
                        'count'  => $userScores->count(),
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

        return $userScores
            ->map(function ($userScore) use ($placeNumbers) {
                $place = $placeNumbers->firstWhere('score', $userScore['stats']['mean'])['place'];

                $userScore['place'] = $place;

                return $userScore;
            })
            ->sortBy('place')
            ->values();
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
