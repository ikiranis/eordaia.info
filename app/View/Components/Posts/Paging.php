<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;

class Paging extends Component
{
    public $posts;

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
            <div class="row col-12">
                <div class="paginate mx-auto">
                    {{ $posts->onEachSide(2,0)->links() }}
                </div>
            </div>
blade;
    }
}
