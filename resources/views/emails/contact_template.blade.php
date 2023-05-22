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
        
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">You have received a new message from the contact form on {{$userData['appName']}}. Please find the details below:</p>        
        
        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">
            Email:
            @if(isset($userData['contact_email']) && $userData['contact_email'])
                {!! $userData['contact_email'] !!}
            @endif
        </p>

        <p style="font-family:arial; font-size: 18px; line-height: 24px; color:#E8EDFF; margin-bottom:30px;">
            Message:
            @if(isset($userData['contact_message']) && $userData['contact_message'])
                {!! $userData['contact_message'] !!}
            @endif
        </p>
        
        <div style="height:2px; background: #333333; margin-bottom:30px;"></div>

        <p style="margin-bottom:10px;"><img src="{{asset('/')}}email-img/footer-logo.png" style="width:90px;"/></p>
        <p style="font-family:arial; font-weight:normal; font-size: 14px; line-height: 20px; color:#96A3BE; margin-bottom:0;">©{{date('Y')}} {{$userData['appName']}} All rights  reserved.</p>
        <div style="height:50px;"></div>
    </div>
    <div  style="width:50px; height:100%;"></div>
</div>
</body>
</html>