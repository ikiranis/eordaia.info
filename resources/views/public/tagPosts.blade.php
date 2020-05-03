@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Tag: {{$tag->name}}
@endsection

@section('shareMetaTags')
    <x-posts.TagMetaTags :tag="$tag" />
@endsection

@section('content')

    <section class="container">

        <h1>{{$tag->name}}</h1>

        @if(count($posts)>0)

            <x-posts.ListPosts :posts="$posts" />

            <x-posts.paging :posts="$posts" />

{{--            @include('includes.ads.homepage-google-ad')--}}

        @endif
    </section>

@endsection
