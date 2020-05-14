<?php

namespace App\View\Components\Posts;

use App\Photo;
use Illuminate\View\Component;

class CoverPhoto extends Component
{
    public Photo $photo;
    public string $postId;

    /**
     * Create a new component instance.
     *
     * @param Photo $photo
     * @param string $postId
     */
    public function __construct(Photo $photo, string $postId)
    {
        $this->photo = $photo;
        $this->postId = $postId;
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
            <div class="col-md-4 col-12">
                <img src="{{ $photo->photoUrl ? $photo->photoUrl : '' }}"
                     class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $postId }}">
            </div>
        @endif
blade;
    }
}
