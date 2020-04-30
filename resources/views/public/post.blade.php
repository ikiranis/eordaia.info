@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{ $post->title }}
@endsection

@section('shareMetaTags')
{{--    <meta name="description" content="{{ $post->description }}"/>--}}

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $post->title }}">
{{--    <meta itemprop="description" content="{{ $post->description }}">--}}
{{--    <meta itemprop="image" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">--}}

    <!-- Twitter Card data -->
{{--    <meta name="twitter:card" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">--}}
    {{--<meta name="twitter:site" content="">--}}
    <meta name="twitter:title" content="{{ $post->title }}">
{{--    <meta name="twitter:description" content="{{ $post->description }}">--}}
    {{--<meta name="twitter:creator" content="">--}}
    <!-- Twitter summary card with large image must be at least 280x150px -->
{{--    <meta name="twitter:image:src" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">--}}

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ secure_url('/' . $post->slug) }}"/>
{{--    <meta property="og:image" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}"/>--}}
    <meta property="og:image:width" content="282">
{{--    <meta property="og:description" content="{{ $post->description }}"/>--}}
    <meta property="og:site_name" content="eordaia.info"/>
    <meta property="article:published_time" content="{{ $post->created_at }}"/>
    <meta property="article:modified_time" content="{{ $post->updated_at }}"/>
    {{--<meta property="article:section" content="Article Section"/>--}}
    @php
        $tags = '';
        foreach($post->tags()->get() as $tag) {
             $tags = $tags . $tag->name . ' ';
        }
    @endphp
    <meta property="article:tag" content="{{ $tags }}"/>
    {{--<meta property="fb:admins" content="Facebook numberic ID"/>--}}

@endsection

@section('content')

    <div class="container">

        <x-posts.SinglePost :post="$post" />

    </div>

@endsection

@section('scripts')


@endsection
