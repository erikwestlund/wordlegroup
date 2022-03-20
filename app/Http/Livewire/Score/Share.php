<?php

namespace App\Http\Livewire\Score;

use App\Models\Score;
use Livewire\Component;

class Share extends Component
{
    public $score;

    protected function getListeners()
    {
        return ['shareScore'];
    }

    public function mount(Score $score)
    {
        $this->score = $score;
    }

    public function shareScore($scoreId, $type)
    {
        if(! $this->score->shared_at) {
            $this->score->shared_at = now();
            $this->score->save();
        }

        $this->dispatchBrowserEvent("shared-score-{$this->score->id}-to-{$type}");
    }

    public function render()
    {
        return view('livewire.score.share');
    }
}
