<?php

namespace App\Models;

use App\Concerns\WordleDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'leaderboard'        => 'collection',
        'score_distribution' => 'collection',
    ];

    public function scopeGroup($query, $groupId)
    {
        return $query->where('group_id', $groupId);
    }

    public function scopeFor($query, $for)
    {
        return $query->where('for', $for);
    }

    public function scopeYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeMonth($query, $month)
    {
        return $query->where('month', $month);
    }

    public function scopeWeek($query, $week)
    {
        return $query->where('week', $week);
    }

    public function scopeForDate($query, $date)
    {
        $leaderboards = config('settings.leaderboards');

        return $query->where(function ($subQuery) use ($date, $leaderboards) {

            if (in_array('forever', $leaderboards)) {
                $subQuery->orWhere(function ($q) {
                    $q->where('for', 'forever');
                });
            }

            if (in_array('year', $leaderboards)) {
                $subQuery->orWhere(function ($q) use ($date) {
                    $q->where('for', 'year')
                      ->where('year', $date->year);
                });
            }

            if (in_array('month', $leaderboards)) {
                $subQuery->orWhere(function ($q) use ($date) {
                    $q->where('for', 'month')
                      ->where('year', $date->year)
                      ->where('month', $date->month);
                });
            }

            if (in_array('week', $leaderboards)) {
                $subQuery->orWhere(function ($q) use ($date) {
                    $q->where('for', 'week')
                      ->where('year', $date->year)
                      ->where('month', $date->month)
                      ->where('week', $date->week);
                });
            }
        });
    }

    public function scopeActive($query)
    {
        $now = app(WordleDate::class)->get(now());

        return $this->scopeForDate($query, $now);
    }
}
