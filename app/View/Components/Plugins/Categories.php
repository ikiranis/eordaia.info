<?php

namespace App\View\Components\Plugins;

use App\Category;
use Illuminate\View\Component;

class Categories extends Component
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
        $categories = Category::orderBy('name', 'asc')->get();

        return view('components.plugins.categories', compact(['categories']));
    }
}
