<?php

namespace App\Http\Livewire\Account;

use App\Concerns\WordleBoard;
use App\Models\Score;
use App\Models\User;
use App\Rules\DateCantBeAfterToday;
use App\Rules\DateMustBeValid;
use App\Rules\ValidWordleBoard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function app;
use function redirect;
use function route;
use function session;
use function view;

class RecordScore extends Component
{
    public $user;

    public $group;

    protected $listeners = ['scoreRecorded'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function scoreRecorded()
    {
        session()->flash('message', 'Score recorded.');

        return redirect()->to(route('account.home'));
    }

    public function render()
    {
        return view('livewire.account.record-score');
    }
}
