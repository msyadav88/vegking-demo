<?php

namespace App\Listeners\Backend;

use App\Events\Backend\BuyerSellerImported;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

//class SendSellerImportedEmail
class SendBuyerSellerImportedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered $event
     * @return void
     */
    //public function handle(SellerImported $event )
    public function handle(BuyerSellerImported $event )
    {
        if( ! isset( $event->email_details['content'] ) || $event->email_details['content'] == '' ){
            $email_content = 'Welcome to our website. ';
        }else{
            $email_content = $event->email_details['content'];
        }
        if( ! isset( $event->email_details['subject'] ) || $event->email_details['subject'] == '' ){
            $email_subject = 'Welcome to our website.';
        }else{
            $email_subject = $event->email_details['subject'];
        }
            \Log::info('Seller Imported BY admin '.'Email verification');
            $email_address = $event->user->email;
        try{
            Mail::send('frontend.mail.registration_mail', ['user'=> $event->user, 'email_content' => $email_content, 'subject' => $email_subject], function ($message) use ($email_address,$email_subject) {
            $message->subject( $email_subject );
            $message->to($email_address)->cc("sukanyasoftwares@sukanyasoftwares.com");
          });
            $err = 0;
            $msg = "success";
        }catch(\Exception $ex){
             //echo "IN exception message ".$e->message;
            $err = 1;
             $msg = $ex->getMessage();
            //return $e->message;
        }
        
        return ['warn'=>$err, 'msg'=>$msg];
    }
}
