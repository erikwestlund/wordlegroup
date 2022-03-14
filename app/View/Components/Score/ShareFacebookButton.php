<?php

namespace App\View\Components\Score;

use App\Models\Score;
use Illuminate\View\Component;

class ShareFacebookButton extends Component
{
    public $score;

    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    public function render()
    {
        return view('components.score.share-facebook-button');
    }
}
