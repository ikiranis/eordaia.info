<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class Categories extends Component
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
        return <<<'blade'
            @if(!$categories->isEmpty())
                <div class="row">
                    @foreach($categories as $category)
                        <a href="{{ route('category', '') . '/' . $category->slug }}"
                            class="text-dark my-auto px-3">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif
blade;
    }

    /**
     * Get post categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->post->categories()->get();
    }
}
