<?php

namespace App\View\Components\Posts;

use App\Photo;
use Illuminate\View\Component;

class CoverPhoto extends Component
{
    public Photo $photo;
    public string $postId;
    public bool $smallPhoto;

    /**
     * Create a new component instance.
     *
     * @param Photo $photo
     * @param string $postId
     * @param bool $smallPhoto
     */
    public function __construct(Photo $photo, string $postId, bool $smallPhoto)
    {
        $this->photo = $photo;
        $this->postId = $postId;
        $this->smallPhoto = $smallPhoto;
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
                <img src="{{ $photoUrl ?? 'http://via.placeholder.com/350x350' }}"
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
