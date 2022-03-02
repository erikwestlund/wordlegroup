<?php

namespace App\Rules;

use App\Concerns\WordleBoard;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateMustBeValid implements Rule
{
    public $message;

    public function passes($attribute, $value)
    {
        $day = Carbon::parse($value)->format('Y-m-d');

        $date = Carbon::parse($day . ' 06:00:00 GMT');

        if(! $date) {
            $this->message = 'Enter a valid date.';
            return false;
        }

        if($date > app(WordleBoard::class)->activeBoardEndTime) {
            $this->message = 'No Wordle exists yet for this date.';
            return false;
        }

        if($date < app(WordleBoard::class)->firstBoardStartTime) {
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
