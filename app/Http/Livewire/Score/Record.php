<?php

namespace App\Http\Livewire\Score;

use App\Concerns\ParsesBoard;
use App\Models\Score;
use App\Models\User;
use App\Rules\DateCantBeAfterToday;
use App\Rules\DateMustBeValid;
use App\Rules\ValidWordleBoard;
use Livewire\Component;

class Record extends Component
{
    public $user;

    public $date;

    public $score;

    public $board;

    public function mount($key)
    {
        $this->user = User::getFromUrlKey($key);
        $this->date = now()->format('Y-m-d');
    }

    public function storeScore($data)
    {
        return Score::firstOrCreate(array_merge([
            'user_id' => $this->user->id,
        ], $data));
    }

    public function recordScoreFromBoard()
    {
        $this->validate([
            'board' => ['required', new ValidWordleBoard()],
        ]);

        $data = app(ParsesBoard::class)->parse($this->board);

        $this->storeScore([
            'score'        => $data['score'],
            'board_number' => $data['boardNumber'],
            'date'         => $data['date'],
            'board'        => $this->board,
        ]);

        session()->flash('message', 'Score recorded.');

        return redirect()->to(route('account', $this->user->urlKey));
    }

    public function recordScoreManually()
    {
        $this->validate([
            'date'  => ['required', 'date', new DateMustBeValid()],
            'score' => ['required'],
        ]);
    }

    public function render()
    {
        return view('livewire.score.record');
    }
}
