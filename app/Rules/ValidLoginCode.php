<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ValidLoginCode implements Rule
{
    public $user;

    public $message;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        if ($this->user->validateLogin($value)) {
            return true;
        }

        $this->message = 'This login code is invalid.';

        if ($this->user->loginCodeExpired()) {
            $this->message = 'This login code has expired.';
        }

        return false;
    }

    public function message()
    {
        return $this->message;
    }
}
