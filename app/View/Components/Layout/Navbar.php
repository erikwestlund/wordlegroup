<?php

namespace App\View\Components\Layout;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::check() ? Auth::user() : null;
    }

    public function render()
    {
        return view('components.layout.navbar');
    }
}
