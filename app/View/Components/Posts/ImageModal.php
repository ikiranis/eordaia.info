<?php

namespace App\View\Components\Posts;

use App\Photo;
use Illuminate\View\Component;

class ImageModal extends Component
{
    public Photo $photo;

    /**
     * Create a new component instance.
     *
     * @param $photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="modal fade" id="imageModal{{ $photo->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="imageModal{{ $photo->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="elementModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <display-image :id="{{ json_encode($photo->id) }}" ></display-image>
                        </div>

                        <div class="modal-footer">
                            <div class="photoLabel row mx-auto mx-3 px-3 ">
                                <div class="mx-auto row text-center">
                                    <span class="description px-2 col-md-auto col-12">{{ $photo->description ?? '' }}</span>
                                    <span class="col-md-auto col-12"> <a href="{{ $photo->referral ?? '#' }}">{{ parse_url($photo->referral)['host'] ?? '' }}</a></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
blade;
    }
}
