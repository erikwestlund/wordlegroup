<?php

namespace App\Casts;

use App\Concerns\WordleDate;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class WordleDailyStartTime implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return app(WordleDate::class)->get($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
