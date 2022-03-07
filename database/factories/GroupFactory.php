<?php

namespace Database\Factories;

use App\Concerns\Tokens;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name'          => $this->faker->company(),
            'token'         => app(Tokens::class)->generate(),
            'verified_at'   => null,
        ];
    }
}
