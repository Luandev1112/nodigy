<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator,Response;
use Carbon\Carbon;

use App\User;

use App\Helpers\MailerFactory;
   
class PassportAuthController extends BaseController
{
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('guest');
        $this->mailer = $mailer;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            Rule::unique('users')->where(function($query) use($request){
                return $query->where('is_verify',1)->where('email',$request->email);
            })],
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();
        if(!isset($user->id)){
            $user = new User();
        }
        $otp_code = getOtpCodeUser();
        $user->name = "";
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = User::INACTIVE;
        $user->role_type = 2;
        $user->otp_code = $otp_code;
        $user->otp_valid_time = Carbon::now()->addMinutes(2)->timestamp;
        if($user->save())
        {       
            return $this->sendResponse('Success', 'code sent to your registered email address. check your email address!');
        }else{
            return $this->sendError('Error', ['error'=>'You could not be sign up. Please try again.']);
        }
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
