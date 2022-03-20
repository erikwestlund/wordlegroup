<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SharePage extends Component
{
    public $score;

    public $title;

    public function mount(Score $score)
    {
        if(!($score->user->public_profile || $score->public || Auth::check() && $score->user->id === Auth::id())) {
            abort(403);
        }

        $score->load('user');
        $this->score = $score;
        $this->title = $this->getTitle($score);
    }

    public function getTitle(Score $score)
    {
        return "{$score->boardTitle} - by {$score->user->name}";
    }

    public function render()
    {
        return view('livewire.score.share-page');
    }
}
