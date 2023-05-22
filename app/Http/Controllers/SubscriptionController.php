<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
use Carbon\Carbon;

use App\Models\Subscription;
use App\User;
use Auth;

use App\Rules\ReCaptcha;
use App\Helpers\MailerFactory;

class SubscriptionController extends Controller
{    
    protected $mailer;
    public function __construct(MailerFactory $mailer)
    {
        $this->mailer = $mailer;        
    }
    
    public function emailSubscribes(Request $request)
    {    
        if($request->ajax()) {
            $rules = array(
                'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                Rule::unique('subscription')->where(function($query) use($request){
                    return $query->where('subscription_status',Subscription::VERIFIED)->where('subscribe_type',Subscription::ISEMAIL)->where('email',$request->email);
                })]
            );
            $messages = array(
                'email.unique'=>"The email has already been subscribed.",
                'email.email'=>"The email must be a valid email address.",
                'email.regex'=>"The email must be a valid email address.",
                'email.required'=>"The email field is required.",
            );
            $validator = Validator::make($request->all(), $rules,$messages);
            if($validator->fails()){
                $result = ['status' => false, 'errors' => $validator->errors()];
            }else{

                $email = $request->email;
                
                $subscription = Subscription::where('email', $request->email)->where('subscribe_type',Subscription::ISEMAIL)->first();
                if(!isset($subscription->id)){
                    $subscription = new Subscription();
                }

                $subscription->email = $request->email;
                $subscription->token = Str::random(64);
                $subscription->subscription_status = Subscription::NOTVERIFIED;
                $subscription->subscribe_type = Subscription::ISEMAIL;

                if($subscription->save()){
                    
                    $userData = array(
                        'email' => $subscription->email,
                        'verify_link' => route('verify.email.subscription', $subscription->token),
                    );
                    $this->mailer->sendSubscriptionEmail($userData);

                    $result = ['status' => true, 'message' => 'Thank you for subscribing, Please verify your email.'];
                }else{
                    $result = ['status' => false, 'message' => 'You could not be subscribed. Please try again.'];
                }
            }            
            return response()->json($result);die();
        }
        return redirect("/");        
    }

    public function verifyEmailSubscribes($token)
    {
        $subscription = Subscription::where('token', $token)->where('subscribe_type',Subscription::ISEMAIL)->first();
        $message = 'Sorry your email cannot be identified.';
        if(isset($subscription->id) && $subscription->id)
        {
            if($subscription->subscription_status == Subscription::NOTVERIFIED) {
                $subscription->email_verified_at = Carbon::now();
                $subscription->subscription_status = Subscription::VERIFIED;
                $subscription->save();
                $message = "Your e-mail is verified successfully.";
            } else {
                $message = "Your e-mail is already verified.";
            }
            return redirect('/')->with('success', $message);
        }
        return redirect('/')->with('error', $message);
    }

    public function subscribeNews(Request $request)
    {    
        if($request->ajax()) {
            $rules = array(
                'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                Rule::unique('subscription')->where(function($query) use($request){
                    return $query->where('subscription_status',Subscription::VERIFIED)->where('subscribe_type',Subscription::ISNEWS)->where('email',$request->email);
                })]
            );
            $messages = array(
                'email.unique'=>"The email has already been subscribed.",
                'email.email'=>"The email must be a valid email address.",
                'email.regex'=>"The email must be a valid email address.",
                'email.required'=>"The email field is required.",
            );
            $validator = Validator::make($request->all(), $rules,$messages);
            if($validator->fails()){
                $result = ['status' => false, 'errors' => $validator->errors()];
            }else{

                $email = $request->email;
                
                $subscription = Subscription::where('email', $request->email)->where('subscribe_type',Subscription::ISNEWS)->first();
                if(!isset($subscription->id)){
                    $subscription = new Subscription();
                }

                $subscription->email = $request->email;
                $subscription->token = Str::random(64);
                $subscription->subscription_status = Subscription::NOTVERIFIED;
                $subscription->subscribe_type = Subscription::ISNEWS;

                if($subscription->save())
                {
                    $userData = array(
                        'email' => $subscription->email,
                        'verify_link' => route('subscribe.news.verify', $subscription->token),
                    );
                    $this->mailer->sendSubscriptionEmailNews($userData);

                    $result = ['status' => true, 'message' => 'Thank you for subscribing news, Please verify your email.'];
                }else{
                    $result = ['status' => false, 'message' => 'You could not be subscribed news. Please try again.'];
                }
            }            
            return response()->json($result);die();
        }
        return redirect("/");        
    }

    public function verifysubscribeNews($token)
    {
        $subscription = Subscription::where('token', $token)->where('subscribe_type',Subscription::ISNEWS)->first();
        $message = 'Sorry your email cannot be identified.';
        if(isset($subscription->id) && $subscription->id)
        {
            if($subscription->subscription_status == Subscription::NOTVERIFIED) {
                $subscription->email_verified_at = Carbon::now();
                $subscription->subscription_status = Subscription::VERIFIED;
                $subscription->save();
                $message = "Your e-mail is verified successfully.";
            } else {
                $message = "Your e-mail is already verified.";
            }
            return redirect('/')->with('success', $message);
        }
        return redirect('/')->with('error', $message);
    }

    public function contactStore(Request $request)
    {    
        if($request->ajax()) {
            $rules = array(
                'email' => ['required','string','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'message' => 'required',
                'g-recaptcha-response' => ['required', new ReCaptcha]
            );
            $messages = array(                
                'email.email'=>"The email must be a valid email address.",
                'email.regex'=>"The email must be a valid email address.",
                'email.required'=>"The email field is required.",
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            );
            $validator = Validator::make($request->all(), $rules,$messages);
            if($validator->fails()){
                $result = ['status' => false, 'errors' => $validator->errors()];
            }else{

                $email = $request->email;
                $message = $request->message;

                if($email){
                    $userData = array(                        
                        'contact_email' => $email,
                        'contact_message' => $message,
                    );
                    $this->mailer->sendContactEmail($userData);

                    $result = ['status' => true, 'message' => 'Thank you for contact us. we will contact you shortly.'];
                }else{
                    $result = ['status' => false, 'message' => 'something went wrong please try again.'];
                }
            }            
            return response()->json($result);die();
        }
        return redirect("/");        
    }
}
