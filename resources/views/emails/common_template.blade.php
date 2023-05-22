<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $userData['subject'] }}</title>
</head>
<body>
    @if(isset($userData['mailMessage']) && $userData['mailMessage'])
        {!! $userData['mailMessage'] !!}
    @endif
</body>
</html>