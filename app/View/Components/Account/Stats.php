<?php

namespace App\View\Components\Account;

use App\Models\User;
use Illuminate\View\Component;

class Stats extends Component
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user->load('dailyScores');
    }

    public function render()
    {
        return view('components.account.stats');
    }
}
