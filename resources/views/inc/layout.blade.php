<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ url('img/favicon.jpg') }}">

        <title>{{ $seoData->title ?? 'Masara Design' }}</title>
        <meta name="description" content="{{ $seoData->description ?? 'Masara Design' }}">
        <link rel="canonical" href="{{ $seoData->canonical ?? url('') }}" />
        <meta name="keywords" content="{{ $seoData->keywords ?? url('') }}">
        <meta property="og:locale" content="ro_RO" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $seoData->title ?? 'Masara Design' }}" />
        <meta property="og:description" content="{{ $seoData->description ?? 'Masara Design' }}" />
        <meta property="og:url" content="{{ $seoData->url ?? url('') }}" />
        <meta property="og:site_name" content="Mese Lemn Masiv - Masara" />
        @if(isset($seoData->image) && !empty($seoData->image))
        <meta property="og:image" content="{{ $seoData->image }}" />
        <meta property="og:image:secure_url" content="{{ $seoData->image }}" />
{{--        <meta property="og:image:width" content="1000" />--}}
{{--        <meta property="og:image:height" content="1000" />--}}
        <meta property="og:image:alt" content="{{ 'Image '.$seoData->title }}" />
        <meta property="og:image:type" content="image/jpeg" />
        @endif


        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('inc.tracking')

        @yield('styles')

        <link rel="stylesheet" href="{!! asset('css/global.css') !!}">


    </head>
    <body>
        @include('inc.menu')

        @yield('content')

        @include('inc.footer')

        @include('inc.messages_modal')

        @include('inc.bottom')

    </body>
</html>
