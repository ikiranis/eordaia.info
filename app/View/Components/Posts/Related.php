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
                <div class="mt-3 px-3">
                    @foreach ($relatedPosts as $post)
                        <div class="row mb-3 col-12">
                            <div class="my-auto col-12 col-md-auto px-3 text-center text-md-left">
                                <img src="{{ $post->cover->smallPhotoUrl }}">
                            </div>
                            <div class="col my-auto col-12 col-md">
                                <div><a href="{{ url($post->slug) }}">{{ $post->title }}</a></div>
                                <div>{{ $post->updated_at->format('d/m/Y') }}</div>
                            </div>
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
                    ->whereNotIn('id', $this->post->id)
                    ->sortByDesc('updated_at')
                    ->take(3));
        }

        if($posts->count() == 0) {
            foreach ($categories as $category) {
                $posts = $posts
                    ->concat($category->posts
                        ->whereNotIn('id', $this->post->id)
                        ->sortByDesc('updated_at')
                        ->take(3));
            }
        }

        $posts = $posts
            ->unique('id')
            ->sortByDesc('updated_at')
            ->take(4);

        return $posts;
    }
}
