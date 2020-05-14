<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class ImageModal extends Component
{
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param $post
     */
    public function __construct($post)
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
            <div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="imageModal{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="elementModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
            
                            <img src="{{ $post->photos()->first()->photoUrl ?? 'http://via.placeholder.com/350x150' }}"
                                 width="100%">
            
                        </div>
            
                    </div>
                </div>
            </div>
blade;
    }
}
