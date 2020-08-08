<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Plugin extends Component
{
    /**
     * Create a new component instance.
     *
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
        return <<<'blade'
            <div>
                <h4 class="pluginLabel text-center">
                    <span>{{ $label }}</span>
                </h4>
                <div>
                    {{ $slot }}
                </div>
            </div>
        blade;
    }
}
