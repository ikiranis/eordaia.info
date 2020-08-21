<?php

namespace App\View\Components\Posts;

use App\Photo;
use App\Post;
use Illuminate\View\Component;

class Photos extends Component
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
            @if ($photos->count() > 0)
                <div class="row mt-3">
                @foreach ($photos as $photo)
                    <div class="col-lg-6 col-12 mb-3">
                        <img src="{{ $getUrl($photo) }}" class="card-img mb-1" title="{{ $photo->description ?? $title }}">
                         @if ( isset($photo->description) || isset($photo->referral) )
                            <div class="photoLabel row mx-3 px-3 mb-1">
                                <div class="mx-auto row text-center">
                                    <span class="description px-2 col-md-auto col-12">{{ $photo->description ?? '' }}</span>
                                    <span class="col-md-auto col-12"> <a href="{{ $photo->referral ?? '#' }}">{{ parse_url($photo->referral)['host'] ?? '' }}</a></span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
                </div>
            @endif
        blade;
    }

    /**
     * @return Photo|null
     */
    public function photos()
    {
        return $this->post
                ->photos
                ->whereNotIn('id', $this->post->cover->id ?? null)
            ?? null;
    }

    /**
     * @param Photo $photo
     * @return String
     */
    public function getUrl(Photo $photo) : String {
        if($photo) {
            return $photo->mediumPhotoUrl ?? $photo->smallPhotoUrl;
        }
    }

    /**
     * Get post title
     *
     * @return String
     */
    public function title() : String
    {
        return $this->post->title;
    }
}
