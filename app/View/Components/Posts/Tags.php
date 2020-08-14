<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class Tags extends Component
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

            @if(!$tags->isEmpty())
                <div class="row px-3 text-center">
                    <div class="col-12">
                        @foreach($tags as $tag)
                            <a href="{{ route('tag', '') . '/' . $tag->slug }}"
                                class="badge badge-light-secondary col-12 col-md-auto text-dark mx-1 my-1 px-2">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

blade;
    }

    /**
     * Get post tags
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tags()
    {
        return $this->post->tags;
    }
}
