<?php

namespace App\View\Components\Account;

use App\Models\User;
use Illuminate\View\Component;

class ShareLinks extends Component
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('components.account.share-links');
    }
}
