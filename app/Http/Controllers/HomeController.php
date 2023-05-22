<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{    
    public function index()
    {        
        return view('home');
    }
    public function about()
    {        
        return view('about');
    }
    public function faq()
    {        
        return view('faq');
    }
    public function contact()
    {
        return view('contact');
    }
    public function testmail()
    {        
        // return view('faq');
        echo $fromAddress = (env('MAIL_FROM_ADDRESS')) ? env('MAIL_FROM_ADDRESS') : "";
        echo $fromName = (env('MAIL_FROM_NAME')) ? env('MAIL_FROM_NAME') : "aaavalidator";
        echo $text = "This is some email content";        

        Mail::raw($text, function ($message) use ($fromName,$fromAddress) {
            $message->from($fromAddress, $fromName)
            ->to('yiicakephp@gmail.com')
            ->subject("Email testing from Nodigy");
        });
    }
}
