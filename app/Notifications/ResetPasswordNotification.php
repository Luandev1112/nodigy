<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $token;

    public function __construct($data)
    {
         $this->token = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    
    public function toMail($notifiable)
    {       
        $resetUrl=route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);        
        
        $appName = (env('MAIL_FROM_NAME')) ? env('MAIL_FROM_NAME') : "aaavalidator";
        $siteUrl = config('app.url', 'https://aaavalidator.com');

        $subject = "Reset Password - ".$appName;
            
        $userData['subject'] = $subject;
        $userData['appName'] = $appName;
        $userData['siteUrl'] = $siteUrl;
        $userData['resetUrl'] = $resetUrl;
        
        $user = User::select('name')->where('email',$notifiable->getEmailForPasswordReset())->first();        
        
        return (new MailMessage)->subject($subject)->view('emails.reset_template', ['userData' => $userData]);
    }
}