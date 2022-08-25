<?php

namespace App\Rules;

use App\Concerns\WordleBoard;
use Illuminate\Contracts\Validation\Rule;

class BoardNumberMustBeValid implements Rule
{
    public $date;

    public $lastPossibleBoard;

    public function __construct($date)
    {
        $this->date = $date;
        $this->lastPossibleBoard = app(WordleBoard::class)->getBoardNumberFromDate(now());
    }

    public function passes($attribute, $value)
    {
        return $value > 0 && $value <= $this->lastPossibleBoard;
    }

    public function message()
    {
        return 'The board number must be between 1 and ' . $this->lastPossibleBoard . '.';
    }
}
