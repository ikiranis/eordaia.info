@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('shareMetaTags')
    <x-posts.HomeMetaTags />
@endsection

@section('content')

    <x-posts.search />

{{--    @include('includes.posts.guest-post-message')--}}

    <div class="container blog-content">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="row">
                    <div class="col-sm-12">
                        @if(count($posts)>0)

                            <x-posts.ListPosts :posts="$posts" />

                            <x-posts.paging :posts="$posts" />
        {{--                    @include('includes.ads.homepage-google-ad')--}}

                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>



{{--    <x-sidebar />--}}

@endsection

@section('scripts')


@endsection
