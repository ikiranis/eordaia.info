<?php

namespace App\View\Components\Posts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Categories extends Component
{
    public Collection $categories;

    /**
     * Create a new component instance.
     *
     * @param $categories
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            @if(!$categories->isEmpty())
                <div class="row mt-3">
                    @foreach($categories as $category)
                        <a href="{{ route('category', '') . '/' . $category->slug }}" 
                            class="badge badge-success text-light mx-1">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            @endif
blade;
    }
}
