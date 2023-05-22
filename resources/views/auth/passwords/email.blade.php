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
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="container-fluid">
        <div class="otp-graybox">
            <h3>Need help with your account?</h3>
            <p class="subtext">Enter your email and we'll send you a link to get back into your account.</p>
            <div class="form-group">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Send Link" />
            </div>
            {{-- <div class="forgotpwd"><a href="javascript:void(0)">Forgot your email?</a></div> --}}
        </div>
    </div>
</form>
<div class="signin-bottom">
    <a href="#">Privacy Policy</a>
    <span>Copyright {{date('Y')}}</span>
</div>
@endsection