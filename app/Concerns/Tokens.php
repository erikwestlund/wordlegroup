<?php

namespace App\Concerns;

use Illuminate\Support\Str;

class Tokens
{
    public function generate()
    {
        return Str::random(36);
    }
}
