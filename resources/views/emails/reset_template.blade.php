<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $userData['subject'] }}</title>
</head>
<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <div style="border-bottom:1px solid #eee;text-align: center;">
                @if(isset($userData['siteUrl']) && isset($userData['appName']) && $userData['siteUrl'])
                    <a href="{{$userData['siteUrl']}}" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                        {{$userData['appName']}}
                    </a>
                @endif
            </div>
            <p style="font-size:1.1em">Hello!</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <div style="text-align: center;margin:auto;">
               @if(isset($userData['resetUrl']) && $userData['resetUrl'])
                 <a href="{{$userData['resetUrl']}}" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px; color: #fff; display: inline-block; overflow: hidden; text-decoration: none; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px solid #2d3748;text-align: center;margin: auto;">Reset your Password</a>
               @endif
            </div>
            
            <p>This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
            
            <p style="font-size:0.9em;">Regards,<br />
                @if(isset($userData['appName']) && $userData['appName'])
                    {{$userData['appName']}}
                @endif
            </p>
            <hr style="border:none;border-top:1px solid #eee" />
            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300"></div>
        </div>
    </div>    
</body>
</html>