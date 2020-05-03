<?php

namespace App\View\Components\Posts;

use App\Tag;
use Illuminate\View\Component;

class TagMetaTags extends Component
{
    public Tag $tag;

    /**
     * Create a new component instance.
     *
     * @param $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <meta name="description" content="Tag: {{$tag->name}}"/>
        
            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="Tag: {{$tag->name}}">
            <meta itemprop="description" content="Tag: {{$tag->name}}">
<!--            <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">-->
        
            <!-- Twitter Card data -->
            <meta name="twitter:card" content="">
            <meta name="twitter:title" content="Tag: {{$tag->name}}">
            <meta name="twitter:description" content="Tag: {{$tag->name}}">
            <!-- Twitter summary card with large image must be at least 280x150px -->
<!--            <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">-->
        
            <!-- Open Graph data -->
            <meta property="og:title" content="Tag: {{$tag->name}}"/>
            <meta property="og:type" content="category"/>
<!--            <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>-->
            <meta property="og:image:width" content="282">
            <meta property="og:description" content="Tag: {{$tag->name}}"/>
            <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}"/>
blade;
    }
}
