<?php

namespace App\Concerns;

class UpdatesLeaderboards
{
    public $leaderboards;

    public function __construct()
    {
        $this->leaderboards = config('settings.leaderboards');
    }

    public function update()
    {
        if (in_array('forever', $this->leaderboards)) {
            $this->updateForever();
        }

        if (in_array('annually', $this->leaderboards)) {
            $this->updateAnnually();
        }

        if (in_array('monthly', $this->leaderboards)) {
            $this->updateMonthly();
        }

        if (in_array('weekly', $this->leaderboards)) {
            $this->updateWeekly();
        }
    }

    public function updateForever()
    {

    }

    public function updateAnnually()
    {

    }

    public function updateMonthly()
    {

    }

    public function updateWeekly()
    {

    }
}
