@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Category: {{$category->name}}
@endsection

@section('shareMetaTags')
    <x-posts.CategoryMetaTags :category="$category" />
@endsection

@section('content')

    <section class="container">

        <span>:: </span>
        <a href="{{ route('category', '') . '/' . $category->slug }}"
           class="text-secondary mx-1">
            {{ $category->name }}
        </a>

        @if(count($posts)>0)

            <x-posts.ListPosts :posts="$posts" />

            <x-posts.paging :posts="$posts" />

            {{--            @include('includes.ads.homepage-google-ad')--}}

        @endif
    </section>

@endsection
