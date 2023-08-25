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

use App\Http\Resources\UserResource;

use App\Helpers\MailerFactory;

class PassportAuthController extends BaseController
{
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('guest');
        $this->mailer = $mailer;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation failed', $validator->errors(),422);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])
            ->where('status', User::ACTIVE)
            ->where('role_type',User::USER)
            ->first();
        if ($user && password_verify($credentials['password'], $user->password))
        {
            $accessToken = $user->createToken('MyApp')->accessToken;
            if ($accessToken)
            {
                $success = [
                    'access_token' => $accessToken,
                    'user' => new UserResource($user)
                ];
                return $this->sendResponse($success, 'User login successfully.');
            }else{
                return $this->sendError('Error', ['error'=>'You could not be login. Please try again.']);
            }
        }

        return $this->sendError('Error', ['error' => 'Invalid Email or Password']);
    }

    public function details(Request $request) {
        $loginUser = $request->user;
        if(empty($loginUser)){
            return $this->sendError('Error', ['error'=>'User not found, Please try again'],404);
        }
        $success = new UserResource($loginUser);
        return $this->sendResponse($success, 'User details');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            Rule::unique('users')->where(function($query) use($request){
                return $query->where('role_type',User::USER)->where('is_verify',1)->where('email',$request->email);
            })],
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }

        $user = User::where('email', $request->email)->where('role_type',User::USER)->first();
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
            $userData = array(
                'email' => $user->email,
                'otp_code' => $user->otp_code,
            );
            $this->mailer->sendRegisterOtpEmail($userData);

            return $this->sendResponse('Success', 'code sent to your registered email address. check your email address!');
        }else{
            return $this->sendError('Error', ['error'=>'You could not be sign up. Please try again.']);
        }
    }

    public function verifyOtpAuthentication(Request $request)
    {
        $rules = array(
            'otp_code' => 'required|numeric|digits:5',
            'register_email' => 'required|email',
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{

            $nowTime = Carbon::now()->timestamp;

            $register_email = $request->register_email;

            $user = User::where('email', $register_email)
                ->where('otp_code', $request->otp_code)
                ->where('role_type',User::USER)
                ->first();

            if(isset($user->id) && $user->otp_code)
            {
                if($user->otp_valid_time > $nowTime)
                {
                    $user->status = User::ACTIVE;
                    $user->is_verify = true;
                    $user->otp_code = null;
                    $user->otp_valid_time = null;
                    $user->email_verified_at = date('Y-m-d H:i:s');

                    if($user->save())
                    {
                        return $this->sendResponse('Success', 'Your email address has been successfully verified');
                    }else{
                        return $this->sendError('Error', ['error'=>'Something went wrong please try again']);
                    }
                }else{
                    return $this->sendError('Error', ['error'=>'Your code has timed out, Please resend code.']);
                }
            }else{
                return $this->sendError('Error', ['error'=>'Code is incorrect. Please re-enter or resend code.']);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong please try again']);
    }

    public function resendOtpAuthentication(Request $request){
        $rules = array(
            'register_email' => 'required|email',
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return $this->sendError('Validation failed', $validator->errors(),422);
        }else{
            $register_email = $request->register_email;

            $user = User::where('email', $register_email)
                ->where('status', User::INACTIVE)
                ->where('role_type',User::USER)
                ->first();

            if(isset($user->id))
            {
                $otp_code = getOtpCodeUser();
                $user->otp_code = $otp_code;
                $user->otp_valid_time = Carbon::now()->addMinutes(2)->timestamp;

                if($user->save())
                {
                    $userData = array(
                        'email' => $user->email,
                        'otp_code' => $user->otp_code,
                    );
                    $this->mailer->sendRegisterOtpEmail($userData);

                    return $this->sendResponse('Success', 'Code resend successfully!');
                }else{
                    return $this->sendError('Error', ['error'=>'The code is not sent, please try again.']);
                }
            }else{
                return $this->sendError('Error', ['error'=>'User information was not found! Please try again.']);
            }
        }
        return $this->sendError('Error', ['error'=>'Something went wrong please try again']);
    }
}