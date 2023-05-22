@php
$fixAssetUrl = asset('/frontend')."/";
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{ config('app.name', 'Validator') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{$fixAssetUrl}}img/favicon.ico">
    <meta name="description"  content="" />
    <meta name="keywords"  content="" />

    <link href="{{$fixAssetUrl}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{$fixAssetUrl}}css/font-awesome.min.css" rel="stylesheet">
    <link href="{{$fixAssetUrl}}css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{$fixAssetUrl}}css/style.css" rel="stylesheet">
    <link href="{{$fixAssetUrl}}css/jquery.toast.min.css" rel="stylesheet">
    <link href="{{$fixAssetUrl}}css/custom.css?{{time()}}" rel="stylesheet">
    
    @yield('css')
    
    <script src="{{$fixAssetUrl}}js/jquery.min.js"></script>
    <script src="{{$fixAssetUrl}}js/bootstrap.min.js"></script>
    <script src="{{$fixAssetUrl}}js/owl.carousel.min.js"></script>
    <script src="{{$fixAssetUrl}}js/main.js"></script>
    <script src="{{$fixAssetUrl}}js/jquery.toast.min.js"></script>
    <script src="{{$fixAssetUrl}}js/custom.js?{{time()}}"></script>
        
</head>
<body class="darkmode">