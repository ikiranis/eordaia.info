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
<!--        <meta name="description" content="{{ $post->description }}"/>-->
        
            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="{{ $post->title }}">
            <meta itemprop="description" content="{{ Str::words(strip_tags($post->markdownBody), 50, '') }}">
            <meta itemprop="image" content="{{ $post->photos()->first() ? url($post->photos()->first()->photoUrl) : ''}}">
        
            <!-- Twitter Card data -->
<!--            <meta name="twitter:card" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">-->
<!--            <meta name="twitter:site" content="">-->
            <meta name="twitter:title" content="{{ $post->title }}">
            <meta name="twitter:description" content="{{ Str::words(strip_tags($post->markdownBody), 50, '') }}">
<!--            <meta name="twitter:creator" content="">-->
            <!-- Twitter summary card with large image must be at least 280x150px -->
            <meta name="twitter:image:src" content="{{ $post->photos()->first() ? url($post->photos()->first()->photoUrl) : ''}}">
        
            <!-- Open Graph data -->
            <meta property="og:title" content="{{ $post->title }}"/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="{{ secure_url('/' . $post->slug) }}"/>
            <meta property="og:image" content="{{ $post->photos()->first() ? url($post->photos()->first()->photoUrl) : ''}}"/>
            <meta property="og:image:width" content="282">
            <meta property="og:description" content="{{ Str::words(strip_tags($post->markdownBody), 50, '') }}"/>
            <meta property="og:site_name" content="eordaia.info"/>
            <meta property="article:published_time" content="{{ $post->created_at }}"/>
            <meta property="article:modified_time" content="{{ $post->updated_at }}"/>
<!--            <meta property="article:section" content="Article Section"/>-->
            <meta property="article:tag" content="{{ $tags }}"/>
<!--            <meta property="fb:admins" content="Facebook numberic ID"/>-->
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
        foreach($this->post->tags()->get() as $tag) {
            $tags = $tags . $tag->name . ' ';
        }

        return $tags;
    }
}
