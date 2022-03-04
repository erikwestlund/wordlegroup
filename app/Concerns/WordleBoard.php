<?php

namespace App\Concerns;

use Carbon\Carbon;

class WordleBoard
{
    public $activeBoardEndTime;

    public $activeBoardNumber;

    public $activeBoardStartTime;

    public $firstBoardEndTime;

    public $firstBoardStartTime;

    public $hardMode;

    public $wordleDate;

    public function __construct()
    {
        $this->wordleDate = app(WordleDate::class);
        $this->firstBoardStartTime = $this->wordleDate->firstBoardStartTime;
        $this->firstBoardEndTime = $this->wordleDate->firstBoardEndTime;

        $this->activeBoardStartTime = now() <= Carbon::parse('Today 06:00:00 UTC')
            ? Carbon::parse('Yesterday 06:00:00 UTC')
            : Carbon::parse('Today 06:00:00 UTC');
        $this->activeBoardEndTime = $this->activeBoardStartTime->copy()->addDay()->subMicrosecond();

        $this->activeBoardNumber = $this->firstBoardStartTime->copy()->diffInDays($this->activeBoardStartTime);
    }

    public function getBoardNumberFromDate($date)
    {
        $date = app(WordleDate::class)->get($date);

        $boardNumber = $this->firstBoardStartTime->copy()->diffInDays($date);

        return $this->validateBoardNumber($boardNumber)
            ? $boardNumber
            : null;
    }

    public function parse($board)
    {
        $score = $this->getScoreFromBoard($board);

        // Store fails as 7s
        if ($score) {
            $scoreNumber = strtolower($score) === 'x' ? 7 : (int)$score;
        } else {
            $scoreNumber = null;
        }

        $boardNumber = $this->getBoardNumberFromBoard($board);
        $date = $this->getDateFromBoardNumber($boardNumber);
        $hardMode = $this->getHardModeFromBoard($board);

        $valid = $score !== null && $boardNumber !== null && $date !== null;

        return compact('score', 'scoreNumber', 'boardNumber', 'date', 'hardMode', 'valid');
    }

    public function getScoreFromBoard($board)
    {
        preg_match_all('/(\d|x|X)\/6/', $board, $matches);

        return in_array($matches[1][0] ?? null, [1, 2, 3, 4, 5, 6, 'X', 'x'])
            ? $matches[1][0]
            : null;
    }

    public function getHardModeFromBoard($board)
    {
        preg_match_all('/(\d|x|X)\/6(\*)/', $board, $matches);

        $hardMode = $matches[2][0] ?? null;

        return $hardMode === '*';
    }

    public function getBoardNumberFromBoard($board)
    {
        preg_match_all('/(\d+)\s(\d|x|X)\/6/', $board, $matches);

        $boardNumber = is_numeric($matches[1][0] ?? null)
            ? $matches[1][0]
            : null;

        return $this->validateBoardNumber($boardNumber)
            ? $boardNumber
            : null;
    }

    public function getDateFromBoardNumber($boardNumber)
    {
        return app(WordleDate::class)->get($this->firstBoardStartTime->copy()->addDays($boardNumber));
    }

    public function extractBoard($entry)
    {
        preg_match_all('/.*\/(\d\*|\d)(.*)/s', $entry, $matches);

        return isset($matches[2][0])
            ? trim($matches[2][0])
            : null;
    }

    public function validateBoardNumber($boardNumber)
    {
        return $boardNumber >= 0 && $boardNumber <= $this->activeBoardNumber;
    }

    public function validateWordleDate($date)
    {
        return $date > $this->firstBoardStartTime && $date <= $this->activeBoardEndTime;
    }
}
