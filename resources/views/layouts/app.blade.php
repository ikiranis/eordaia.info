<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" itemscope itemtype="http://schema.org/Article">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--@include('includes.favicon')--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('siteTitle')</title>

    @yield('shareMetaTags')

<!-- Styles -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

{{--    @include('feed::links')--}}

    <x-google-analytics />


</head>
<body>

<div id="app">
    <x-header />

    <main class="py-4">
        @yield('content')
    </main>
</div>

{{--Footer--}}
<x-footer />

<!-- Scripts -->
<x-runScripts />

@yield('scripts')

</body>
</html>
