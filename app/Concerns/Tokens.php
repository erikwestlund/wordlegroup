<?php

namespace App\Concerns;

use Illuminate\Support\Str;

class Tokens
{
    public function generate($length = 36, $digitsOnly = false)
    {
        return $digitsOnly
            ? substr(str_shuffle('0123456789'), 1, $length)
            : Str::random($length);
    }

    public function generateDigits($length = 36)
    {
        return $this->generate($length, true);
    }
}
