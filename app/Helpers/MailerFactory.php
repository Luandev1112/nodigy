<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Models\Templates;
use App\Models\Settings;

class MailerFactory
{
    protected $mailer;
    protected $fromAddress = "";
    protected $fromName = "";
    protected $appName = "";
    protected $siteUrl = "";

    /**
     * MailerFactory constructor.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;

        $this->fromAddress = (env('MAIL_FROM_ADDRESS')) ? env('MAIL_FROM_ADDRESS') : "";
        $this->fromName = (env('MAIL_FROM_NAME')) ? env('MAIL_FROM_NAME') : "aaavalidator";
        $this->appName = (env('MAIL_FROM_NAME')) ? env('MAIL_FROM_NAME') : "aaavalidator";
        $this->siteUrl = config('app.url', 'https://nodigy.com');
    }
    public function sendRegisterOtpEmail($userData)
    {
        if(isset($userData['email']) && $userData['email'])
        {
            $subject = "Please Verify Your Email Address - ".$this->appName;
            
            $userData['subject'] = $subject;
            $userData['appName'] = $this->appName;
            $userData['siteUrl'] = $this->siteUrl;
            
            try {
                Mail::send('emails.register_template',['userData' => $userData], function ($message) use ($userData) {
                    $message->from($this->fromAddress, $this->fromName)
                    ->to($userData['email'])
                    ->subject($userData['subject']);
                });
                Log::info("Register mail send done.");
            } catch (\Exception $e) {
                Log::error("Register-mail-error:" . $e->getMessage());
                return false;
            }            
        }
        return true;
    }

    public function sendSubscriptionEmail($userData)
    {
        if(isset($userData['email']) && $userData['email'])
        {            
            $subject = "Verify Your Subscription to ".$this->appName." Newsletter";
            
            $userData['subject'] = $subject;
            $userData['appName'] = $this->appName;
            $userData['siteUrl'] = $this->siteUrl;
            
            try {
                Mail::send('emails.newsletter_template',['userData' => $userData], function ($message) use ($userData) {
                    $message->from($this->fromAddress, $this->fromName)
                    ->to($userData['email'])
                    ->subject($userData['subject']);
                });
                Log::info("Newsletter mail send done.");
            } catch (\Exception $e) {
                Log::error("Newsletter-mail-error:" . $e->getMessage());
                return false;
            }            
        }
        return true;
    }

    public function sendSubscriptionEmailNews($userData)
    {
        if(isset($userData['email']) && $userData['email'])
        {
            $subject = "Verify Your Subscribe to ".$this->appName." News Updates";
            
            $userData['subject'] = $subject;
            $userData['appName'] = $this->appName;
            $userData['siteUrl'] = $this->siteUrl;
            
            try {
                Mail::send('emails.subscribe_news_template',['userData' => $userData], function ($message) use ($userData) {
                    $message->from($this->fromAddress, $this->fromName)
                    ->to($userData['email'])
                    ->subject($userData['subject']);
                });
                Log::info("Subscribe news mail send done.");
            } catch (\Exception $e) {
                Log::error("Subscribe news-mail-error:" . $e->getMessage());
                return false;
            }            
        }
        return true;
    }

    public function sendContactEmail($userData)
    {
        $userData['email'] = (env('CONTACT_MAIL_ADDRESS')) ? env('CONTACT_MAIL_ADDRESS') : "info@nodigy.com";
        if(isset($userData['email']) && $userData['email'])
        {
            $subject = "Contact Form Submission from ".$this->appName;
            
            $userData['subject'] = $subject;
            $userData['appName'] = $this->appName;
            $userData['siteUrl'] = $this->siteUrl;
            
            try {
                Mail::send('emails.contact_template',['userData' => $userData], function ($message) use ($userData) {
                    $message->from($this->fromAddress, $this->fromName)
                    ->to($userData['email'])
                    ->subject($userData['subject']);
                });
                Log::info("contact mail send done.");
            } catch (\Exception $e) {
                Log::error("contact mail-error:" . $e->getMessage());
                return false;
            }
        }else{
            Log::info("contact mail admin email not found.");
        }
        return true;
    }
}
