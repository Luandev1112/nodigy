<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Carbon\Carbon;
use App\Models\User;
use Exception;

use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DashboardController extends Controller
{    
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {        
        $loginUser = FacadesAuth::user();

        return view('dashboard.index',compact(
            'loginUser',
        ));
    }    

    public function getUser(Request $request)
    {
        try {
            $loginUser = FacadesAuth::user();
            if($loginUser){
                $loginUser->access_token = FacadesAuth::user()->createToken('MyToken')->accessToken;
                return response()->json($loginUser, 200);  
            }else{
                $result = array();
                $result['error'] = "Authentication error";
                return response()->json($result, 401);
            }
        } catch (Exception $e) {
            //throw $th;
            $result = array();
            $result['error'] = "Authentication error";
            return response()->json($result, 401);
        }
    }

    public function getTestUser(Request $request)
    {
        $testUser = User::findOrFail(1);
        return response()->json($testUser, 200);

    }
}
