<?php

namespace App\View\Components\Score;

use Illuminate\View\Component;

class EmailPrompt extends Component
{
    public function render()
    {
        return view('components.score.email-prompt');
    }
}
