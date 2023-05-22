<?php
if (! function_exists('stringToSecret')) {
	function stringToSecret($email)
	{
		$parts = explode('@', $email);
		$parts_1 = explode('.',$parts[1]);
		return (substr($parts[0], 0,2) . str_replace($parts[0], '******', $parts[0]) . '@' .$parts_1[0]. ".".$parts_1[1]);
	}
}
if (! function_exists('getEmailToName')) {
    function getEmailToName($email)
    {
        return ($email)? substr($email, 0, strpos($email, '@')):"";
    }
}
if (! function_exists('getOtpCodeUser')) {
    function getOtpCodeUser(){        
        $otp_code = rand(10000, 99999);        
        while (true){
            $user = App\User::where('otp_code', $otp_code)->first();
            if(!isset($user->id)){
                return $otp_code;exit();
            }
            $otp_code = rand(10000, 99999);
        }
        return rand(10000, 99999);
    }
}
?> 