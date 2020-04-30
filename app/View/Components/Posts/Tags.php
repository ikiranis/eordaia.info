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
                <div class="row mt-3">
                    @foreach($tags as $tag)
                        <a href="{{ route('tag', '') . '/' . $tag->slug }}" 
                            class="badge badge-primary text-light mx-1">
                            {{ $tag->name }}
                        </a>
                    @endforeach
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
        return $this->post->tags()->get();
    }
}
