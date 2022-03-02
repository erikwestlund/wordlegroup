<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class HomeLayout extends Component
{
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('components.account.home-layout');
    }
}
