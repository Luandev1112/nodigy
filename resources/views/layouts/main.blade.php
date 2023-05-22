@php
$nameUrl = Request::route()->getName();
$bodyAddClass = "";
if(in_array($nameUrl,['dashboard'])){
    $bodyAddClass = 'dashboard';
}
@endphp

@include('main_include.header')
<div class="wrapper {{$bodyAddClass}}">
    @include('main_include.sidebar')
    <div class="wrapper-content">
        @include('main_include.topbar')
        @yield('content')
    </div>
</div>
@include('main_include.footer')