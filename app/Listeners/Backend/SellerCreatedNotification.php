<?php

namespace App\Listeners\Backend;

use App\Events\Backend\SellerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SellerCreatedNotification
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
     * @param  CheckMatchesForSeller  $event
     * @return void
     */
    public function handle(SellerCreated $event)
    {
         //print_r($event->user->toArray());exit;
        \Log::info('Seller Created on '.$event->user->created_at.' by '. auth()->user()->full_name);
        
        $locale = \App::getLocale();
        $email_content = '';
        $sms_content = '';

        if($event->user->hasRole('testuser')){
          $msg_username = $event->user->first_name." ".live_dev_site_status();            
        }else{
          $msg_username = $event->user->full_name;
        }
        $msg_content = "Hi ".$msg_username.",";
        $wappsms_content = "Hi ".$msg_username.",";

        $email_template = get_email_template('SELLER CREATED');
        \App\EmailTemplate::where('title', 'SELLER CREATED')->increment('sent');
        if($email_template){
          $upload_stock_link = '<a href="'.$event->user->seller_url.'">'.$event->user->seller_url.'</a>';

          $email_content = 'King [username] [env] [role],';
			    $sms_content = 'King [username] [env] [role],';
          if($locale == 'pl'){
            $email_content .= $email_template->email_content_pl;
            $sms_content .= $email_template->sms_content_pl;
          }else{
            $email_content .= $email_template->email_content;
            $sms_content .= $email_template->sms_content;
          }
          
          $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
          $email_content = str_replace("[role]", 'seller', $email_content);
          $email_content = $msg_content.str_replace("[name]", $event->user->full_name, $email_content);
          $email_content = str_replace("[email]", $event->user->email, $email_content);
          $email_content = str_replace("[password]", $event->user->password, $email_content);
          $email_content = str_replace("[first_name]", $event->user->first_name, $email_content);
          $email_content = str_replace("[phone]", (substr(trim($event->user->phone),0,1) != '+' ? '+' : '').$event->user->phone, $email_content);
          $email_content = str_replace("[upload_stock_link]", $upload_stock_link, $email_content);

          $email_content = str_replace("[unsubscribe]", "", $email_content);

          $mail = $event->user->email;
          \Mail::send('frontend.mail.general', ['email_content' => $email_content, 'uuid'=>$event->user->uuid], function ($message) use ($email_template, $mail) {
              $message->subject($email_template->subject);
              $message->to($mail);
          });

          $sms_content = str_replace("[env]", env('APP_ENV'), $sms_content);
          $sms_content = str_replace("[role]", 'seller', $sms_content);
          $sms_content = $wappsms_content.str_replace("[name]", $event->user->name, $sms_content);
          $sms_content = str_replace("[email]", $event->user->email, $sms_content);
          $sms_content = str_replace("[password]", $event->user->password, $sms_content);
          $sms_content = str_replace("[phone]", (substr(trim($event->user->phone),0,1) != '+' ? '+' : '').$event->user->phone, $sms_content);
          $sms_content = str_replace("[upload_stock_link]", $event->user->seller_url, $sms_content);

          $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', auth()->user()->uuid);
            
          $sms_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $sms_content);

           if(isset($user->whatsapp_subscription) ==1){ 

              SendWhatsapp(['phone' => @$event->user->phone, 'body' => $sms_content,'is_PDF'=>false]);
            }
          SendSMS(@$event->user->phone,$sms_content);
       }else{
        \Log::info('Email template "SELLER CREATED" not exist ');         
       }
    }
}
