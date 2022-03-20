<?php

namespace App\Concerns;

use App\Models\Score;

trait SharesScores
{
    public $buttonClass;

    public $confirm;

    public $confirmMessage;

    public $score;

    public $useIcon;

    public $iconSize;

    public function __construct(
        Score $score,
        $buttonClass = null,
        $confirm = false,
        $confirmMessage = "Your profile is set to private. Are you sure you want to make this score visible to the public? This score will be made public but your profile will remain private.",
        $useIcon = true,
        $iconSize = 4
    ) {
        $this->score = $score;
        $this->buttonClass = $buttonClass;
        $this->confirm = $confirm;
        $this->confirmMessage = $confirmMessage;
        $this->useIcon = $useIcon;
        $this->iconSize = $iconSize;
    }

}
