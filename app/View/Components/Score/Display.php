<?php

namespace App\View\Components\Score;

use App\Models\Score;
use Illuminate\View\Component;

class Display extends Component
{
    public $score;

    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    public function render()
    {
        return view('components.score.display');
    }
}
