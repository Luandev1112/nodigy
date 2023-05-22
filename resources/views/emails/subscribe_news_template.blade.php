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
<div style="background:url({{asset('/')}}email-img/emailbg.jpg) center no-repeat; background-size:cover; display:flex; max-width:640px; margin:0 auto;">
    <div  style="width:50px; height:100%;"></div>
    <div style="width:calc(100% - 100px);">
        <div style="height:50px;"></div>
        <div style="height:76px; margin-bottom:30px;"><img src="{{asset('/')}}email-img/logo.svg" /></div>
        <div style="font-family:arial; font-weight:bold; font-size: 50px; line-height: 55px; color:#95ADFF; margin-bottom:30px;">Just one more <br />thing to do</div>
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">Click the big confirm button to subscribe to {{$userData['appName']}}. If you don’t confirm, you won’t receive our news updates.</p>
        
        <div style="margin-bottom:40px;">
            @if(isset($userData['verify_link']) && $userData['verify_link'])
            <a href="{{$userData['verify_link']}}" style="background: #5129F1; border-radius: 32px; color:#fff; padding: 16px 30px; height: 56px;font-family:arial; font-size: 16px; line-height: 24px;letter-spacing: -0.02em; text-decoration:none;"><svg width="16" height="16" viewBox="0 0 16 16" style="display:inline-block; vertical-align:middle; margin-right:6px;" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0H3.2V3.2H0V0Z" fill="#E8EDFF"/><path d="M3.2 3.2H6.4V6.4H3.2V3.2Z" fill="#E8EDFF"/><path d="M6.4 6.4H9.6V9.6H6.4V6.4Z" fill="#E8EDFF"/><path d="M9.6 3.2H12.8V6.4H9.6V3.2Z" fill="#E8EDFF"/><path d="M12.8 0H16V3.2H12.8V0Z" fill="#E8EDFF"/><path d="M3.2 9.6H6.4V12.8H3.2V9.6Z" fill="#E8EDFF"/><path d="M0 12.8H3.2V16H0V12.8Z" fill="#E8EDFF"/><path d="M9.6 6.4H12.8V9.6H9.6V6.4Z" fill="#E8EDFF"/><path d="M12.8 6.4H16V9.6H12.8V6.4Z" fill="#E8EDFF"/><path d="M3.2 6.4H6.4V9.6H3.2V6.4Z" fill="#E8EDFF"/><path d="M0 6.4H3.2V9.6H0V6.4Z" fill="#E8EDFF"/><path d="M6.4 9.6H9.6V12.8H6.4V9.6Z" fill="#E8EDFF"/><path d="M6.4 12.8H9.6V16H6.4V12.8Z" fill="#E8EDFF"/><path d="M9.6 9.6H12.8V12.8H9.6V9.6Z" fill="#E8EDFF"/><path d="M12.8 12.8H16V16H12.8V12.8Z" fill="#E8EDFF"/><path d="M6.4 3.2H9.6V6.4H6.4V3.2Z" fill="#E8EDFF"/><path d="M6.4 0H9.6V3.2H6.4V0Z" fill="#E8EDFF"/></svg> <strong>Confirm subscription now</strong>
            </a>
            @endif
        </div>
        
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">Makes sure you add this email address (noreplay@nodigy.com) to your address book. This way you won’t miss a single news updates.</p>
        <div style="height:2px; background: #333333; margin-bottom:30px;"></div>
        <div style="margin-bottom:30px;font-family:arial; font-size: 26px; line-height: 28px; color: #95ADFF; font-weight:bold;">Invite your friends to subscribe</div>
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
        <p style="font-family:arial; font-weight:bold; font-size: 16px; line-height: 20px; color:#ffffff; margin-bottom:20px;">Help</p>
        <p style="font-family:arial; font-weight:bold; font-size: 16px; line-height: 20px; color:#ffffff; margin-bottom:20px;">Unsubscribe</p>
        <p style="font-family:arial; font-size: 17px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">By subscribing you agree with {{$userData['appName']}}  <a href="{{$userData['siteUrl']}}" style="color:#29F1E5;">Terms</a> and conditions <a href="{{$userData['siteUrl']}}" style="color:#29F1E5;">Privacy Policy</a>. You’re not yet subscribed, if you didn’t request this you can ignore this message</p>
        <p style="margin-bottom:10px;"><img src="{{asset('/')}}email-img/footer-logo.png" style="width:90px;"/></p>
        <p style="font-family:arial; font-weight:normal; font-size: 14px; line-height: 20px; color:#96A3BE; margin-bottom:0;">©{{date('Y')}} {{$userData['appName']}} All rights  reserved.</p>
        <div style="height:50px;"></div>
    </div>
    <div  style="width:50px; height:100%;"></div>
</div>
</body>
</html>