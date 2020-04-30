<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class SinglePost extends Component
{
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posts.single-post');
    }
}
