<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;

class HomeMetaTags extends Component
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
            <meta name="description"
                      content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα"/>

            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
            <meta itemprop="description"
                  content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα">
            <meta itemprop="image" content="{{ url('/graphics/logo.png') }}">

            <!-- Twitter Card data -->
            {{--<meta name="twitter:card" content="">--}}
            <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
            <meta name="twitter:description"
                  content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα">
            <!-- Twitter summary card with large image must be at least 280x150px -->
            <meta name="twitter:image:src" content="{{ url('/graphics/logo.png') }}">

            <!-- Open Graph data -->
            <meta property="og:title" content="{{ config('app.name', 'Laravel') }}"/>
            <meta property="og:type" content="website"/>
            <meta property="og:url" content="{{ url('/') }}"/>
            <meta property="og:image" content="{{ url('/graphics/logo.png') }}"/>
            <meta property="og:image:width" content="200">
            <meta property="og:description"
                  content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα"/>
            <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}"/>
blade;
    }
}
