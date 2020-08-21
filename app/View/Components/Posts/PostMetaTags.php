<?php

namespace App\View\Components\Posts;

use App\Post;
use Illuminate\View\Component;

class PostMetaTags extends Component
{
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param $post
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <meta name="description" content="{{ $post->description }}"/>

            <meta itemprop="name" content="{{ $post->title }}">
            <meta itemprop="description" content="{{ $post->description }}">
            <meta itemprop="image" content="{{ $post->cover ? $post->cover->fullFeedImage : '' }}">

            <!-- Twitter Card data -->
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:site" content="@eordaia_info">
            <meta name="twitter:creator" content="@eordaia_info" />
            <meta name="twitter:title" content="{{ $post->title }}">
            <meta name="twitter:description" content="{{ $post->description }}">
            <meta name="twitter:image" content="{{ $post->cover ? $post->cover->fullFeedImage : '' }}">

            <!-- Open Graph data -->
            <meta property="og:title" content="{{ $post->title }}"/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="{{ secure_url('/' . $post->slug) }}"/>
            <meta property="og:image" content="{{ $post->cover ? $post->cover->fullFeedImage : '' }}"/>
            <meta property="og:image:width" content="282">
            <meta property="og:description" content="{{ $post->description }}"/>
            <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}"/>
            <meta property="article:published_time" content="{{ $post->created_at }}"/>
            <meta property="article:modified_time" content="{{ $post->updated_at }}"/>
<!--            <meta property="article:section" content="Article Section"/>-->
            <meta property="article:tag" content="{{ $tags }}"/>
blade;
    }

    /**
     * Get tags of the post
     *
     * @return string
     */
    public function tags() : string
    {
        $tags = '';
        foreach($this->post->tags as $tag) {
            $tags = $tags . $tag->name . ' ';
        }

        return $tags;
    }
}
