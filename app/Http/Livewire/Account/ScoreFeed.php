<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ScoreFeed extends Component
{
    use WithPagination;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.account.score-feed', [
            'scores' => $this->user
                ->scores()
                ->latest()
                ->paginate(3)
        ]);
    }
}
