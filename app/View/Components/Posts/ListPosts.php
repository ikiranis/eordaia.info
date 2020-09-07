<?php

namespace App\View\Components\Posts;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ListPosts extends Component
{
    public LengthAwarePaginator $posts;

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
