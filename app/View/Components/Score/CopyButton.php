<?php

namespace App\View\Components\Score;

use App\Models\Score;
use Illuminate\View\Component;

class CopyButton extends Component
{
    public $score;

    public $buttonClass;

    public function __construct(
        Score $score,
        $buttonClass = 'px-1.5 py-1 text-xs text-gray-400 rounded border border-gray-200 hover:border-wordle-yellow hover:text-wordle-yellow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700'
    ) {
        $this->score = $score;
        $this->buttonClass = $buttonClass;
    }

    public function render()
    {
        return view('components.score.copy-button');
    }
}
