<?php

namespace App\View\Components\Posts;

use App\Photo;
use Illuminate\View\Component;

class CoverPhoto extends Component
{
    public ?Photo $photo;
    public string $postId;
    public bool $smallPhoto;
    public bool $singlePost;

    /**
     * Create a new component instance.
     *
     * @param Photo|null $photo
     * @param string $postId
     * @param bool $smallPhoto
     * @param bool $singlePost
     */
    public function __construct(?Photo $photo, string $postId, bool $smallPhoto, bool $singlePost)
    {
        $this->photo = $photo;
        $this->postId = $postId;
        $this->smallPhoto = $smallPhoto;
        $this->singlePost = $singlePost;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
        @if ($photo)
            <div class="col">
                <img src="{{ $photo->photoUrl }}"
                     class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $postId }}">
                 @if ($singlePost && (isset($photo->description) || $photo->referral))
                    <div class="photoLabel row mx-3 px-3">
                        <div class="my-auto mx-auto">
                            <span class="description px-2">{{ $photo->description ?? '' }}</span>
                            <span> <a href="{{ $photo->referral ?? '#' }}">{{ parse_url($photo->referral)['host'] ?? '' }}</a></span>
                        </div>
                    </div>
                @endif
            </div>
            
        @else
            <div class="col">
                <img src="{{ 'http://via.placeholder.com/350x170' }}"
                     class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $postId }}">
            </div>
        @endif
blade;
    }

    /**
     * Get the correct photo
     *
     * @return string
     */
    public function photoUrl() : ?string
    {
        return ($this->smallPhoto) ? $this->photo->smallPhotoUrl : $this->photo->mediumPhotoUrl;
    }
}
