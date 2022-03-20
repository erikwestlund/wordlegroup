<?php

namespace App\View\Components\Score;

use App\Concerns\SharesScores;
use App\Models\Score;
use Illuminate\View\Component;

class ShareLinkButton extends Component
{
    use SharesScores;

    public function render()
    {
        return view('components.score.share-link-button');
    }
}
