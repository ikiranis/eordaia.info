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
                <div class="row mt-3 px-5">
                    @foreach($categories as $category)
                        <span>:: </span>
                        <a href="{{ route('category', '') . '/' . $category->slug }}"
                            class="text-secondary mx-1">
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
