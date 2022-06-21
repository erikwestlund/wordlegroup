<?php

namespace App\Concerns;

use App\Models\Group;
use App\Models\Leaderboard;
use Carbon\Carbon;

class GetsLeaderboards
{
    public $date;

    public $leaderboards;

    public function __construct()
    {
        $this->leaderboards = config('settings.leaderboards');
        $this->date = app(WordleDate::class);
    }

    public function getActive(Group $group)
    {
        $when = app(WordleDate::class)->get(now());
        return $this->getLeaderboards($group, $when);
    }

    public function get(Group $group, Carbon $when = null)
    {
        if (!$when) {
            $when = app(WordleDate::class)->get(now());
        }

        $leaderboards = [];

        if (in_array('forever', $this->leaderboards)) {
            $leaderboards['forever'] = $this->getForever($group);
        }

        if (in_array('year', $this->leaderboards)) {
            $leaderboards['year'] = $this->getYear($group, $when->copy());
        }

        if (in_array('month', $this->leaderboards)) {
            $leaderboards['month'] = $this->getMonth($group, $when->copy());
        }

        if (in_array('week', $this->leaderboards)) {
            $leaderboards['week'] = $this->getWeek($group, $when->copy());
        }

        return collect($leaderboards);
    }

    public function getForever(Group $group)
    {
        return Leaderboard::group($group->id)
                          ->for('forever')
                          ->first();
    }

    public function getYear(Group $group, Carbon $when)
    {
        return Leaderboard::group($group->id)
                          ->for('year')
                          ->year($when->year)
                          ->first();
    }

    public function getMonth(Group $group, Carbon $when)
    {
        return Leaderboard::group($group->id)
                          ->for('month')
                          ->year($when->year)
                          ->month($when->month)
                          ->first();
    }

    public function getWeek(Group $group, Carbon $when)
    {
        return Leaderboard::group($group->id)
                          ->for('week')
                          ->year($when->year)
                          ->month($when->month)
                          ->week($when->week)
                          ->first();
    }
}
