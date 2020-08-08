@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('shareMetaTags')
    <x-posts.HomeMetaTags />
@endsection

@section('content')

{{--    <x-posts.search />--}}

{{--    @include('includes.posts.guest-post-message')--}}

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-12">
                @if(count($posts)>0)

                    <x-posts.ListPosts :posts="$posts" />

                    <x-posts.paging :posts="$posts" />
{{--                    @include('includes.ads.homepage-google-ad')--}}

                @endif
            </div>

            <div class="col-lg-4 col-12">
                <x-sidebar />
            </div>


        </div>

    </div>

@endsection

@section('scripts')


@endsection
