<?php

namespace App\Concerns;

use Carbon\Carbon;

class ParsesBoard
{
    public $firstBoard;

    public $todaysBoard;

    public function __construct()
    {
        $this->firstBoard = Carbon::parse('2021-06-19');
        $this->todaysBoard = $this->firstBoard->diffInDays(now());
    }

    public function parse($board)
    {
        $score = $this->getScoreFromBoard($board);
        $boardNumber = $this->getBoardNumberFromBoard($board);
        $date = $this->getDateFromBoardNumber($boardNumber);

        $valid = $score !== null && $boardNumber !== null && $date !== null;

        return compact('score', 'boardNumber', 'date', 'valid');
    }

    public function getScoreFromBoard($board)
    {
        // First, just check for a score out of 6.
        preg_match_all('/(\d)\/6/', $board, $matches);

        return in_array($matches[1][0] ?? null, [1, 2, 4, 5, 6, 'X', 'x'])
            ? $matches[1][0]
            : null;
    }

    public function getBoardNumberFromBoard($board)
    {
        // First, just check for a score out of 6.
        preg_match_all('/(\d+)\s(\d)\/6/', $board, $matches);

        $boardNumber = is_numeric($matches[1][0] ?? null)
            ? $matches[1][0]
            : null;

        if(! $boardNumber) {
            return null;
        }

        return $boardNumber > 0 && $boardNumber <= $this->todaysBoard
            ? $boardNumber
            : null;
    }

    public function getBoardNumberFromDate($date)
    {
        $date = Carbon::parse($date);

        if ($date > now()->addDay()->endOfDay()) {
            return null;
        }

        $boardNumber = $this->firstBoard->diffInDays($date);

        return $boardNumber > 0 && $boardNumber <= $this->todaysBoard
            ? $boardNumber
            : null;
    }

    public function getDateFromBoardNumber($boardNumber)
    {
        $date = $this->firstBoard->addDays($boardNumber);

        if ($date > now()->endOfDay()) {
            return null;
        }

        if ($date < $this->firstBoard->startOfDay()) {
            return null;
        }

        return $date;
    }
}
