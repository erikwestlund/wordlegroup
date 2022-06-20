<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;

class UpdateGroupStatistics extends Command
{
    protected $signature = 'groups:update-stats';

    protected $description = 'Update group statistics.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Group::all()
             ->each(function ($group) {
                 $group->updateStats();
             });

        return 0;
    }
}
