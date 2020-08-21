<?php

namespace App\View\Components\Posts;

use App\Post;
use App\Video;
use Illuminate\View\Component;

class Videos extends Component
{
    protected Post $post;

    /**
     * Create a new component instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
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
            @if ($videos->count() > 0)
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="mx-auto col-lg-6 col-12">
                            <x-Youtube :url="$video->url" />
                        </div>
                    @endforeach
                </div>
            @endif
        blade;
    }

    /**
     * @return Video|null
     */
    public function videos()
    {
        return $this->post->videos
            ?? null;
    }
}
