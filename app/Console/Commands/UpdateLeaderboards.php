<?php

namespace App\Console\Commands;

use App\Models\Group;
use Illuminate\Console\Command;

class UpdateLeaderboards extends Command
{
    protected $signature = 'groups:update-leaderboards {--H|historical : Update historical leaderboards.}';

    protected $description = 'Update group leaderboards.';

    public $historical;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->historical = $this->option('historical');

        if($this->historical) {
            $this->updateHistorical();

            return 0;
        }

        $this->updateCurrent();

        return 0;
    }

    public function updateCurrent()
    {
        Group::all()
             ->each(function (Group $group) {
                 $group->updateLeaderboards(now());
             });

        $this->info('Group leaderboards updated.');
    }

    public function updateHistorical()
    {

    }
}
