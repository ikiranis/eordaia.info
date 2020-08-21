<?php

namespace App\View\Components;

use App\Services\VideoService;
use Illuminate\View\Component;

class Youtube extends Component
{
    public string $url;

    /**
     * Create a new component instance.
     *
     * @param $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="my-3">
                <iframe width="100%" height="315"
                    src="{{ 'https://www.youtube.com/embed/' . $videoID }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
blade;
    }

    /**
     * Get youtube ID
     *
     * @return string
     */
    public function videoID() : string
    {
        return VideoService::getYoutubeID($this->url);
    }
}
