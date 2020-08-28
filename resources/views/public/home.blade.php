@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('shareMetaTags')
    <x-posts.HomeMetaTags />
@endsection

@section('content')

{{--    @include('includes.posts.guest-post-message')--}}

    <div class="container">

        @if (isset($search))
            <div class="listLabel mb-2 text-center text-md-left">
                <span class="my-auto">{{ $search }}</span>
            </div>
        @endif

        <div class="row">

            <div class="col-lg-8 col-12">
                @if(count($posts)>0)

                    <x-posts.ListPosts :posts="$posts" />

                    <x-posts.paging :posts="$posts" />
{{--                    @include('includes.ads.homepage-google-ad')--}}
                @else
                    <div class="text-center mt-5 mx-3">
                        <div>
                            <span class="alert-icon mdi text-light-secondary mdi-alert-decagram-outline" />
                        </div>
                        <div>
                            <span class="mx-auto text-secondary">Δεν βρέθηκαν δημοσιεύσεις</span>
                        </div>
                    </div>
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
