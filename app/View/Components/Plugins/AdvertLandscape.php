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
                        <picture>
                              <source srcset="{{ url('/graphics/apps4net_ad_landscape.svg') }}"
                                      media="( min-width: 941px)" />
                              <source srcset="{{ url('/graphics/apps4net_ad.svg') }}"
                                      media="( max-width: 940px) " />

                              <!-- fallback -->
                              <img src="{{ url('/graphics/apps4net_ad_landscape.svg') }}" alt="apps4net.eu" width="100%" />
                        </picture>
                </a>
            </x-plugin>
        blade;
    }
}
