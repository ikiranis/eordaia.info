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
            <div class="plugin">
                @if (isset($label)) 
                    <h5 class="pluginLabel text-primary">
                        <span>:: {{ $label }}</span>
                    </h5>
                @endif
                
                <div>
                    {{ $slot }}
                </div>
            </div>
        blade;
    }
}
