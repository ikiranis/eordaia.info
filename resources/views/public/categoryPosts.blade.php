@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Category: {{$category->name}}
@endsection

@section('shareMetaTags')
    <x-posts.CategoryMetaTags :category="$category" />
@endsection

@section('content')

    <section class="container">

        <div class="ml-4 row listLabel px-3">
            <a href="{{ route('category', '') . '/' . $category->slug }}"
               class="text-dark my-auto">
                {{ $category->name }}
            </a>
        </div>

        @if(count($posts)>0)

            <x-posts.ListPosts :posts="$posts" />

            <x-posts.paging :posts="$posts" />

            {{--            @include('includes.ads.homepage-google-ad')--}}

        @endif
    </section>

@endsection
