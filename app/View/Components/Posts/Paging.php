<?php

namespace App\View\Components\Posts;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;

class Paging extends Component
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
        return <<<'blade'
            <div class="row col-lg-6 col-12 ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    {{ $posts->links() }}
                </div>
            </div>
blade;
    }
}
