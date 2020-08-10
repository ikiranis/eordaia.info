@extends('layouts.app')

@section('siteTitle')
    {{ $post->title }}
@endsection

@section('shareMetaTags')
    <x-posts.PostMetaTags :post="$post" />
@endsection

@section('content')

    <div class="container">

        <x-posts.SinglePost :post="$post" />

    </div>

@endsection
