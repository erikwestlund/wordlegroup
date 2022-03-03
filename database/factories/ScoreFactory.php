<?php

namespace Database\Factories;

use App\Concerns\WordleBoard;
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
        $score = $this->faker->numberBetween(1, 7);
        $scoreCharacter = $score === 7 ? 'X' : $score;
        $hardMode = $this->faker->boolean();
        $hardModeAsterisk = $hardMode ? '*' : '';

        $board = "Wordle {$boardNumber} {$scoreCharacter}/6{$hardModeAsterisk}

⬜🟨⬜⬜⬜
🟨⬜⬜🟨⬜
⬜⬜🟩⬜🟩
🟩⬜🟩⬜🟩
🟩🟩🟩🟩🟩";

        $user = User::factory();

        return [
            'user_id'           => $user,
            'recording_user_id' => $user,
            'date'              => $date,
            'board_number'      => $boardNumber,
            'score'             => $score,
            'hard_mode'         => $hardMode,
            'board'             => $board,
        ];
    }
}
