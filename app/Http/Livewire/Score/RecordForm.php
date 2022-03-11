<?php

namespace App\Http\Livewire\Score;

use App\Concerns\WordleBoard;
use App\Models\Group;
use App\Models\Score;
use App\Models\User;
use App\Rules\DateMustBeValid;
use App\Rules\ValidWordleBoard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecordForm extends Component
{
    public $board;

    public $bricked;

    public $date;

    public $group;

    public $hardMode;

    public $isGroupAdmin;

    public $quick;

    public $recordForUserId;

    public $recordingForSelf;

    public $hideEmail;

    public $score;

    public $user;

    public function mount(User $user, Group $group = null, $quick = false, $hideEmail = false)
    {
        $this->user = $user;
        $this->recordForUserId = $user->id;
        $this->recordingForSelf = $this->user->id === Auth::user()->id;
        $this->date = app(WordleBoard::class)->activeBoardStartTime->format('Y-m-d');
        $this->quick = $quick;
        $this->hideEmail = $hideEmail;

        $this->group = $group;
        $this->isGroupAdmin = $group ? $this->getIsGroupAdmin($group, $user) : false;
    }

    public function getIsGroupAdmin(Group $group, User $user)
    {
        return $group->isAdmin($user);
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
            'board'       => $data['board'],
            'hardMode'    => $data['hardMode'] ?? null,
        ]);
    }

    public function storeScore($data)
    {
        $date = Carbon::parse($data['date']);

        Score::create([
            'user_id'           => $this->recordForUserId,
            'recording_user_id' => $this->user->id,
            'date'              => $date->format('Y-m-d'),
            'score'             => $data['score'],
            'board_number'      => $data['boardNumber'],
            'board'             => $data['board'] ?? null,
            'hard_mode'         => $data['hardMode'] ?? null,
        ]);

        $this->emitUp('scoreRecorded');
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
            'hardMode'    => $this->hardMode ?? false,
        ]);

        $this->emitUp('scoreRecorded');
    }

    public function updatedRecordForUserId($userId)
    {
        $this->recordingForSelf = (int)$userId === Auth::user()->id;
    }

    public function render()
    {
        return view('livewire.score.record-form');
    }
}
