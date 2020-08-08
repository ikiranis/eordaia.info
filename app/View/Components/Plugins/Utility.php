<?php

namespace App\View\Components\Plugins;

use Illuminate\View\Component;

class Utility extends Component
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
                    <span>Χρήσιμα</span>
                </x-slot>
        
                <span>
                    <a href="https://fskozanis.gr/efhmeries/ptolemaida/">Φαρμακεία</a>
                </span>
            </x-plugin>
        blade;
    }
}
