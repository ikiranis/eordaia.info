<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class Links extends Component
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
            @if(!$links->isEmpty())
                <div class="mt-3">
                    @foreach($links as $link)
                        <div class="text-medium-secondary">
                            <span class="mdi mdi-link-variant" />
                            <a href="{{ $link->url }}" class="text-medium-secondary" title="{{ $link->url }}">
                                <span>{{ parse_url($link->url)['host'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
blade;
    }

    /**
     * Get post links
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function links()
    {
        return $this->post->links;
    }
}
