<?php

namespace App\View\Components\Posts;

use App\Category;
use Illuminate\View\Component;

class CategoryMetaTags extends Component
{
    public Category $category;

    /**
     * Create a new component instance.
     *
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <meta name="description" content="Category: {{$category->name}}"/>
        
            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="Category: {{$category->name}}">
            <meta itemprop="description" content="Category: {{$category->name}}">
<!--            <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">-->
        
            <!-- Twitter Card data -->
            <meta name="twitter:card" content="">
            <meta name="twitter:title" content="Category: {{$category->name}}">
            <meta name="twitter:description" content="Category: {{$category->name}}">
            <!-- Twitter summary card with large image must be at least 280x150px -->
<!--            <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">-->
        
            <!-- Open Graph data -->
            <meta property="og:title" content="Category: {{$category->name}}"/>
            <meta property="og:type" content="category"/>
<!--            <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>-->
            <meta property="og:image:width" content="282">
            <meta property="og:description" content="Category: {{$category->name}}"/>
            <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}"/>
blade;
    }
}
