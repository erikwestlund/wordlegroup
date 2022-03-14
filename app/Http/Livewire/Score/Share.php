<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use Livewire\Component;

class Share extends Component
{
    public $score;

    public function mount(Score $score)
    {
        $this->score = $score;
    }

    public function makePublic($scoreId)
    {
        dd($scoreId);
    }

    public function render()
    {
        return view('livewire.score.share');
    }
}
