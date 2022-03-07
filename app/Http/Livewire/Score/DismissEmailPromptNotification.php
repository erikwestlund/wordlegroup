<?php

namespace App\Http\Livewire\Score;

use App\Models\User;
use Livewire\Component;

class DismissEmailPromptNotification extends Component
{
    public $user;

    public $message;

    public $backRoute = 'account.home';

    public $class;

    public function mount(
        User $user,
        $class = 'text-sm text-gray-600 hover:text-gray-800',
        $message = "Don't remind me again."
    ) {
        $this->user = $user;
        $this->class = $class;
        $this->message = $message;
    }

    public function dismiss()
    {
        $this->user->dismissEmailNotification();

        session()->flash('message', "We won't remind you as much.");

        return redirect()->to(route($this->backRoute));
    }

    public function render()
    {
        return view('livewire.score.dismiss-email-prompt-notification');
    }
}
