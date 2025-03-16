<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ url('img/favicon.jpg') }}">

        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

{{--        <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="df6e613d-3403-4cda-86ca-65ad72609553" data-blockingmode="auto" type="text/javascript"></script>--}}

        <title>{{ $seoData->title ?? 'Masara Design' }}</title>
        <meta name="description" content="{{ $seoData->description ?? 'Masara Design' }}">
{{--        <link rel="canonical" href="{{ $seoData->canonical ?? url('') }}" />--}}
        <meta name="keywords" content="{{ $seoData->keywords ?? url('') }}">
        <meta property="og:locale" content="ro_RO" />
        <meta property="og:type" content="product" />
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

        <link rel="stylesheet" href="{!! mix('css/global.css') !!}">


    </head>
    <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBFGG8H7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
        @include('inc.menu')

        @yield('content')

        @include('inc.footer')

        @include('inc.messages_modal')

        @include('inc.bottom')

    </body>
</html>
