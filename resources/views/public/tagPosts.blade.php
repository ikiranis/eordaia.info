@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Tag: {{$tag->name}}
@endsection

@section('shareMetaTags')
    <x-posts.TagMetaTags :tag="$tag" />
@endsection

@section('content')

    <section class="container">

        <span>:: </span>
        <a href="{{ route('tag', '') . '/' . $tag->slug }}"
           class="text-secondary mx-1">
            {{ $tag->name }}
        </a>

        @if(count($posts)>0)

            <x-posts.ListPosts :posts="$posts" />

            <x-posts.paging :posts="$posts" />

{{--            @include('includes.ads.homepage-google-ad')--}}

        @endif
    </section>

@endsection
