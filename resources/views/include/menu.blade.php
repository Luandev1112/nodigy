@php
$prefixUrl1="";
if(!request()->is('/')){
    $prefixUrl1 = asset('/');
}
@endphp
<header class="nav-container">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('/')}}img/logo.svg" alt="" /></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{route('web3projects')}}">WEB3 Projects</a></li>
                    <li><a role="link" aria-disabled="true">Run Node<span>Coming soon</span></a></li>
                    <li>
                        @if(Auth::user())
                        <a href="#">Delegate</a>
                        @else
                        <a href="{{route('login')}}">Delegate</a>
                        @endif
                    </li>
                    <li><a href="{{ $prefixUrl1 }}#roadmap" class="scrolllink">Roadmap</a></li>
                    <li><a href="{{route('faq')}}">FAQ</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                </ul>
            </div>
            <div class="header-right">
                @if(Auth::user())
                <div class="login">
                    <a href="{{route('logout')}}">Logout</a>
                </div>
                @else
                <div style="width: 57px;" class="login"><a href="{{route('login')}}">Sign In</a></div>
                <div class="signup"><a href="{{route('register')}}" class="btn btn-primary">Sign Up</a></div>
                @endif
            </div>
        </div>
    </nav>
</header>