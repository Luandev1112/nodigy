@extends('layouts.login')

@section('content')
<div class="signinheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{asset('/')}}img/logo.svg" /></a></div>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('login') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="container-fluid">
        <div class="otp-graybox">
            <h3>Reset Password</h3>
            <div class="form-group">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <a tabindex="-1" href="javascript:void(0);" class="showpwd" id="password-addon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="password_hide"><path d="M3 3L21 21" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.584 10.587C10.2087 10.962 9.99775 11.4708 9.99756 12.0013C9.99737 12.5318 10.2079 13.0407 10.583 13.416C10.958 13.7913 11.4667 14.0022 11.9973 14.0024C12.5278 14.0026 13.0367 13.792 13.412 13.417" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.363 5.365C10.2204 5.11972 11.1082 4.99684 12 5C16 5 19.333 7.333 22 12C21.222 13.361 20.388 14.524 19.497 15.488M17.357 17.349C15.726 18.449 13.942 19 12 19C8 19 4.667 16.667 2 12C3.369 9.605 4.913 7.825 6.632 6.659" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="password_show">
                    <path d="M6.63207 7.65879C7.45974 7.09739 9.00007 5.99979 12.0001 5.99979C16.0001 5.99979 19.3331 8.33281 22.0001 12.9998C20.9971 14.4878 20.4971 15.4878 19.4971 16.4878M19.4971 16.4878C17.9971 17.9878 13.9421 19.9998 12.0001 19.9998C8.00007 19.9998 4.66707 17.6668 2.00007 12.9998C3.36907 10.6048 4.91307 8.82479 6.63207 7.65879" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="13" r="2.25" stroke="#718096" stroke-width="1.5"/>
                    </svg>

                </a>                    
                <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="form-group">
                <a tabindex="-1" href="javascript:void(0);" class="showpwd" id="conf-password-addon">                        
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="conf_password_hide"><path d="M3 3L21 21" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.584 10.587C10.2087 10.962 9.99775 11.4708 9.99756 12.0013C9.99737 12.5318 10.2079 13.0407 10.583 13.416C10.958 13.7913 11.4667 14.0022 11.9973 14.0024C12.5278 14.0026 13.0367 13.792 13.412 13.417" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.363 5.365C10.2204 5.11972 11.1082 4.99684 12 5C16 5 19.333 7.333 22 12C21.222 13.361 20.388 14.524 19.497 15.488M17.357 17.349C15.726 18.449 13.942 19 12 19C8 19 4.667 16.667 2 12C3.369 9.605 4.913 7.825 6.632 6.659" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="conf_password_show">
                    <path d="M6.63207 7.65879C7.45974 7.09739 9.00007 5.99979 12.0001 5.99979C16.0001 5.99979 19.3331 8.33281 22.0001 12.9998C20.9971 14.4878 20.4971 15.4878 19.4971 16.4878M19.4971 16.4878C17.9971 17.9878 13.9421 19.9998 12.0001 19.9998C8.00007 19.9998 4.66707 17.6668 2.00007 12.9998C3.36907 10.6048 4.91307 8.82479 6.63207 7.65879" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="13" r="2.25" stroke="#718096" stroke-width="1.5"/>
                    </svg>

                </a>                    
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Reset Password" />
            </div>

        </div>
    </div>
</form>
<div class="signin-bottom">
    <a href="#">Privacy Policy</a>
    <span>Copyright {{date('Y')}}</span>
</div>
@endsection