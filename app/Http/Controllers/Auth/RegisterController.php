<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Validator,Redirect,Response,Session;
use Carbon\Carbon;

use App\User;
use Auth;

use App\Helpers\MailerFactory;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    protected $mailer;

    public function __construct(MailerFactory $mailer)
    {
        $this->middleware('guest');
        $this->mailer = $mailer;
    }
    public function index()
    {
        session()->put('register_email',"");
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {        
        $rules = array(
            'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            Rule::unique('users')->where(function($query) use($request){
                return $query->where('role_type',User::USER)->where('is_verify',1)->where('email',$request->email);
            })],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',            
            'is_agree' => 'accepted',
        );        
        $request->validate($rules);
        
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
            session()->put('register_email', $user->email);
            
            $userData = array(
                'email' => $user->email,
                'otp_code' => $user->otp_code,
            );
            $this->mailer->sendRegisterOtpEmail($userData);

            return redirect("otp-authentication")->with('success', 'code sent to your registered email address. check your email address!');
        }else{
            return redirect("register")->with('error', 'You could not be sign up. Please try again.');
        }        
    }
    public function otpAuthentication()
    {
        $register_email = session()->get('register_email',"");
        $user = User::where('email', $register_email)->first();
        if(isset($user->id)){
            return view('auth.otp_authentication',compact('user'));
        }else{
            return redirect("register");            
        }
    } 
    public function verifyOtpAuthentication(Request $request)
    {    
        if($request->ajax()) {
            $rules = array(                
                'otp_code' => 'required|numeric|digits:5',
            );
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                $result = ['status' => false, 'errors' => $validator->errors()];
            }else{
                
                $nowTime = Carbon::now()->timestamp;
                
                $register_email = session()->get('register_email',"");
                $user = User::where('email', $register_email)->where('otp_code', $request->otp_code)->where('role_type',User::USER)->first();
                if(isset($user->id) && $user->otp_code)
                {
                    if($user->otp_valid_time > $nowTime)
                    {
                        $user->status = User::ACTIVE;
                        $user->is_verify = true;
                        $user->otp_code = null;
                        $user->otp_valid_time = null;
                        $user->email_verified_at = date('Y-m-d H:i:s');
                        if($user->save()){
                            Auth::login($user,false); // remember = true/false;
                            session()->put('register_email',"");
                            $result = ['status' => true, 'message' => 'you sign up successfully!'];
                        }else{
                            $result = ['status' => false, 'message' => 'You could not be sign up. Please try again.'];
                        }
                    }else{
                        $result = ['status' => false, 'message' => 'Your code has timed out, Please click the link Resend Code.'];
                    }
                }else{
                    $result = ['status' => false, 'message' => 'Code is incorrect. Please re-enter or click the link Resend Code.'];                    
                }
            }            
            return response()->json($result);die();
        }
        return redirect("/");        
    }   
    public function resendOtpAuthentication(Request $request){
        if($request->ajax()) {
            $register_email = session()->get('register_email',"");
            $user = User::where('email', $register_email)->where('role_type',User::USER)->first();
            if(isset($user->id))
            {                
                $otp_code = getOtpCodeUser();                
                $user->otp_code = $otp_code;
                $user->otp_valid_time = Carbon::now()->addMinutes(2)->timestamp;

                if($user->save()){
                    $userData = array(
                        'email' => $user->email,
                        'otp_code' => $user->otp_code,
                    );
                    $this->mailer->sendRegisterOtpEmail($userData);

                    $result = ['status' => true, 'message' => 'Code resend successfully!'];
                }else{
                    $result = ['status' => false, 'message' => 'The code is not sent, please try again.'];
                }
            }else{
                $result = ['status' => false, 'message' => 'User information was not found! Please try again.']; 
            }
            return response()->json($result);die();
        }
        return redirect("/");
    }
}