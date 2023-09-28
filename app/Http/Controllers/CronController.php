<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Services\HetznerApiService;

class CronController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function scriptName($slug = "")
    {
        Log::debug("Run-cron-script".date('Y-m-d H:s:i'));

        if($slug=="createsshkey"){
            $this->createsshkey();
        }

        Log::debug("end-cron-script".date('Y-m-d H:s:i'));
        echo "scrip run done";exit();
    }

    public function createsshkey()
    {
        $userId = 121;
        $loginUser = User::where('id',$userId)->first();
        if(!$loginUser->ssh_key_id){
            $service = new HetznerApiService;
            $apiResponse = $service->createSshKey($loginUser->id);
            if(isset($apiResponse['ssh_key']['id']) && $apiResponse['ssh_key']['id']){
                $loginUser->ssh_key_id = $apiResponse['ssh_key']['id'];
                $loginUser->ssh_public_key = (isset($apiResponse['ssh_key']['public_key']))? $apiResponse['ssh_key']['public_key']:"";
                $loginUser->save();
            }
            dd($apiResponse);
        }
        echo "Done";exit;
    }
}
