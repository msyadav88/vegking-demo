<?php

namespace App\Listeners\Frontend\Auth;
use App\Events\Pushnotification;
/**
 * Class UserEventListener.
 */
class UserEventListener
{
  /**
   * @param $event
   */
  public function onLoggedIn($event)
  {
    $ip_address = request()->getClientIp();
    // Update the logging in users time & IP
    $event->user->fill([
      'last_login_at' => now()->toDateTimeString(),
      'last_login_ip' => $ip_address,
    ]);
    // Update the timezone via IP address
    $geoip = geoip($ip_address);
    if ($event->user->timezone !== $geoip['timezone']) {
      // Update the users timezone
      $event->user->fill([
        'timezone' => $geoip['timezone'],
      ]);
    }
    $event->user->save();
    \Log::info('User Logged In: '.$event->user->full_name);
  }

  /**
   * @param $event
   */
  public function onLoggedOut($event)
  {
    \Log::info('User Logged Out: '.$event->user->full_name);
  }

  /**
   * @param $event
   */
  public function onRegistered($event)
  {
 
    \Log::info('User Registered: '.$event->user->full_name);
    $locale = \App::getLocale();
    $email_template = get_email_template('SELLER REGISTER');

    if($event->user->hasRole('seller'))
    {
      $email_template = get_email_template('SELLER REGISTER');
      \App\EmailTemplate::where('title', 'SELLER REGISTER')->increment('sent');
      $whatsapp_number = @$event->user->phone;
      $sms_number = @$event->user->phone;
    }
    elseif($event->user->hasRole('buyer'))
    {
      if($event->buyer_seller->from_buyerlead==1)
      {
        $email_template = get_email_template('BUYER SHORT REGISTER');
        \App\EmailTemplate::where('title', 'BUYER SHORT REGISTER')->increment('sent');
      }
      else
      {
        //$email_content = str_replace("[role]", 'buyer', $email_content);
        $email_template = get_email_template('BUYER REGISTER');
        \App\EmailTemplate::where('title', 'BUYER REGISTER')->increment('sent');
      }
      $whatsapp_number = @$event->user->phone;
      $sms_number = @$event->user->phone;

    }
 
    if($email_template)
    {
 
      if($event->user->hasRole('seller') && in_array('1001', explode(',',$email_template->recipients)) || $event->user->hasRole('buyer') && in_array('1002', explode(',',$email_template->recipients)))
      {
        if($event->user->uuid){
            \Mail::to($event->user->email,$event->user->full_name)->send(new \App\Mail\Frontend\Register\Register_email($event->user,$event->buyer_seller, $email_template));  
          }
        
        $whatsapp_verification_link = route('frontend.auth.whatsapp.verify', $event->user->whatsapp_verification_code);
        $globalHeader = getHeaderFooter($email_template->id, $locale);
        if($event->user->hasRole('seller'))
        {
          if($locale == 'pl')
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];

            $email_content .= $email_template->sms_content_pl;
            $push_content .= $email_template->push_content_pl;
            
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          elseif($locale == 'de')
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];

            $email_content .= $email_template->sms_content_de;
            $push_content .= $email_template->push_content_de;
            
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          else
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];

            $email_content .= $email_template->sms_content;
            $push_content .= $email_template->push_content_en;
            
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          $email_content = str_replace("[role]", 'seller', $email_content);
          $push_content = str_replace("[role]", 'seller', $push_content);
        }
        if($event->user->hasRole('buyer'))
        {
          if($locale == 'pl')
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];
            $email_content .= "\r\n";

            $email_content .= $email_template->buyer_sms_content_pl;
            $push_content .= $email_template->buyer_push_content_pl;
            
