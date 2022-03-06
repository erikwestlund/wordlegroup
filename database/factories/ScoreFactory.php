<?php

namespace Database\Factories;

use App\Concerns\WordleBoard;
use App\Concerns\WordleDate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $wordleStart = app(WordleBoard::class)->firstBoardStartTime;

        $date = $this->faker->dateTimeBetween($wordleStart, now()->subDay());
        $boardNumber = app(WordleBoard::class)->getBoardNumberFromDate($date);
        $score = $this->faker->numberBetween(2, 7);
        $scoreCharacter = $score === 7 ? 'X' : $score;
        $hardMode = $this->faker->boolean();
        $hardModeAsterisk = $hardMode ? '*' : '';

        $board = "⬜🟨⬜⬜⬜
🟨⬜⬜🟨⬜
⬜⬜🟩⬜🟩
🟩⬜🟩⬜🟩
🟩🟩🟩🟩🟩";

        $user = User::factory();

        $scoreTime = app(WordleDate::class)->get($date)
                                           ->addHours(random_int(0, 23))
                                           ->addMinutes(random_int(0, 59))
                                           ->addSeconds(random_int(0, 59));

        return [
            'user_id'           => $user,
            'recording_user_id' => $user,
            'date'              => $date,
            'board_number'      => $boardNumber,
            'score'             => $score,
            'hard_mode'         => $hardMode,
            'board'             => $board,
            'created_at'        => $scoreTime,
            'updated_at'        => $scoreTime,
        ];
    }
}
