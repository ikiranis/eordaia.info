@extends('layouts.app')

@section('siteTitle')
    Δημοσίευση εταιρικού post
@endsection

{{--@section('shareMetaTags')--}}
{{--    <x-posts.PostMetaTags :post="$post" />--}}
{{--@endsection--}}

@section('content')

    <div class="container">
        <bizpost></bizpost>
    </div>

@endsection
