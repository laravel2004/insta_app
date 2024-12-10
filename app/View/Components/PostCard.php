<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostCard extends Component
{
    public $avatar;
    public $username;
    public $location;
    public $image;
    public $post_id;
    public $caption;

    public function __construct($avatar, $username, $location, $image, $caption, $post_id)
    {
        $this->avatar = $avatar;
        $this->username = $username;
        $this->location = $location;
        $this->image = $image;
        $this->caption = $caption;
        $this->post_id = $post_id;
    }

    public function render()
    {
        return view('components.post-card');
    }
}
