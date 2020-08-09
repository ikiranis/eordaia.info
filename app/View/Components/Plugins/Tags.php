<?php

namespace App\View\Components\Plugins;

use App\Tag;
use Illuminate\View\Component;

class Tags extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $tags = Tag::limit(50)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('components.plugins.tags', compact(['tags']));
    }
}
