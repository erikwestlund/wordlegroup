<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class Nav extends Component
{
    public $activePage;

    public $noneSelected;

    public function __construct($activePage)
    {

        $this->noneSelected = !in_array($activePage, collect($this->getPages())->keys()->toArray());
        $this->activePage = $this->noneSelected ? 'navigation' : $activePage;
    }


    public function getPages()
    {
        return [
            'placeholder'   => [
                'title'       => 'Navigation',
                'placeholder' => true,
                'route' => null
            ],
            'home'         => [
                'route' => route('account.home'),
                'title' => 'Summary',
            ],
            'groups'       => [
                'route' => route('account.groups'),
                'title' => 'My Groups',
            ],
            'record-score' => [
                'route' => route('account.record-score'),
                'title' => 'Record Score',
            ],
            'settings'        => [
                'route' => route('account.settings'),
                'title' => 'Settings',
            ],
        ];
    }

    public function render()
    {
        return view('components.account.nav', ['pages' => $this->getPages()]);
    }
}
