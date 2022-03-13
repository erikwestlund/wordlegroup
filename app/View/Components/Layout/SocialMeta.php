<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class SocialMeta extends Component
{
    public $description;

    public $siteName;

    public $title;

    public $image;

    public $type;

    public $url;

    public function __construct(
        $title = 'Wordle Group - Keep Score In Wordle With Friends',
        $siteName = 'Wordle Group',
        $url = 'https://wordlegroup.com/',
        $description = 'Wordle Group is free and easy way to keep score in Wordle with your friends.',
        $type = 'website',
        $image = null
    ) {
        $this->title = $title;
        $this->siteName = $siteName;
        $this->url = $url;
        $this->description = $description;
        $this->type = $type;
        $this->image = $image;
    }

    public function render()
    {
        return view('components.layout.social-meta');
    }
}
