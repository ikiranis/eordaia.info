<?php

namespace App\View\Components\Plugins;

use Illuminate\View\Component;

class AdvertLandscape extends Component
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
                <a href="https://apps4net.eu">
                    <img src="{{url('/graphics/apps4net_ad_landscape.svg')}}" width="728" title="apps4net.eu">
                </a>
            </x-plugin>
        blade;
    }
}
