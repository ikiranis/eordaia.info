<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class Tags extends Component
{
    public Collection $tags;

    /**
     * Create a new component instance.
     *
     * @param $tags
     */
    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
        
            @if(!$tags->isEmpty())
                <div class="row mt-3">
                    @foreach($tags as $tag)
                        <a href="{{ route('tag', '') . '/' . $tag->slug }}" 
                            class="badge badge-primary text-light mx-1">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

blade;
    }
}
