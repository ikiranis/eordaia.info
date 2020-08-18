@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} | Category: {{$category->name}}
@endsection

@section('shareMetaTags')
    <x-posts.CategoryMetaTags :category="$category" />
@endsection

@section('content')

    <section class="container">

        <div class="listLabel mb-2 text-center text-md-left">
            <a href="{{ route('category', '') . '/' . $category->slug }}"
               class="my-auto">
                {{ $category->name }}
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
