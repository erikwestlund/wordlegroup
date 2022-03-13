<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ScoreFeed extends Component
{
    use WithPagination;

    public $user;

    public $showWhenRecordedByOtherUser;

    public function mount(User $user, $showWhenRecordedByOtherUser = false)
    {
        $this->user = $user;
        $this->showWhenRecordedByOtherUser = $showWhenRecordedByOtherUser;
    }

    public function render()
    {
        return view('livewire.account.score-feed', [
            'scores' => $this->user
                ->dailyScores()
                ->latest('date')
                ->paginate(6)
        ]);
    }
}
