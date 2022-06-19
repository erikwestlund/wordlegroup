<?php

namespace App\Concerns;

class UpdatesLeaderboards
{
    public $leaderboards;

    public $updaters = [
        'forever'  => [
            'method'     => 'updateForever',
            'whenFormat' => null,
        ],
        'annually' => [
            'method'     => 'updateAnnually',
            'whenFormat' => 'Y',
        ],
        'monthly'  => [
            'method'     => 'updateMonthly',
            'whenFormat' => '',
        ],
        'weekly'   => [
            'method'     => 'updateWeekly',
            'whenFormat' => '',
        ],
    ];

    public function __construct()
    {
        $this->leaderboards = config('settings.leaderboards');
    }
}
