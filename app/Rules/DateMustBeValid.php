<?php

namespace App\Rules;

use App\Concerns\ParsesBoard;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateMustBeValid implements Rule
{
    public $message;

    public function passes($attribute, $value)
    {
        $date = Carbon::parse($value);

        if(! $date) {
            $this->message = 'Enter a valid date.';
            return false;
        }

        if($date->startOfDay() > now()->addDay()->endOfDay()) {
            $this->message = 'No Wordle exists yet for this date.';
            return false;
        }

        $date = app(ParsesBoard::class)->getBoardNumberFromDate($value);

        if(! $date) {
            $this->message = 'Wordle did not exist yet.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
