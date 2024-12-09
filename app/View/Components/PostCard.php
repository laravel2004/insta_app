<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostCard extends Component
{
    public $avatar;
    public $username;
    public $location;
    public $image;
    public $caption;

    public function __construct($avatar, $username, $location, $image, $caption)
    {
        $this->avatar = $avatar;
        $this->username = $username;
        $this->location = $location;
        $this->image = $image;
        $this->caption = $caption;
    }

    public function render()
    {
        return view('components.post-card');
    }
}
