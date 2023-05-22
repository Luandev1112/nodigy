@php
$nameUrl = Request::route()->getName();
$bodyAddClass = "";
if(in_array($nameUrl,['otp-authentication'])){
    $bodyAddClass = 'verifypwdpage';
}else if(in_array($nameUrl,['password.request','password.reset','password.confirm'])){
    $bodyAddClass = 'forgotpwdpage';
}
@endphp
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
    <link href="{{asset('/')}}css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/style.css?{{time()}}" rel="stylesheet">
    <link href="{{asset('/')}}css/jquery.toast.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/custom.css?{{time()}}" rel="stylesheet">
    
    @yield('css')
    
    <script src="{{asset('/')}}js/jquery.min.js"></script>
    <script src="{{asset('/')}}js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}js/owl.carousel.min.js"></script>
    <script src="{{asset('/')}}js/main.js?{{time()}}"></script>
    <script src="{{asset('/')}}js/jquery.toast.min.js"></script>
    <script src="{{asset('/')}}js/custom.js?{{time()}}"></script>
            
</head>
<body class="signin {{$bodyAddClass}}">
    
    @yield('content')

    <div class="signin-bottom footer-mobile">
        <a href="#">Privacy Policy</a>
        <span>Copyright {{date('Y')}}</span>
    </div>

    @if(Session::has('status'))
        <script type="text/javascript">
            showToastMessage("success","{{ Session::get('status') }}");
        </script>    
        @php Session::forget('status') @endphp
    @endif
    @if(Session::has('success'))
        <script type="text/javascript">
            showToastMessage("success","{{ Session::get('success') }}");
        </script>
        @php Session::forget('success') @endphp
    @endif
    @if(Session::has('error'))
        <script type="text/javascript">
            showToastMessage("error","{{ Session::get('error') }}");
        </script>
        @php Session::forget('error') @endphp
    @endif
    @if(Session::has('warning'))
        <script type="text/javascript">
            showToastMessage("warning","{{ Session::get('warning') }}");
        </script>
        @php Session::forget('warning') @endphp
    @endif

    @yield('js')

    @yield('pagejs')
</body>
</html>