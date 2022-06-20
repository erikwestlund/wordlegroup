<?php

namespace App\Concerns;

use Carbon\Carbon;

class WordleDate
{
    const START_HOUR = 6;

    const START_TIMEZONE = 'UTC';

    const START_DATE = '2021-06-19';

    const START_TIME = '06:00:00 UTC';

    const START_DATETIME = '2021-06-19 06:00:00 UTC';

    public $activeBoardEndTime;

    public $activeBoardNumber;

    public $activeBoardStartTime;

    public $firstBoardEndTime;

    public $firstBoardStartTime;

    public function __construct()
    {
        $this->firstBoardStartTime = $this->getFirstBoardStartTime();
        $this->firstBoardEndTime = $this->getFirstBoardEndTime();

        $this->activeBoardStartTime = $this->getActiveBoardStartTime();
        $this->activeBoardEndTime = $this->getActiveBoardEndTime();

        $this->activeBoardNumber = $this->getActiveBoardNumber();
    }

    public function getFirstBoardStartTime()
    {
        return Carbon::parse(self::START_DATETIME);
    }

    public function getFirstBoardEndTime()
    {
        return $this->firstBoardStartTime->copy()->addDay()->subMicrosecond();
    }

    public function getActiveBoardStartTime(): Carbon
    {
        $todayWordleDate = $this->get(now());
        $yesterdayWordleDate = $this->get(now()->subDay());

        return now() <= $todayWordleDate
            ? $yesterdayWordleDate
            : $todayWordleDate;
    }

    public function todayIsAfterBoardNumberDay($boardNumber)
    {
        return now() > $this->getDateFromBoardNumber($boardNumber)->endOfDay();
    }

    public function getDateFromBoardNumber($boardNumber)
    {
        return $this->get($this->firstBoardStartTime->copy()->addDays($boardNumber));
    }

    public function getActiveBoardEndTime(): Carbon
    {
        return $this->activeBoardStartTime->copy()->addDay()->subMicrosecond();
    }

    protected function getActiveBoardNumber(): int
    {
        return $this->firstBoardStartTime->copy()->diffInDays($this->activeBoardStartTime);
    }

    public function get($date)
    {
        return Carbon::parse($date)
                     ->setHour(self::START_HOUR)
                     ->setMinute(0)
                     ->setSecond(0)
                     ->setMicrosecond(0);
    }

}
