@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('shareMetaTags')
    <meta name="description"
          content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description"
          content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα">
{{--    <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">--}}

    <!-- Twitter Card data -->
    {{--<meta name="twitter:card" content="">--}}
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description"
          content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδα">
    <!-- Twitter summary card with large image must be at least 280x150px -->
{{--    <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">--}}

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}"/>
    <meta property="og:type" content="home"/>
{{--    <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>--}}
{{--    <meta property="og:image:width" content="282">--}}
    <meta property="og:description"
          content="Ειδήσεις, εμπορικός οδηγός, αγγελίες κτλ από την Πτολεμαϊδαά"/>
    <meta property="og:site_name" content="eordaia.info"/>
@endsection

@section('content')

{{--    <div class="container">--}}

{{--        <div class="row justify-content-center">--}}

{{--            @include('includes.sport-images')--}}

{{--        </div>--}}

{{--    </div>--}}

    @include('includes.search-text')

{{--    @include('includes.posts.guest-post-message')--}}

    <div class="container">

        <div class="row no-gutters">

            <div class="container col-lg-10 col-12">
                @if(count($posts)>0)

                    @foreach($posts as $post)

                        @include('includes.post-list')

                    @endforeach

                    <x-posts.paging :posts="$posts" />
{{--                    @include('includes.ads.homepage-google-ad')--}}

                @endif
            </div>

            @include('includes.page.sidebar')


        </div>

    </div>

@endsection

@section('scripts')


@endsection
