<?php

namespace App\View\Components\Plugins;

use Illuminate\View\Component;

class Covid extends Component
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
                <a href="https://eody.gov.gr/neos-koronaios-covid-19/"><img
                                src="{{url('/graphics/covid.png')}}"></a>
            </x-plugin>
        blade;
    }
}
