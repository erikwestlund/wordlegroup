<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use Livewire\Component;

class SharePage extends Component
{
    public $score;

    public $title;

    public function mount(Score $score)
    {
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
