<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Validator') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('/')}}img/favicon.png">
    <meta name="description"  content="" />
    <meta name="keywords"  content="" />
    
    <link href="{{asset('/')}}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/owl.carousel.min.css?{{time()}}" rel="stylesheet">
    <link href="{{asset('/')}}css/jquery.toast.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/style.css?{{time()}}" rel="stylesheet">
    <link href="{{asset('/')}}css/custom.css?{{time()}}" rel="stylesheet">
    
    <script src="{{asset('/')}}js/jquery.min.js"></script>
    <script src="{{asset('/')}}js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}js/owl.carousel.min.js?{{time()}}"></script>
    <script src="{{asset('/')}}js/jquery.toast.min.js"></script>
    <script src="{{asset('/')}}js/main.js?{{time()}}"></script>
    <script src="{{asset('/')}}js/custom.js?{{time()}}"></script>

    @yield('css')
</head>