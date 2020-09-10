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
                        <div class="col-lg-6 col-12 mb-5" >
                            <display-image class="imageContainer"
                                :id="{{ json_encode($photo->id) }}"
                                style='width: 100%; padding-bottom: {{ $getHeight($photo) }};'
                                :referral="{{ json_encode(parse_url($photo->referral)['host'] ?? '') }}"></display-image>
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
     * Get post title
     *
     * @return String
     */
    public function title() : String
    {
        return $this->post->title;
    }

    /**
     * Get the height for photo container
     *
     * @param Photo $photo
     * @return string
     */
    public function getHeight(Photo $photo) : string
    {
        return $photo->ratio ? (100 / $photo->ratio) . '%' : '';
    }
}
