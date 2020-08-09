<?php

namespace App\View\Components\Plugins;

use Illuminate\View\Component;

class Affiliate extends Component
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
        return <<<'blade'
            <x-plugin>
                <x-slot name="label">
                    <span>Δείτε επίσης</span>
                </x-slot>
        
                <div>
                    <a href="https://plug.gr/">Ptolemaida's Linux Users Group</a>
                </div>
                <div>
                    <a href="https://error.gr">error.gr</a>
                </div>
            </x-plugin>
        blade;
    }
}
