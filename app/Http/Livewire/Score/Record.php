<?php

namespace App\Http\Livewire\Score;

use App\Concerns\WordleBoard;
use App\Models\Score;
use App\Models\User;
use App\Rules\DateCantBeAfterToday;
use App\Rules\DateMustBeValid;
use App\Rules\ValidWordleBoard;
use Carbon\Carbon;
use Livewire\Component;

class Record extends Component
{
    public $user;

    public $date;

    public $score;

    public $board;

    public $bricked;

    public function mount($key)
    {
        $this->user = User::getFromUrlKey($key);
        $this->date = app(WordleBoard::class)->activeBoardStartTime->format('Y-m-d');
    }

    public function storeScore($data)
    {
        $date = Carbon::parse($data['date']);

         Score::updateOrCreate([
            'user_id' => $this->user->id,
            'date'    => $date->format('Y-m-d'),
        ], [
            'score'        => $data['score'],
            'board_number' => $data['boardNumber'],
            'board'        => $data['board'] ?? null,
        ]);
    }

    public function recordScoreFromBoard()
    {
        $this->validate([
            'board' => ['required', new ValidWordleBoard()],
        ]);

        $data = app(WordleBoard::class)->parse($this->board);

        $this->storeScore([
            'score'       => $data['scoreNumber'],
            'boardNumber' => $data['boardNumber'],
            'date'        => $data['date'],
            'board'       => $this->board,
        ]);

        return $this->flashSuccessAndShowUserPage();
    }

    public function flashSuccessAndShowUserPage()
    {
        session()->flash('message', 'Score recorded.');

        return redirect()->to(route('account', $this->user->urlKey));
    }

    public function recordScoreManually()
    {
        $this->validate([
            'date'  => ['required', 'date', new DateMustBeValid()],
            'score' => ['required_without:bricked'],
        ]);

        $this->storeScore([
            'score'       => $this->bricked ? 7 : $this->score,
            'boardNumber' => app(WordleBoard::class)->getBoardNumberFromDate($this->date),
            'date'        => $this->date,
        ]);

        return $this->flashSuccessAndShowUserPage();
    }

    public function render()
    {
        return view('livewire.score.record');
    }
}
