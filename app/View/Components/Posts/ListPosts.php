<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;
use Illuminate\Pagination\Paginator;

class ListPosts extends Component
{
    public Paginator $posts;

    /**
     * Create a new component instance.
     *
     * @param $posts
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posts.list-posts');
    }
}
