<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ScoreFeed extends Component
{
    use WithPagination;

    public $user;

    public $showWhenRecordedByOtherUser;

    public $ownedByViewingUser;

    public $viewingUser;

    public function mount(User $user, $showWhenRecordedByOtherUser = false)
    {
        $this->user = $user;
        $this->viewingUser = Auth::check() ? Auth::user() : null;
        $this->ownedByViewingUser = Auth::check() && $this->viewingUser->id === $user->id;
        $this->showWhenRecordedByOtherUser = $showWhenRecordedByOtherUser;
    }

    public function render()
    {
        return view('livewire.account.score-feed', [
            'scores' => $this->user
                ->dailyScores()
                ->latest('date')
                ->with('user')
                ->paginate(6)
        ]);
    }
}
