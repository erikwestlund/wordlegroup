<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class Nav extends Component
{
    public $activePage;

    public function __construct($activePage)
    {
        $this->activePage = $activePage;
    }


    public function getPages()
    {
        return [
            'home'        => [
                'route' => route('account.home'),
                'title' => 'Summary',
            ],
            'groups'      => [
                'route' => route('account.groups'),
                'title' => 'My Groups',
            ],
            'record-score'      => [
                'route' => route('account.record-score'),
                'title' => 'Record Score',
            ],
//            'settings'        => [
//                'route' => route('account.home'),
//                'title' => 'Settings',
//            ],
        ];
    }

    public function render()
    {
        return view('components.account.nav', ['pages' => $this->getPages()]);
    }
}
