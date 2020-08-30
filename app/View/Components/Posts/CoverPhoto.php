<?php

namespace App\View\Components\Posts;

use App\Photo;
use Debugbar;
use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Collection;

class CoverPhoto extends Component
{
    public ?Photo $photo;
    public bool $smallPhoto;
    public bool $singlePost;
    public ?string $title;

    /**
     * Create a new component instance.
     *
     * @param Photo|null $photo
     * @param bool $smallPhoto
     * @param bool $singlePost
     * @param string|null $title
     */
    public function __construct(?Photo $photo, bool $smallPhoto, bool $singlePost, ?string $title)
    {
        $this->photo = $photo;
        $this->smallPhoto = $smallPhoto;
        $this->singlePost = $singlePost;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="col">
                <div>
                    <lazy-image :photo="{{ json_encode($photoDetails->all()) }}"></lazy-image>
                </div>

                 @if ($singlePost && (isset($photo->label) || isset($photo->referral)))
                    <div class="photoLabel row mx-3 px-3 mb-1">
                        <div class="mx-auto row text-center">
                            <span class="description px-2 col-md-auto col-12">{{ $photo->label ?? '' }}</span>
                            <span class="col-md-auto col-12"> <a href="{{ $photo->referral ?? '#' }}">{{ parse_url($photo->referral)['host'] ?? '' }}</a></span>
                        </div>
                    </div>
                @endif
            </div>
        blade;
    }

    /**
     * Get the correct photo
     *
     * @return string
     */
    public function photoUrl() : string
    {
        if($this->photo) {
            return ($this->smallPhoto)
                ? $this->photo->mediumPhotoUrl
                : $this->photo->photoUrl;
        }

        return 'http://via.placeholder.com/350x170';
    }

    /**
     * Get the photo urls
     *
     */
    public function photoDetails() : \Illuminate\Support\Collection
    {
        return collect([
            'id' => $this->photo->id,
            'preload' => $this->photo->smallPhotoUrl,
            'fallback' => $this->photo->mediumPhotoUrl,
            'title' => $photo->label ?? $this->title,
            'srcset' => [
                $this->photo->smallPhotoUrl . ' 150w',
                $this->photo->mediumPhotoUrl . ' 1000w',
                $this->photo->largePhotoUrl . ' 1500w',
                $this->photo->photoUrl . ' 2000w'
            ],
            'sizes' => '(min-width: 940px) 66vw, 100vw'
        ]);
    }
}
