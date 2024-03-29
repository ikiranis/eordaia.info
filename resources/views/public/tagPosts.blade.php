@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Tag: {{$tag->name}}
@endsection

@section('shareMetaTags')
    <x-posts.TagMetaTags :tag="$tag" />
@endsection

@section('content')

    <section class="container">

        <div class="listLabel mb-2 text-center text-md-left">
            <a href="{{ route('tag', '') . '/' . $tag->slug }}"
               class="my-auto">
                {{ $tag->name }}
            </a>
        </div>

        <div class="row">

            <div class="col-lg-8 col-12">
                @if(count($posts)>0)

                    <x-posts.ListPosts :posts="$posts" />

                    <x-posts.paging :posts="$posts" />

        {{--            @include('includes.ads.homepage-google-ad')--}}

                @endif
            </div>

            <div class="col-lg-4 col-12">
                <x-sidebar />
            </div>

        </div>
    </section>

@endsection
