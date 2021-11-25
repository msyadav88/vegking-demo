<?php

namespace App\Listeners\Backend;

// use App\Events\Backend\BuyerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BuyerCreatedNotification
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
     * @param  CheckMatchesForBuyer  $event
     * @return void
     */
    public function handle($event)
    {
      // echo $event->buyer_user->name;exit;
        \Log::info('Buyer Created on '.$event->buyer->user->created_at.' by '. auth()->user()->full_name);
        // app('App\Http\Controllers\Backend\BuyerController')->buyerCreatedNotification($event->buyer);
        $locale = \App::getLocale();
        $email_content = '';
        $sms_content = '';
        $email_content = 'King [username] [env] [role],';
        $sms_content = 'King [username] [env] [role],';
        if($event->buyer->user->hasRole('testuser')){
          $msg_username = $event->buyer->user->first_name." ".live_dev_site_status();            
        }else{
          $msg_username = $event->buyer->user->first_name;
        }
        $msg_content = "Hi ".$msg_username.",";
        $wappsms_content = "Hi ".$msg_username.",";


        $email_template = get_email_template('BUYER CREATED');
        \App\EmailTemplate::where('title', 'BUYER CREATED')->increment('sent');
        if($email_template){
          // $country_name = country_list()->toArray();
          // $country = $country_name[$event->buyer->user->country];

          if($locale == 'pl'){
            $email_content .= $email_template->email_content_pl;
            $sms_content = $email_template->sms_content_pl;
          }else{
            $email_content .= $email_template->email_content;
            $sms_content = $email_template->sms_content;
          }
          $email_content = str_replace("[env]", env('APP_ENV'), $email_content);
          $email_content = str_replace("[role]", 'buyer', $email_content);
          $email_content = $msg_content.str_replace("[name]", $event->buyer->user->name, $email_content);
          $email_content = str_replace("[email]", $event->buyer->user->email, $email_content);
          $email_content = str_replace("[password]", $event->password, $email_content);
          $email_content = str_replace("[phone]", (substr(trim($event->buyer->user->phone),0,1) != '+' ? '+' : '').$event->buyer->user->phone, $email_content);
          // $email_content = str_replace("[city]", $event->buyer->user->city, $email_content);
          // $email_content = str_replace("[postalcode]", $event->buyer->user->postalcode, $email_content);
          // $email_content = str_replace("[country]", $country, $email_content);

          $mail = $event->buyer->user->email;
          \Mail::send('frontend.mail.general', ['email_content' => $email_content, 'uuid'=>$event->buyer->user->uuid], function ($message) use ($email_template, $mail) {
              $message->subject($email_template->subject);
              $message->to($mail);
          });
          $sms_content = str_replace("[env]", env('APP_ENV'), $sms_content);
          $sms_content = str_replace("[role]", 'seller', $sms_content);
          $sms_content = $wappsms_content.str_replace("[name]", $event->buyer->user->name, $sms_content);
          $sms_content = str_replace("[email]", $event->buyer->user->email, $sms_content);
          $sms_content = str_replace("[password]", $event->password, $sms_content);
          $sms_content = str_replace("[phone]", (substr(trim($event->buyer->user->phone),0,1) != '+' ? '+' : '').$event->buyer->user->phone, $sms_content);
          // $sms_content = str_replace("[city]", $event->buyer->user->city, $sms_content);
          // $sms_content = str_replace("[postalcode]", $event->buyer->user->postalcode, $sms_content);
          // $sms_content = str_replace("[country]", $country, $sms_content);          
          $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', auth()->user()->uuid);
            
          $sms_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $sms_content);
          if(isset($user->whatsapp_subscription) ==1){  
              SendWhatsapp(['phone' => @$event->buyer->user->phone, 'body' => $sms_content,'is_PDF'=>false]);
          }
          SendSMS(@$event->buyer->user->phone,$sms_content);

       }else{
        \Log::info('Email template "BUYER CREATED" not exist ');         
       }
    }
}
