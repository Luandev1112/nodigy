<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $userData['subject'] }}</title>
<style>
*{box-sizing: border-box; -webkit-box-sizing: border-box;}
</style>
</head>
<body style="margin:0; padding:0;">
<div style="background:url({{asset('/')}}email-img/emailbg.jpg) center no-repeat #101525; background-size:cover;  display:flex; max-width:640px; margin:0 auto;">
    <div  style="width:50px; height:100%;">&nbsp;</div>
    <div style="width:calc(100% - 100px);">
        <div style="height:50px;">&nbsp;</div>
        <div style="height:76px;"><img src="{{asset('/')}}email-img/logo.svg" style="height:76px;" /></div>
        <div style="height: 30px; width:100%">&nbsp;</div>
        <div style="font-family:arial; font-weight:bold; font-size: 50px; line-height: 55px; color:#95ADFF;">Ready to become a part of WEB3?</div>
        <div style="height:30px; width:100%">&nbsp;</div>
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin: 0;">Enter your verification code</p>
        <div style="height:30px; width:100%">&nbsp;</div>
        <div style="background: rgba(81, 41, 241, 0.2); width: 480px; border-radius: 24px; font-family:arial; font-weight:bold; font-size: 52px; line-height:120px; color:#00D1FF; text-align:center;">
            @if(isset($userData['otp_code']) && $userData['otp_code'])
                {{$userData['otp_code']}}
            @endif
        </div>
        <div style="height:30px; width:100%">&nbsp;</div>
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF;margin: 0;">Hurry up this code will expire after 2 minutes</p>
        <div style="height:30px; width:100%">&nbsp;</div>
        <div style="height:2px; background: #333333;"></div>
        <div style="height:30px; width:100%">&nbsp;</div>
        <div>
            @if(isset($userData['siteUrl']))
            <a href="{{$userData['siteUrl']}}" style="background: #5129F1; border-radius: 32px; color:#fff; padding: 16px 30px; height: 56px;font-family:arial; font-size: 16px; line-height: 24px;letter-spacing: -0.02em; text-decoration:none;">Open App
            </a>
            @endif
        </div>
        <div style="height:40px; width:100%">&nbsp;</div>
        <p style="margin:0;">
            <a href="https://discord.com/" style="display:inline-block; vertical-align:middle; margin-right:20px;">
                <img src="{{asset('/')}}email-img/icon-discord.png" />
            </a>
            <a href="https://medium.com/" style="display:inline-block; vertical-align:middle; margin-right:20px;">
                <img src="{{asset('/')}}email-img/icon-medium.png" />
            </a>
            <a href="https://telegram.org/" style="display:inline-block; vertical-align:middle; margin-right:20px;">
                <img src="{{asset('/')}}email-img/icon-telegram.png" />
            </a>
            <a href="https://twitter.com/" style="display:inline-block; vertical-align:middle; margin-right:20px;">
                <img src="{{asset('/')}}email-img/icon-twitter.png" />
            </a>
        </p>
        <div style="height:20px; width:100%">&nbsp;</div>
        <p style="font-family:arial; font-weight:bold; font-size: 16px; line-height: 20px; color:#ffffff;margin:0;">Help</p>
        <div style="height:20px; width:100%">&nbsp;</div>
        <p style="margin-bottom:10px;"><img src="{{asset('/')}}email-img/footer-logo.png" style="width:90px;"/></p>
        <div style="height:10px; width:100%">&nbsp;</div>
        <p style="font-family:arial; font-weight:normal; font-size: 14px; line-height: 20px; color:#96A3BE; margin:0;">©{{date('Y')}} {{$userData['appName']}} All rights  reserved.</p>
        <div style="height:50px;">&nbsp;</div>
    </div>
    <div  style="width:50px; height:100%;">&nbsp;</div>
</div>
</body>
</html>