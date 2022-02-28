<?php

namespace App\Rules;

use App\Concerns\ParsesBoard;
use Illuminate\Contracts\Validation\Rule;

class ValidWordleBoard implements Rule
{
    public $message;

    function passes($attribute, $value)
    {
        if (!$value) {
            return true;
        }

        $board = app(ParsesBoard::class)->parse($value);

        if($board['score'] === null) {
            $this->message = 'Your board does not have a valid score';
            return false;
        }

        if($board['boardNumber'] === null) {
            $this->message = 'Your board does not have a valid board number.';
            return false;
        }


        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
