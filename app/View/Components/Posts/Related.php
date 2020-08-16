<?php

namespace App\View\Components\Posts;

use App\Post;
use Debugbar;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Collection;

class Related extends Component
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
            @if ($relatedPosts->count() > 0)
                <hr>
                <div class="mt-3 px-3 ">
                    @foreach ($relatedPosts as $post)
                        <div class="row mb-2 col-12">
                            <div class="my-auto"><img src="{{ $post->photos->first()->smallPhotoUrl }}"></div>
                            <div class="col my-auto"><a href="{{ url($post->slug) }}">{{ $post->title }}</a> {{ $post->updated_at->format('d/m/Y') }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        blade;
    }

    /**
     * Find related posts by tag
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|mixed
     */
    public function relatedPosts()
    {
        $tags = $this->post->tags;
        $categories = $this->post->categories;

        $posts = collect();

        foreach ($tags as $tag) {
            $posts = $posts
                ->concat($tag->posts
                    ->unique()
                    ->whereNotIn('id', $this->post->id)
                    ->sortByDesc('updated_at')
                    ->take(3));
        }

        if($posts->count() == 0) {
            foreach ($categories as $category) {
                $posts = $posts
                    ->concat($category->posts
                        ->unique()
                        ->whereNotIn('id', $this->post->id)
                        ->sortByDesc('updated_at')
                        ->take(3));
            }
        }

        return $posts;
    }
}
