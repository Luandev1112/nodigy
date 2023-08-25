<?php
if (! function_exists('pr')) {
    function pr($data){
        echo "<pre>";
        print_r($data);
        exit();
    }
}
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
if (! function_exists('viewBalanceFormatted')) {
    function viewBalanceFormatted($balance = 0){
        return ($balance)? number_format($balance, 2, '.', ','):0;
    }
}
if (! function_exists('getDateFormateView')) {
    function getDateFormateView($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    }
}
if (! function_exists('getDateFormateViewRu')) {
    function getDateFormateViewRu($date){
        $day = date('d', strtotime($date));
        $month = getMonthNameRu(date('m', strtotime($date)));
        $year = date('Y', strtotime($date));
        return $day." ".$month." ".$year;
    }
}
if (!function_exists('getMonthNameRu')) {
    function getMonthNameRu($month)
    {
        $monthName=array('01'=>'Январь','02'=>'Февраль','03'=>'Март','04'=>'Апрель','05'=>'Май','06'=>'Июнь',
                        '07'=>'Июль','08'=>'Август','09'=>'Сентябрь','10'=>'Октябрь','11'=>'Ноябрь','12'=>'Декабрь');
        return (isset($monthName[$month]))? $monthName[$month] : $month;
    }
}
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
if (!function_exists('getErrorMessage')) {
    function getErrorMessage($e, $customMsg = null)
    {
        if ($customMsg != null) {
            return $customMsg;
        }
        if (env('APP_DEBUG')) {
            return $e->getMessage() . $e->getLine();
        } else {
            return "something went wrong please try again";
        }
    }
}
if (!function_exists('getSettingBySlug')) {
    function getSettingBySlug($slug = "")
    {
        $tmp['slug'] = "";
        $tmp['label'] = "";
        $tmp['content'] = "";
        if($slug){
            $settingRow = App\Models\Setting::where('slug',$slug)->first();
            if(isset($settingRow->id)){
                $tmp['slug'] = ($settingRow->slug)? $settingRow->slug:'';
                $tmp['label'] = ($settingRow->label)? $settingRow->label:'';
                $tmp['content'] = ($settingRow->content)? $settingRow->content:'';
            }
        }
        return $tmp;
    }
}
if (!function_exists('convertEuroToUSDT')) {
    function convertEuroToUSDT($euroPrice,$usdtPrice)
    {
        if ($euroPrice && $usdtPrice) {
            return sprintf("%.2f", (ceil($euroPrice * $usdtPrice * 100) / 100));
            //return sprintf("%.2f",($euroPrice * $usdtPrice));
        } else {
            return 0;
        }
    }
}
?>