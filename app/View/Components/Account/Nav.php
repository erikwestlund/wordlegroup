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
            'record-score'      => [
                'route' => route('account.record-score'),
                'title' => 'Record Score',
            ],
            'groups'      => [
                'route' => route('account.groups'),
                'title' => 'Groups',
            ],
            'settings'        => [
                'route' => route('account.home'),
                'title' => 'Settings',
            ],
        ];
    }

    public function render()
    {
        return view('components.account.nav', ['pages' => $this->getPages()]);
    }
}