            $email_content .= "\r\n";
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          elseif($locale == 'de')
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];
            $email_content .= "\r\n";

            $email_content .= $email_template->buyer_sms_content_de;
            $push_content .= $email_template->buyer_push_content_de;
            
            $email_content .= "\r\n";
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          else
          {
            $email_content = $globalHeader['header'];
            $push_content = $globalHeader['header'];
            $email_content .= "\r\n";
            
            $email_content .= $email_template->buyer_sms_content;
            $push_content .= $email_template->buyer_push_content_en;
            
            $email_content .= "\r\n";
            $email_content .= $globalHeader['footer'];
            $push_content .= $globalHeader['footer'];
          }
          $email_content = str_replace("[role]", 'buyer', $email_content);
          $push_content = str_replace("[role]", 'buyer', $push_content);
        }
        $cdata = request()->toArray();
        
        $prefered_method = array();
        if(isset($cdata['contact_sms']) && ($cdata['contact_sms']==1))
        {
          $prefered_method[] = "SMS";
        }
        if(isset($cdata['contact_email']) && ($cdata['contact_email']==1))
        {
          $prefered_method[] = "Email";
        }
        if(isset($cdata['contact_whatsapp']) && ($cdata['contact_whatsapp']==1))
        {
          $prefered_method[] = "WhatsApp";
        }          
        
        if($locale == 'pl')
        {
          $product_name_column = 'name_pl';
        }
        elseif($locale == 'de')
        {
          $product_name_column = 'name_de';
        }
        else
        {
          $product_name_column = 'name';
        }

        //$title = $user->gender == 0 ? 'King':'Queen';
        $email_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
        $push_content = str_replace("[env]", env('APP_ENV') == '' ? '':env('APP_ENV'), $email_content);
        $email_content = str_replace("[level]", 'level 1', $email_content);
        $push_content = str_replace("[level]", 'level 1', $push_content);
        $email_content = str_replace("[title]", 'King', $email_content);
        $push_content = str_replace("[title]", 'King', $push_content);

        $product_name = \App\Product::where('id',$event->user->product_id)->first()[$product_name_column];
        $email_content = str_replace("[recipient]", ucfirst($event->user->full_name), $email_content);
        $email_content = str_replace("[product_name]", $product_name, $email_content);
        $email_content = str_replace("[product_sub_type]", $event->user->product_sub_type, $email_content);
        $email_content = str_replace("[name]", ucfirst($event->user->name), $email_content);
        $email_content = str_replace("[first_name]", $event->user->first_name, $email_content);
        $email_content = str_replace("[email]", $event->user->email, $email_content);
        $email_content = str_replace("[phone]", (substr(trim($event->user->phone),0,1) != '+' ? '+' : '').$event->user->phone, $email_content);
        $email_content = str_replace("[contact_preferred_method]", implode(', ',$prefered_method), $email_content);
        $email_content = str_replace("[notes]", $event->user->notes, $email_content);
        $email_content = str_replace("[verification_link]", $whatsapp_verification_link, $email_content);

        $push_content = str_replace("[recipient]", ucfirst($event->user->full_name), $push_content);
        $push_content = str_replace("[product_sub_type]", $event->user->product_sub_type, $push_content);
        $push_content = str_replace("[product_sub_type]", $event->user->product_sub_type, $push_content);
        $push_content = str_replace("[name]", ucfirst($event->user->name), $push_content);
        $push_content = str_replace("[first_name]", $event->user->first_name, $push_content);
        $push_content = str_replace("[email]", $event->user->email, $push_content);
        $push_content = str_replace("[phone]", (substr(trim($event->user->phone),0,1) != '+' ? '+' : '').$event->user->phone, $push_content);
        $push_content = str_replace("[contact_preferred_method]", implode(', ',$prefered_method), $push_content);
        $push_content = str_replace("[notes]", $event->user->notes, $push_content);
        $push_content = str_replace("[verification_link]", 
        $whatsapp_verification_link, $push_content);

        $whatsapp_unsubscribe_link ='Click here to unsubscribe whatsapp messages ' .  url('unsubscribeWhatsapp', $event->user->uuid);
            
        $push_content = str_replace("[unsubscribe]", $whatsapp_unsubscribe_link, $push_content);
        if(isset($event->user->whatsapp_subscription) ==1){
          SendWhatsapp(['phone' => $whatsapp_number, 'body' => $email_content,'is_PDF'=>false]);
          //SendSMS(@$sms_number,$email_content);
        }
        if($push_content)
        {
          event(new Pushnotification($push_content,$event->user->id,$url='', $email_template['push_sounds']));
        }else{
          event(new Pushnotification($push_content,$event->user->id,$url='', $email_template['push_sounds']));
        }
       }
    }
    else
    {
      \Log::info('Email template does not exist ');         
    }
  }

  /**
   * @param $event
   */
  public function onProviderRegistered($event)
  {
    \Log::info('User Provider Registered: '.$event->user->full_name);
  }

  /**
   * @param $event
   */
  public function onConfirmed($event)
  {
    \Log::info('User Confirmed: '.$event->user->full_name);
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   */
  public function subscribe($events)
  {
    $events->listen(
      \App\Events\Frontend\Auth\UserLoggedIn::class,
      'App\Listeners\Frontend\Auth\UserEventListener@onLoggedIn'
    );

    $events->listen(
      \App\Events\Frontend\Auth\UserLoggedOut::class,
      'App\Listeners\Frontend\Auth\UserEventListener@onLoggedOut'
    );

    $events->listen(
      \App\Events\Frontend\Auth\UserRegistered::class,
      'App\Listeners\Frontend\Auth\UserEventListener@onRegistered'
    );

    $events->listen(
      \App\Events\Frontend\Auth\UserProviderRegistered::class,
      'App\Listeners\Frontend\Auth\UserEventListener@onProviderRegistered'
    );

    $events->listen(
      \App\Events\Frontend\Auth\UserConfirmed::class,
      'App\Listeners\Frontend\Auth\UserEventListener@onConfirmed'
    );
  }
}
